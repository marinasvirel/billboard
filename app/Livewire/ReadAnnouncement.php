<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Subcategory;
use Livewire\Attributes\Url; // Важно импортировать этот класс

class ReadAnnouncement extends Component
{
    // Атрибут #[Url] автоматически добавляет переменную в строку браузера: ?category=1
    #[Url(as: 'category')]
    public $activeCategoryId = null;

    #[Url(as: 'subcategory')]
    public $activeSubcategoryId = null;

    #[Url(as: 'filter')]
    public $filterAction = null;

    public function setFilter($action = null)
    {
        $this->filterAction = $action;
        $this->updateTitle();
    }

    public function selectCategory($id)
    {
        if ($this->activeCategoryId == $id) {
            $this->activeCategoryId = null;
            $this->activeSubcategoryId = null;
        } else {
            $this->activeCategoryId = $id;
            $this->activeSubcategoryId = null;
        }
        $this->filterAction = null;
        $this->updateTitle();
    }

    public function selectSubcategory($id)
    {
        $this->activeSubcategoryId = ($this->activeSubcategoryId == $id) ? null : $id;
        $this->filterAction = null;
        $this->updateTitle();
    }

    private function updateTitle()
    {
        $title = 'Доска объявлений | Главная';

        if ($this->activeSubcategoryId) {
            // Подкатегория и Категория
            $sub = Subcategory::with('category')->find($this->activeSubcategoryId);
            if ($sub && $sub->category) {
                $title = "{$sub->category->name} | {$sub->name}";
            }
        } elseif ($this->activeCategoryId) {
            // Только категория
            $cat = Category::find($this->activeCategoryId);
            if ($cat) $title = $cat->name;
        }

        $this->dispatch('update-browser-title', title: $title);
    }

    // Вызываем updateTitle при первой загрузке, чтобы восстановить заголовок из URL
    public function mount()
    {
        $this->updateTitle();
    }

    public function render()
    {
        $selectedSubcategory = null;
        $announcements = collect();

        if ($this->activeSubcategoryId) {
            $selectedSubcategory = Subcategory::find($this->activeSubcategoryId);
            $announcements = $selectedSubcategory->announcements()
                ->with('images')
                ->where('is_publish', true)
                ->when($this->filterAction, function ($query) {
                    return $query->where('action', $this->filterAction);
                })
                ->get();
        }

        return view('livewire.read-announcement', [
            'categories' => Category::with('subcategories')->get(),
            'selectedSubcategory' => $selectedSubcategory,
            'announcements' => $announcements,
        ]);
    }
}

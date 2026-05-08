<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Subcategory;
use Livewire\Attributes\Url;

class ReadAnnouncement extends Component
{
    #[Url(as: 'category')]
    public $activeCategoryName = null; // Изменено с ID на Name

    #[Url(as: 'subcategory')]
    public $activeSubcategoryName = null; // Изменено с ID на Name

    #[Url(as: 'filter')]
    public $filterAction = null;

    public function setFilter($action = null)
    {
        $this->filterAction = $action;
        $this->updateTitle();
    }

    public function selectCategory($name)
    {
        if ($this->activeCategoryName === $name) {
            $this->activeCategoryName = null;
            $this->activeSubcategoryName = null;
        } else {
            $this->activeCategoryName = $name;
            $this->activeSubcategoryName = null;
        }
        $this->filterAction = null;
        $this->updateTitle();
    }

    public function selectSubcategory($name)
    {
        $this->activeSubcategoryName = ($this->activeSubcategoryName === $name) ? null : $name;
        $this->filterAction = null;
        $this->updateTitle();
    }

    private function updateTitle()
    {
        $title = 'Доска объявлений | Главная';

        if ($this->activeSubcategoryName) {
            $sub = Subcategory::with('category')->where('name', $this->activeSubcategoryName)->first();
            if ($sub && $sub->category) {
                $title = "{$sub->category->name} | {$sub->name}";
            }
        } elseif ($this->activeCategoryName) {
            $title = $this->activeCategoryName;
        }

        $this->dispatch('update-browser-title', title: $title);
    }

    public function mount()
    {
        $this->updateTitle();
    }

    public function render()
    {
        $selectedSubcategory = null;
        $announcements = collect();

        if ($this->activeSubcategoryName) {
            $selectedSubcategory = Subcategory::where('name', $this->activeSubcategoryName)->first();

            if ($selectedSubcategory) {
                $announcements = $selectedSubcategory->announcements()
                    ->with('images')
                    ->where('is_publish', true)
                    ->when($this->filterAction, function ($query) {
                        return $query->where('action', $this->filterAction);
                    })
                    ->get();
            }
        }

        return view('livewire.read-announcement', [
            'categories' => Category::with('subcategories')->get(),
            'selectedSubcategory' => $selectedSubcategory,
            'announcements' => $announcements,
        ]);
    }
}

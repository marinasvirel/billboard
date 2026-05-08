<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Subcategory;
use Livewire\Attributes\Url;

class ReadAnnouncement extends Component
{
    // Теперь это обычные свойства, они приходят из роута или обновляются методом
    public $activeCategorySlug = null;
    public $activeSubcategorySlug = null;

    // Фильтр (продам/куплю) оставляем в query string (?filter=...)
    #[Url(as: 'filter')]
    public $filterAction = null;

    /**
     * Вызывается при загрузке страницы
     */
    public function mount($categorySlug = null, $subcategorySlug = null)
    {
        $this->activeCategorySlug = $categorySlug;
        $this->activeSubcategorySlug = $subcategorySlug;
        $this->updateTitle();
    }

    public function setFilter($action = null)
    {
        $this->filterAction = $action;
        $this->updateTitle();
    }

    public function selectCategory($slug)
    {
        if ($this->activeCategorySlug === $slug) {
            $this->activeCategorySlug = null;
            $this->activeSubcategorySlug = null;
        } else {
            $this->activeCategorySlug = $slug;
            $this->activeSubcategorySlug = null;
        }

        $this->filterAction = null;
        $this->syncUrl(); // Обновляем адресную строку
        $this->updateTitle();
    }

    public function selectSubcategory($slug)
    {
        $this->activeSubcategorySlug = ($this->activeSubcategorySlug === $slug) ? null : $slug;
        $this->filterAction = null;

        $this->syncUrl(); // Обновляем адресную строку
        $this->updateTitle();
    }

    /**
     * Метод для синхронизации URL без перезагрузки страницы
     */
    private function syncUrl()
    {
        $url = '/';
        if ($this->activeCategorySlug) {
            $url .= $this->activeCategorySlug;
            if ($this->activeSubcategorySlug) {
                $url .= '/' . $this->activeSubcategorySlug;
            }
        }

        // Используем pushState, чтобы URL в браузере сменился на ЧПУ мгновенно
        $this->js("history.pushState({}, '', '{$url}')");
    }

    private function updateTitle()
    {
        $title = 'Доска объявлений | Главная';

        if ($this->activeSubcategorySlug && $this->activeCategorySlug) {
            $sub = Subcategory::where('slug', $this->activeSubcategorySlug)
                ->whereHas('category', function ($query) {
                    $query->where('slug', $this->activeCategorySlug);
                })
                ->first();

            if ($sub) {
                $title = "{$sub->category->name} | {$sub->name}";
            }
        } elseif ($this->activeCategorySlug) {
            $cat = Category::where('slug', $this->activeCategorySlug)->first();
            if ($cat) {
                $title = $cat->name;
            }
        }

        $this->dispatch('update-browser-title', title: $title);
    }

    public function render()
    {
        $selectedSubcategory = null;
        $announcements = collect();

        if ($this->activeSubcategorySlug) {
            $selectedSubcategory = Subcategory::where('slug', $this->activeSubcategorySlug)->first();

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

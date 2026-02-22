<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Subcategory;

class ReadAnnouncement extends Component
{
    // Переменная для хранения ID выбранной категории
    public $activeCategoryId = null;
    public $activeSubcategoryId = null;
    public $filterAction = null;

    public function setFilter($action = null)
    {
        $this->filterAction = $action;
    }

    public function selectCategory($id)
    {
        if ($this->activeCategoryId === $id) {
            // Если кликнули по уже открытой категории — закрываем всё
            $this->activeCategoryId = null;
            $this->activeSubcategoryId = null;
        } else {
            // Если открываем новую категорию — обязательно сбрасываем старую подкатегорию
            $this->activeCategoryId = $id;
            $this->activeSubcategoryId = null;
        }
        $this->filterAction = null;
    }

    public function selectSubcategory($id)
    {
        // Переключаем выбор подкатегории
        $this->activeSubcategoryId = ($this->activeSubcategoryId === $id) ? null : $id;
        $this->filterAction = null;
    }

    public function render()
    {
        $selectedSubcategory = null;
        $announcements = collect();

        if ($this->activeSubcategoryId) {
            $selectedSubcategory = Subcategory::find($this->activeSubcategoryId);

            // Фильтруем объявления прямо здесь
            $announcements = $selectedSubcategory->announcements()
                ->with('images')
                ->when($this->filterAction, function ($query) {
                    return $query->where('action', $this->filterAction);
                })
                ->get();
        }

        return view('livewire.read-announcement', [
            'categories' => Category::with('subcategories')->get(),
            'selectedSubcategory' => $selectedSubcategory,
            'announcements' => $announcements, // Передаем отфильтрованные данные
        ]);
    }
}

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
    }

    public function selectSubcategory($id)
    {
        // Переключаем выбор подкатегории
        $this->activeSubcategoryId = ($this->activeSubcategoryId === $id) ? null : $id;
    }

    public function render()
    {
        return view('livewire.read-announcement', [
            'categories' => Category::with('subcategories')->get(),
            'selectedSubcategory' => $this->activeSubcategoryId ? Subcategory::with('announcements')->find($this->activeSubcategoryId) : null,
        ]);
    }
}

<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Subcategory;

class CreateAnnouncement extends Component
{
    public $categories;
    public $subcategories = [];

    public $selectedCategory = null;
    public $selectedSubcategory = null;

    public function mount()
    {
        // Загружаем все категории при инициализации
        $this->categories = Category::all();
    }

    // Метод запускается автоматически при изменении $selectedCategory
    public function updatedSelectedCategory($categoryId)
    {
        if (!empty($categoryId)) {
            $this->subcategories = Subcategory::where('category_id', $categoryId)->get();
        } else {
            $this->subcategories = [];
        }
        $this->selectedSubcategory = null; // Сбрасываем подкатегорию
    }

    public function render()
    {
        return view('livewire.create-announcement');
    }
}

<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Log;

class CreateAnnouncement extends Component
{
    // Поля формы (только простые типы данных)
    public string $title;
    public string $text;
    public $action = null;
    public $category_id = null;
    public $subcategory_id = null;

    public function save()
    {
        Log::info($this->all());
    }

    public function render()
    {
        $categories = Category::all();
        $subcategories = $this->category_id
            ? Subcategory::where('category_id', $this->category_id)->get()
            : [];
        return view('livewire.create-announcement', [
            'categories' => $categories,
            'subcategories' => $subcategories,
        ]);
    }
}

<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CreateAnnouncement extends Component
{
    // Поля формы (только простые типы данных)
    public $user_id;
    public $category_id = null;
    public $subcategory_id = null;
    public $slug;
    public $title;
    public $text;
    public $action;
    public $is_publish;

    public function mount()
    {
        $this->user_id = Auth::id();
        $this->is_publish = false;
    }

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

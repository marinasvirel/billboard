<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;

class ReadAnnouncement extends Component
{
    // Переменная для хранения ID выбранной категории
    public $activeCategoryId = null;

    // Метод, который вызывается при клике
    public function selectCategory($id)
    {
        // Если нажали на уже открытый таб — закрываем его (null), иначе — открываем новый
        if ($this->activeCategoryId === $id) {
            $this->activeCategoryId = null;
        } else {
            $this->activeCategoryId = $id;
        }
    }

    public function render()
    {
        return view('livewire.read-announcement', [
            'categories' => Category::with('subcategories.announcements')->get(),
        ]);
    }
}

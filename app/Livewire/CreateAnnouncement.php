<?php

namespace App\Livewire;

use App\Models\Announcement;
use Livewire\Component;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CreateAnnouncement extends Component
{
    public $user_id;
    public $category_id = null;
    public $subcategory_id = null;
    public $title;
    public $text;
    public $action;
    public $is_publish = false;

    public function messages()
    {
        return [
            'title.required' => 'Пожалуйста, укажите заголовок объявления.',
            'title.min' => 'Заголовок слишком короткий (минимум :min символа).',
            'text.required' => 'Не забудьте написать текст объявления.',
            'text.min' => 'Текст должен быть содержательным (от :min символов).',
            'action.required' => 'Укажите тип действия (продажа, покупка и т.д.).',
            'category_id.required' => 'Выберите категорию из списка.',
            'subcategory_id.required' => 'Выберите субкатегорию из списка.',
        ];
    }

    public function save()
    {
        $validated = $this->validate([
            'title' => ['required', 'min:3'],
            'text' => ['required', 'min:3'],
            'action' => ['required'],
            'category_id' => ['required'],
            'subcategory_id' => ['required'],
        ]);
        $validated['user_id'] = Auth::id();
        $announcement = Announcement::create($validated);
        session()->flash('message', 'Запись добавлена! ID: ' . $announcement->id);
        $this->reset('title', 'text', 'action', 'category_id','subcategory_id');
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

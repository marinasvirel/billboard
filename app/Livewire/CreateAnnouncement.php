<?php

namespace App\Livewire;

use App\Models\Announcement;
use Livewire\Component;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Validate;

class CreateAnnouncement extends Component
{
    // Поля формы (только простые типы данных)
    public $user_id;

    #[Validate('required|exists:categories,id')]
    public $category_id = null;

    #[Validate('nullable|exists:subcategories,id')]
    public $subcategory_id = null;

    #[Validate('required|min:3')]
    public $title;

    #[Validate('required|min:10')]
    public $text;

    #[Validate('required')]
    public $action;

    public $is_publish = false;

    public function messages()
    {
        return [
            'title.required' => 'Пожалуйста, укажите заголовок объявления.',
            'title.min' => 'Заголовок слишком короткий (минимум :min символа).',
            'text.required' => 'Не забудьте написать текст объявления.',
            'text.min' => 'Текст должен быть содержательным (от :min символов).',
            'category_id.required' => 'Выберите категорию из списка.',
            'action.required' => 'Укажите тип действия (продажа, покупка и т.д.).',
        ];
    }

    public function save()
    {

        $validated = $this->validate();
        $validated['user_id'] = Auth::id();
        $announcement = Announcement::create($validated);
        session()->flash('message', 'Запись добавлена! ID: ' . $announcement->id);
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

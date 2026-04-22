<?php

namespace App\Livewire;

use App\Models\Announcement;
use Livewire\Component;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Log;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;

class CreateAnnouncement extends Component
{
    use WithFileUploads;

    public $user_id;
    public $category_id = null;
    public $subcategory_id = null;
    public $title;
    public $text;
    public $action;
    public $images = [];
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

    public function updatedImages()
    {
        $this->validate([
            'images.*' => 'image|max:2048', // 2MB Max
        ]);

        if (count($this->images) > 6) {
            $this->images = array_slice($this->images, 0, 6);
            $this->addError('images', 'Можно загрузить не более 6 изображений.');
        }
    }

    // 2. Исправленный метод save
    public function save()
    {
        $this->validate([
            'title' => ['required', 'min:3'],
            'text' => ['required', 'min:3'],
            'action' => ['required'],
            'category_id' => ['required'],
            'subcategory_id' => ['required'],
            'images' => ['nullable', 'array', 'max:6'],
            'images.*' => ['image', 'max:2048'],
        ]);

        $announcement = Announcement::create([
            'user_id' => Auth::id(),
            'title' => $this->title,
            'text' => $this->text,
            'action' => $this->action,
            'category_id' => $this->category_id,
            'subcategory_id' => $this->subcategory_id,
        ]);

        if (!empty($this->images)) {
            $manager = new ImageManager(new Driver());

            foreach ($this->images as $index => $image) {
                // Генерируем уникальное имя
                $fileName = uniqid() . '.webp';
                $path = 'announcements/' . $fileName;

                // Обработка через Intervention
                // Используем getRealPath(), чтобы прочитать временный файл
                $img = $manager->read($image->getRealPath())
                    ->cover(210, 210)
                    ->toWebp(80);

                // Сохраняем файл на диск public
                Storage::disk('public')->put($path, (string) $img);

                // Записываем в базу данных
                $announcement->images()->create([
                    'path' => $path,
                    'is_preview' => ($index === 0),
                ]);
            }
        }

        session()->flash('message', 'Объявление создано!');

        // Сброс всех полей
        $this->reset(['title', 'text', 'action', 'category_id', 'subcategory_id', 'images']);
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

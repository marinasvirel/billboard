<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Subcategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Announcement>
 */
class AnnouncementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->realText(50);
        return [
            'user_id' => User::query()->inRandomOrder()->value('id'),
            'category_id' => Category::query()->inRandomOrder()->value('id'),
            'subcategory_id' => Subcategory::query()->inRandomOrder()->value('id'),
            'title' => $title,
            'slug' => Str::slug($title),
            'text' => fake()->realText(200),
            'action' => fake()->randomElement(['Продажа', 'Покупка', 'Аренда', 'Другое']),
        ];
    }
}

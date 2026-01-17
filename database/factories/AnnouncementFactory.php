<?php

namespace Database\Factories;

use App\Models\Subcategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        return [
            'user_id' => User::query()->inRandomOrder()->value('id'),
            'subcategory_id' => Subcategory::query()->inRandomOrder()->value('id'),
            'title' => fake()->realText(20),
            'text' => fake()->realText(200),
            'action' => fake()->randomElement(['Продажа', 'Покупка', 'Аренда',]),
        ];
    }
}

<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::firstOrCreate(['name' => 'Недвижимость'])
            ->subcategories()->createMany([
                ['name' => 'Жилая'],
                ['name' => 'Коммерческая'],
                ['name' => 'Земельные участки'],
                ['name' => 'Другое'],
            ]);

        Category::firstOrCreate(['name' => 'Животные'])
            ->subcategories()->createMany([
                ['name' => 'Кошки'],
                ['name' => 'Собаки'],
                ['name' => 'Птицы'],
                ['name' => 'Рыбы'],
                ['name' => 'Другое'],
            ]);

        Category::firstOrCreate(['name' => 'Растения'])
            ->subcategories()->createMany([
                ['name' => 'Домашние'],
                ['name' => 'Лесные'],
                ['name' => 'Садовые'],
                ['name' => 'Другое'],
            ]);

        Category::firstOrCreate(['name' => 'Транспорт'])
            ->subcategories()->createMany([
                ['name' => 'Грузовой'],
                ['name' => 'Легковой'],
                ['name' => 'Водяной'],
                ['name' => 'Другое'],
            ]);

        Category::firstOrCreate(['name' => 'Оборудование'])
            ->subcategories()->createMany([
                ['name' => 'Домашнее'],
                ['name' => 'Заводское'],
                ['name' => 'Другое'],
            ]);

        Category::firstOrCreate(['name' => 'Разное'])
            ->subcategories()->createMany([
                ['name' => 'Другое'],
            ]);
    }
}

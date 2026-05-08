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
                ['name' => 'Жилая', 'slug' => 'residential'],
                ['name' => 'Коммерческая', 'slug' => 'commercial'],
                ['name' => 'Земельные участки', 'slug' => 'land_plots'],
                ['name' => 'Другое', 'slug' => 'other_realty'],
            ]);

        Category::firstOrCreate(['name' => 'Животные'])
            ->subcategories()->createMany([
                ['name' => 'Кошки', 'slug' => 'cats'],
                ['name' => 'Собаки', 'slug' => 'dogs'],
                ['name' => 'Птицы', 'slug' => 'birds'],
                ['name' => 'Рыбы', 'slug' => 'fish'],
                ['name' => 'Другое', 'slug' => 'other_animals'],
            ]);

        Category::firstOrCreate(['name' => 'Растения'])
            ->subcategories()->createMany([
                ['name' => 'Домашние', 'slug' => 'home_plants'],
                ['name' => 'Лесные', 'slug' => 'forest'],
                ['name' => 'Садовые', 'slug' => 'garden'],
                ['name' => 'Другое', 'slug' => 'other_plants'],
            ]);

        Category::firstOrCreate(['name' => 'Транспорт'])
            ->subcategories()->createMany([
                ['name' => 'Грузовой', 'slug' => 'cargo'],
                ['name' => 'Легковой', 'slug' => 'passenger'],
                ['name' => 'Водяной', 'slug' => 'water'],
                ['name' => 'Другое', 'slug' => 'other_transport'],
            ]);

        Category::firstOrCreate(['name' => 'Оборудование'])
            ->subcategories()->createMany([
                ['name' => 'Домашнее', 'slug' => 'home_equipment'],
                ['name' => 'Заводское', 'slug' => 'factory'],
                ['name' => 'Другое', 'slug' => 'other_equipment'],
            ]);

        Category::firstOrCreate(['name' => 'Разное'])
            ->subcategories()->createMany([
                ['name' => 'Другое', 'slug' => 'other_sundry'],
            ]);
    }
}

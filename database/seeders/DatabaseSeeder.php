<?php

namespace Database\Seeders;

use App\Models\Announcement;
use App\Models\Subcategory;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call(CategorySeeder::class);
        $this->call(SubcategorySeeder::class);

        User::factory(3)->create();
        Announcement::factory(30)->create();
    }
}

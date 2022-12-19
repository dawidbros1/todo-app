<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;

# php artisan make:seeder CategorySeeder
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (count(User::all()) == 0) {
            exit();
        }

        $limit = env('CATEGORY_SEEDER_LIMIT', 5);
        Category::factory($limit)->create();
    }
}

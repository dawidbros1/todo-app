<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Auth\User;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition()
    {
        $ids = User::all()->pluck('id');

        return [
            'user_id' => $ids->random(),
            'name' => implode(" ", $this->faker->words(2)),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

# php artisan make:factory TaskFactory

class TaskFactory extends Factory
{
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $ids = Category::all()->pluck('id');
        $status = collect(['active', 'finished'])->random();
        $created_at = Carbon::now()->addHours(rand(0, 23))->addMinutes(rand(0, 59))->subDay();

        return [
            'category_id' => $ids->random(),
            'name' => implode(" ", $this->faker->words(2)),
            'description' => implode(" ", $this->faker->words(25)),
            'status' => $status,
            'created_at' => $created_at,
            'finished_at' => $status == "active" ? null : $this->clone($created_at)->addHours(rand(0, 23))->addMinutes(rand(0, 59)),
            'deadline' => $this->clone($created_at)->addHours(rand(6, 23))->addMinutes(rand(0, 59)),
        ];
    }

    function clone (Carbon $carbon) {
        return unserialize(serialize($carbon));
    }
}

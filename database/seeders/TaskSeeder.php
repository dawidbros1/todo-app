<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (count(Category::all()) == 0) {
            exit();
        }

        $limit = env('TASK_SEEDER_LIMIT', 25);
        Task::factory($limit)->create();
    }
}

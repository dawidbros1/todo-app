<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Task;
use App\Models\User;
use Database\Factories\CategoryFactory;
use Database\Factories\TaskFactory;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Task::truncate();
        Category::truncate();
        User::truncate();

        $factory = new UserFactory();

        $data = [
            [
                'name' => 'Jan Kowalski',
                'email' => 'user01@example.com',
            ],
            [
                'name' => 'Edyta Kromkiewicz',
                'email' => 'user02@example.com',
            ],
        ];

        foreach ($data as $item) {
            $user = $factory->create($item);
            $this->createRelationData($user);
        }
    }

    private function createRelationData($user)
    {
        $categories = (new CategoryFactory())->count(10)->create(['user_id' => $user->id]);

        foreach ($categories as $category) {
            (new TaskFactory())->count(10)->create(['category_id' => $category->id]);
        }
    }
}

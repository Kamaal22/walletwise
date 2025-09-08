<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['user_id' => 1, 'name' => 'Food', 'type' => 'expense'],
            ['user_id' => 1, 'name' => 'Transport', 'type' => 'expense'],
            ['user_id' => 1, 'name' => 'Bills', 'type' => 'expense'],
            ['user_id' => 1, 'name' => 'Salary', 'type' => 'income'],
            ['user_id' => 1, 'name' => 'Freelance', 'type' => 'income']
        ];

        Category::insert($categories);
    }
}

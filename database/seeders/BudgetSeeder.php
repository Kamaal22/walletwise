<?php

namespace Database\Seeders;

use App\Models\Budget;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BudgetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $budgets =
            [
                [
                    'user_id' => 1,
                    'category_id' => 2,
                    'limit' => 50,
                    'start_date' => '2025-09-01',
                    'end_date' => '2025-09-30',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'user_id' => 1,
                    'category_id' => 1,
                    'limit' => 100,
                    'start_date' => '2025-09-01',
                    'end_date' => '2025-09-15',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'user_id' => 1,
                    'category_id' => 3,
                    'limit' => 75,
                    'start_date' => '2025-10-01',
                    'end_date' => '2025-10-31',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'user_id' => 1,
                    'category_id' => 4,
                    'limit' => 30,
                    'start_date' => '2025-08-15',
                    'end_date' => '2025-09-14',
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            ];

        Budget::insert($budgets);
    }
}

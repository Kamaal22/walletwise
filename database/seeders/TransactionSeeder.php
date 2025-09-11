<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Category;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transactions = [
            [
                'user_id' => 1,
                'category_id' => 3,
                'type' => 'expense',
                'account_id' => 1,
                'amount' => -1.50,
                'description' => 'Tea Salool Cafe',
                'date' => '2025-09-01 09:00:00',
            ],
            [
                'user_id' => 1,
                'category_id' => 4,
                'type' => 'income',
                'account_id' => 2,
                'amount' => 300.00,
                'description' => 'Retail sales Hargeisa Market',
                'date' => '2025-09-02 10:30:00',
            ],
            [
                'user_id' => 1,
                'category_id' => 2,
                'type' => 'expense',
                'account_id' => 1,
                'amount' => -120.50,
                'description' => 'Purchase of tea leaves',
                'date' => '2025-09-03 14:00:00',
            ],
            [
                'user_id' => 1,
                'category_id' => 4,
                'type' => 'expense',
                'account_id' => 2,
                'amount' => -75.00,
                'description' => 'Local delivery fees',
                'date' => '2025-09-04 15:00:00',
            ],
            [
                'user_id' => 1,
                'category_id' => 5,
                'type' => 'income',
                'account_id' => 1,
                'amount' => -430.00,
                'description' => 'Juice sales Salool Cafe',
                'date' => '2025-09-05 09:30:00',
            ],
            [
                'user_id' => 1,
                'category_id' => 1,
                'type' => 'expense',
                'account_id' => 2,
                'amount' => -60.00,
                'description' => 'Generator maintenance',
                'date' => '2025-09-06 11:00:00',
            ],
            [
                'user_id' => 1,
                'category_id' => 3,
                'type' => 'expense',
                'account_id' => 1,
                'amount' => -10.00,
                'description' => 'Tea cups purchase',
                'date' => '2025-09-07 12:00:00',
            ],
            [
                'user_id' => 1,
                'category_id' => 4,
                'type' => 'income',
                'account_id' => 2,
                'amount' => 500.00,
                'description' => 'Retail sales Hargeisa Market',
                'date' => '2025-09-08 14:30:00',
            ],
            [
                'user_id' => 1,
                'category_id' => 5,
                'type' => 'expense',
                'account_id' => 1,
                'amount' => -85.00,
                'description' => 'Supply purchase',
                'date' => '2025-09-09 15:45:00',
            ],
            [
                'user_id' => 1,
                'category_id' => 4,
                'type' => 'expense',
                'account_id' => 2,
                'amount' => 50.00,
                'description' => 'Transport fees',
                'date' => '2025-09-10 09:15:00',
            ],
            [
                'user_id' => 1,
                'category_id' => 4,
                'type' => 'income',
                'account_id' => 1,
                'amount' => 200.00,
                'description' => 'Tea sales Salool Cafe',
                'date' => '2025-09-11 10:30:00',
            ],
            [
                'user_id' => 1,
                'category_id' => 2,
                'type' => 'expense',
                'account_id' => 2,
                'amount' => -40.00,
                'description' => 'Purchase of sugar',
                'date' => '2025-09-12 12:00:00',
            ],
            [
                'user_id' => 1,
                'category_id' => 3,
                'type' => 'expense',
                'account_id' => 1,
                'amount' => 15.00,
                'description' => 'Cleaning supplies',
                'date' => '2025-09-13 13:15:00',
            ],
            [
                'user_id' => 1,
                'category_id' => 5,
                'type' => 'income',
                'account_id' => 2,
                'amount' => 600.00,
                'description' => 'Retail sales Hargeisa Market',
                'date' => '2025-09-14 15:00:00',
            ],
            [
                'user_id' => 1,
                'category_id' => 4,
                'type' => 'expense',
                'account_id' => 1,
                'amount' => -90.00,
                'description' => 'Equipment repair',
                'date' => '2025-09-15 16:30:00',
            ],
            [
                'user_id' => 1,
                'category_id' => 2,
                'type' => 'expense',
                'account_id' => 2,
                'amount' => -30.00,
                'description' => 'Transport fuel',
                'date' => '2025-09-16 08:45:00',
            ],
            [
                'user_id' => 1,
                'category_id' => 4,
                'type' => 'income',
                'account_id' => 1,
                'amount' => 275.00,
                'description' => 'Tea sales Salool Cafe',
                'date' => '2025-09-17 09:00:00',
            ],
        ];


        Transaction::insert($transactions);
    }
}

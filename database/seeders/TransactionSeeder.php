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
                'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
                'category_id' => Category::where('name', 'Food & Beverage')->first()?->id ?? Category::factory(),
                'type' => 'income',
                'account_id' => Account::inRandomOrder()->first()?->id ?? Account::factory(),
                'amount' => 250.00,
                'description' => 'Tea sales - Salool Cafe',
                'date' => fake()->dateTimeThisMonth(),
            ],
            [
                'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
                'category_id' => Category::where('name', 'Supplies')->first()?->id ?? Category::factory(),
                'type' => 'expense',
                'account_id' => Account::inRandomOrder()->first()?->id ?? Account::factory(),
                'amount' => 120.50,
                'description' => 'Purchase of tea leaves - Salool Cafe',
                'date' => fake()->dateTimeThisMonth(),
            ],
            [
                'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
                'category_id' => Category::where('name', 'Transport')->first()?->id ?? Category::factory(),
                'type' => 'expense',
                'account_id' => Account::inRandomOrder()->first()?->id ?? Account::factory(),
                'amount' => 75.00,
                'description' => 'Delivery fees - Ayaan Imports',
                'date' => fake()->dateTimeThisMonth(),
            ],
            [
                'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
                'category_id' => Category::where('name', 'Retail')->first()?->id ?? Category::factory(),
                'type' => 'income',
                'account_id' => Account::inRandomOrder()->first()?->id ?? Account::factory(),
                'amount' => 430.00,
                'description' => 'Sales revenue - Hargeisa Market',
                'date' => fake()->dateTimeThisMonth(),
            ],
            [
                'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
                'category_id' => Category::where('name', 'Maintenance')->first()?->id ?? Category::factory(),
                'type' => 'expense',
                'account_id' => Account::inRandomOrder()->first()?->id ?? Account::factory(),
                'amount' => 60.00,
                'description' => 'Generator maintenance - Salool Cafe',
                'date' => fake()->dateTimeThisMonth(),
            ],
            [
                'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
                'category_id' => Category::where('name', 'Services')->first()?->id ?? Category::factory(),
                'type' => 'income',
                'account_id' => Account::inRandomOrder()->first()?->id ?? Account::factory(),
                'amount' => 800.00,
                'description' => 'Consulting fees - Somali Tech Solutions',
                'date' => fake()->dateTimeThisMonth(),
            ],
            [
                'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
                'category_id' => Category::where('name', 'Utilities')->first()?->id ?? Category::factory(),
                'type' => 'expense',
                'account_id' => Account::inRandomOrder()->first()?->id ?? Account::factory(),
                'amount' => 45.75,
                'description' => 'Electricity bill - Hargeisa Market',
                'date' => fake()->dateTimeThisMonth(),
            ],
            [
                'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
                'category_id' => Category::where('name', 'Food & Beverage')->first()?->id ?? Category::factory(),
                'type' => 'income',
                'account_id' => Account::inRandomOrder()->first()?->id ?? Account::factory(),
                'amount' => 320.00,
                'description' => 'Lunch sales - Salool Cafe',
                'date' => fake()->dateTimeThisMonth(),
            ],
            [
                'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
                'category_id' => Category::where('name', 'Marketing')->first()?->id ?? Category::factory(),
                'type' => 'expense',
                'account_id' => Account::inRandomOrder()->first()?->id ?? Account::factory(),
                'amount' => 150.00,
                'description' => 'Social media ads - Somali Tech Solutions',
                'date' => fake()->dateTimeThisMonth(),
            ],
            [
                'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
                'category_id' => Category::where('name', 'Retail')->first()?->id ?? Category::factory(),
                'type' => 'income',
                'account_id' => Account::inRandomOrder()->first()?->id ?? Account::factory(),
                'amount' => 560.00,
                'description' => 'Clothing sales - Hargeisa Market',
                'date' => fake()->dateTimeThisMonth(),
            ],
        ];
        
        Transaction::insert($transactions);
    }
}

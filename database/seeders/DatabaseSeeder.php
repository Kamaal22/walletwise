<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Budget;
use App\Models\Category;
use App\Models\Transaction;
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
        // $this->call([
        //     UserSeeder::class,
        //     AccountSeeder::class,
        //     BudgetSeeder::class,
        //     CategorySeeder::class,
        //     TransactionSeeder::class,
        // ]);

        // Default user
        $user = User::firstOrCreate([
            'email' => 'user@example.com',
        ], [
            'name' => 'Default User',
            'password' => bcrypt('password'),
        ]);

        // Categories
        Category::factory()->count(6)->create();

        // Accounts
        Account::factory()->count(2)->create();

        // Transactions
        Transaction::factory()->count(30)->create([
            'user_id' => $user->id,
        ]);

        // Budgets
        Budget::factory()->count(3)->create();
    }
}

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
        $this->call(UserSeeder::class);
        $this->call(AccountSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(BudgetSeeder::class);
        $this->call(BudgetSeeder::class);
        $this->call(TransactionSeeder::class);
    }
}

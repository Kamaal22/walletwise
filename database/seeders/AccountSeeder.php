<?php

namespace Database\Seeders;

use App\Models\Account;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $accounts =
            [
                [
                    'user_id' => 1,
                    'name' => 'Cash Wallet',
                    'currency' => 'USD',
                    'balance' => 500,
                ],
                [
                    'user_id' => 1,
                    'name' => 'Bank Account',
                    'currency' => 'USD',
                    'balance' => 1200,
                ]
            ];

        Account::insert($accounts);
    }
}

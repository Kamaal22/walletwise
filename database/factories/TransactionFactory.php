<?php

namespace Database\Factories;

use App\Models\Account;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
            'category_id' => Category::inRandomOrder()->first()?->id ?? Category::factory(),
            'type' => fake()->randomElement(['expense', 'income']),
            'account_id' => Account::inRandomOrder()->first()?->id ?? Account::factory(),
            'amount' => fake()->randomFloat(2, 5, 500),
            'description' => fake()->sentence(3),
            'date' => fake()->dateTimeThisMonth(),
        ];
    }
}

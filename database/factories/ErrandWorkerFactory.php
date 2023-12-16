<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ErrandWorker>
 */
class ErrandWorkerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => Hash::make('1'),
            'address' => fake()->address(),
            'phone' => '0'.random_int(100000000,999999999),
            'avatar' => '',
            'identification_card' => random_int(100000000000,999999999999),
            'account_balance' => 0,
        ];
    }
}

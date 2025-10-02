<?php

namespace Database\Seeders;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Balance;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class FinanceTrackerSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'demo@familyfinance.com'],
            [
                'name' => 'Demo User',
                'password' => Hash::make('password'),
            ]
        );

        Balance::firstOrCreate(
            ['user_id' => $user->id],
            ['initial_balance' => 5000.00]
        );

        $categories = ['Food', 'Transportation', 'Utilities', 'Entertainment', 'Healthcare'];
        
        for ($i = 0; $i < 20; $i++) {
            Transaction::create([
                'user_id' => $user->id,
                'date' => now()->subDays(rand(1, 30)),
                'category' => $categories[array_rand($categories)],
                'description' => 'Expense ' . ($i + 1),
                'amount' => rand(10, 200) + (rand(0, 99) / 100)
            ]);
        }
    }
}
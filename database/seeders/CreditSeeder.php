<?php

namespace Database\Seeders;

use App\Models\Credit;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreditSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Credit::create([
            'user_id' => 1,
            'total_credits' => 100,
            'spent_credits' => 50,
            'remaining_credits' => 50,
        ]);

        Credit::create([
            'user_id' => 2,
            'total_credits' => 70,
            'spent_credits' => 10,
            'remaining_credits' => 60,
        ]);


        Credit::create([
            'user_id' => 3,
            'total_credits' => 90,
            'spent_credits' => 0,
            'remaining_credits' => 90,
        ]);
    }
}

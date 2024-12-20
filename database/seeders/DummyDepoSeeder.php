<?php

namespace Database\Seeders;

use App\Models\Deposit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class DummyDepoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            Deposit::create([
                'invoice_number' => 'INV-' . strtoupper(Str::random(10)), // Generating a random invoice number
                'user_id' => $faker->numberBetween(2, 4), // Assuming you have users with ID 1 to 10
                'amount' => $faker->randomFloat(2, 100, 10000), // Generating a random amount between 100 and 10000
                'midtrans_transaction_id' => 'MT-' . strtoupper(Str::random(16)), // Random Midtrans transaction ID
                'status' => $faker->randomElement(['pending', 'approved', 'rejected']), // Random status
            ]);
        }
    }
}

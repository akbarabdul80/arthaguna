<?php

namespace Database\Seeders;

use App\Models\Withdraw;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class DummyWithDrawSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 18; $i++) {
            Withdraw::create([
                'invoice_number' => 'INV-' . strtoupper(Str::random(10)), // Random invoice number
                'user_id' => $faker->numberBetween(2, 4), // Assuming users with ID between 1 and 10
                'amount' => $faker->randomFloat(2, 500, 2000), // Random amount between 100 and 10,000
                'withdraw_nama_bank' => $faker->company, // Random bank name
                'withdraw_nama_pemilik' => $faker->name, // Random account owner's name
                'withdraw_no_rekening' => $faker->bankAccountNumber, // Random bank account number
                'status' => $faker->randomElement(['pending', 'approved', 'rejected']), // Random status
            ]);
        }
    }
}

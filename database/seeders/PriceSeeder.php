<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Price;

class PriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prices = [
            'Free' => 0,
            'Basic' => 29,
            'Premium' => 59,
            'Enterprise' => 99,
        ];

        foreach ($prices as $name => $value) {
            Price::create(['value' => $value]);
        }
    }
}

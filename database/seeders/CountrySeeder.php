<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CountrySeeder extends Seeder {
    public function run(): void {
        DB::table('countries')->truncate();
        DB::table('countries')->insert([
            array(
                'name' => 'India',
                'country_code' => 'IND',
                'phone_code' => '+91',
                'currency_symbol' => '₹',
                'region' => 'Asia',
                'capital' => 'New Delhi',
                'updated_at' => NULL
            ),
            array(
                'name' => 'United States Of America',
                'country_code' => 'US',
                'phone_code' => '+1',
                'currency_symbol' => '$',
                'region' => 'North America',
                'capital' => 'Washington DC',
                'updated_at' => NULL
            ),
        ]);
    }
}

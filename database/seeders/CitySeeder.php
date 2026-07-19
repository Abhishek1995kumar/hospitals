<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CitySeeder extends Seeder {
    public function run(): void {
        DB::table('cities')->truncate();
        DB::table('cities')->insert([
            array(
                'state_id' => 1,
                'name' => 'Lucknow',
                'updated_at' => NULL
            ),
            array(
                'state_id' => 1,
                'name' => 'Kanpur',
                'updated_at' => NULL
            ),
            array(
                'state_id' => 1,
                'name' => 'Noida',
                'updated_at' => NULL
            ),
            array(
                'state_id' => 2,
                'name' => 'Mumbai',
                'updated_at' => NULL
            ),
            array(
                'state_id' => 2,
                'name' => 'Thane',
                'updated_at' => NULL
            ),
            array(
                'state_id' => 2,
                'name' => 'Pune',
                'updated_at' => NULL
            ),
            array(
                'state_id' => 2,
                'name' => 'Nasik',
                'updated_at' => NULL
            ),
            array(
                'state_id' => 3,
                'name' => 'Darbhanga',
                'updated_at' => NULL
            ),
            array(
                'state_id' => 3,
                'name' => 'Patna',
                'updated_at' => NULL
            ),
        ]);
    }
}

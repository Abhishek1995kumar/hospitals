<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StateSeeder extends Seeder {
    public function run(): void {
        DB::table('states')->truncate();
        DB::table('states')->insert([
            array(
                'country_id' => 1,
                'name' => 'Uttar Pradesh',
                'state_code' => 'UP',
                'updated_at' => NULL
            ),
            array(
                'country_id' => 1,
                'name' => 'Maharastra',
                'state_code' => 'MH',
                'updated_at' => NULL
            ),
            array(
                'country_id' => 1,
                'name' => 'Bihar',
                'state_code' => 'BR',
                'updated_at' => NULL
            ),
        ]);
    }
}

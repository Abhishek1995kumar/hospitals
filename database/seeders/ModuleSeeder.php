<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder {
    public function run(): void {
        DB::table('roles')->truncate();
        DB::table('roles')->insert([
            array(
                'name' => 'Dashboard',
                'slug' => 'dashboard',
                'created_at' => Carbon::now(),
                'updated_at' => NULL
            ),
            array(
                'name' => 'Hospital Management',
                'slug' => 'hospital_management',
                'created_at' => Carbon::now(),
                'updated_at' => NULL
            ),
        ]);
    }
}

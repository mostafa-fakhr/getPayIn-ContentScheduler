<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PlatformSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('platforms')->insert([
            ['id' => 1, 'name' => 'Instagram', 'type' => 'instagram'],
            ['id' => 2, 'name' => 'Twitter', 'type' => 'twitter'],
            ['id' => 3, 'name' => 'LinkedIn', 'type' => 'linkedin'],
            ['id' => 4, 'name' => 'Facebook', 'type' => 'facebook'],
        ]);
    }
}

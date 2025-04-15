<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class EquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    DB::table('equipment')->insert([
        [
            'name' => 'Basketball',
            'image' => 'basketball.png',
        ],
        [
            'name' => 'Soccer Ball',
            'image' => 'soccer.jpg',
        ],
        [
            'name' => 'Volleyball',
            'image' => 'volleyball.jpg',
        ],
    ]);
}

}

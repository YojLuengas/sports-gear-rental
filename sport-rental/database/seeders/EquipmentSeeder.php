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
    $items = [
        ['name' => 'Basketball', 'image' => 'basketball.png'],
        ['name' => 'Soccer Ball', 'image' => 'soccer.png'],
        ['name' => 'Volleyball', 'image' => 'volleyball.png'],
        ['name' => 'Badminton Racket', 'image' => 'badminton.png'],
        ['name' => 'Tennis Racket', 'image' => 'tennis.png'],
        ['name' => 'Rattan Ball', 'image' => 'rattan.png'],
    ];

    foreach ($items as $item) {
        DB::table('equipment')->updateOrInsert(
            ['name' => $item['name']],
            ['image' => $item['image'], 'total_quantity' => 3, 'rented_quantity' => 0]
        );
    }
}


}

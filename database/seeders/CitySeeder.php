<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cities')->insert([
            ['city_id'=>1, 'city_name'=>'Алматы', 'city_country'=>'Казахстан'],
            ['city_id'=>2, 'city_name'=>'Астана', 'city_country'=>'Казахстан'],
            ['city_id'=>3, 'city_name'=>'Шымкент', 'city_country'=>'Казахстан'],
            ['city_id'=>4, 'city_name'=>'Караганды', 'city_country'=>'Казахстан'],
        ]);
    }
}

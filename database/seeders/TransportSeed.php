<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransportSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('transports')->insert([
            [
                'transport_name'=>'До 500кг(Малый)',
            ],
            [
                'transport_name'=>'До 2.5тн(Средний)',
            ],
            [
                'transport_name'=>'До 5тн',
            ],
            [
                'transport_name'=>'До 10тн',
            ],
            [
                'transport_name'=>'Фура',
            ],
            [
                'transport_name'=>'Спец техника',
            ]
        ]);
    }
}

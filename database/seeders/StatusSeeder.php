<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('statuses')->insert([
            ['status_name'=>'Новая заявка'],
            ['status_name'=>'В обработке'],
            ['status_name'=>'Обработан'],
            ['status_name'=>'Назначен на водителя'],
            ['status_name'=>'Водитель принял заявку'],
            ['status_name'=>'Водитель забрал'],
            ['status_name'=>'Прибыл в центр'],
            ['status_name'=>'Обработан складом'],
            ['status_name'=>'На доставке'],
            ['status_name'=>'Переадресован'],
            ['status_name'=>'Доставлен'],
            ['status_name'=>'Отменен'],
            ['status_name'=>'Обновлен'],
            ['status_name'=>'Реестр создан'],
            ['status_name'=>'Реестр в обработке'],
            ['status_name'=>'Реестр обработан'],
        ]);
    }
}

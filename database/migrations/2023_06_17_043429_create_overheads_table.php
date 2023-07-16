<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('overheads', function (Blueprint $table) {
            $table->id();
            $table->string("order_code")->nullable()->unique();
            $table->string("overhead_code")->nullable()->unique();

            $table->integer("from_city")->default(1)->nullable();
            $table->string("from_name")->nullable();
            $table->string("from_company")->nullable();
            $table->string("from_address")->nullable();
            $table->string("from_phone")->nullable();

            $table->integer("to_city")->default(1)->nullable();
            $table->string("to_name")->nullable();
            $table->string("to_company")->nullable();
            $table->string("to_address")->nullable();
            $table->string("to_phone")->nullable();

            $table->text("cargo_details")->nullable(); // Характеристика груза
            $table->integer("counterparty")->nullable(); // Контрагент
            $table->integer("company_type")->nullable(); // Юр. лицо / Физ. лицо
            $table->integer("user_id")->nullable(); // Кто создал заявку
            $table->integer("is_package")->nullable(); // Упаковка да/нет
            $table->integer("need_movers")->nullable(); // Грузчики Забор/Доставке / 0-Для забора 1-Для доставки 3-Обе
            $table->float("mass")->default(0.0)->nullable(); // Вес
            $table->float("volume")->default(0.0)->nullable(); // Объем
            $table->float("width")->default(0.0)->nullable(); // Ширина
            $table->float("height")->default(0.0)->nullable(); // Высота
            $table->float("length")->default(0.0)->nullable(); // Длина
            $table->float("price")->default(0.0)->nullable(); // Цена
            $table->text("comment")->nullable();
            $table->text("description")->nullable();
			
			$table->text("nds")->nullable(); // С НДС или без

            $table->integer("last_status")->nullable(); // Последний статус
            $table->integer("driver")->nullable(); // Водитель
            $table->integer("transport_id")->nullable(); // Тип транспорта
            $table->integer("registry_id")->nullable(); // Реестр

            $table->timestamp("order_start_date")->nullable();
            $table->timestamp("order_end_date")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('overheads');
    }
};

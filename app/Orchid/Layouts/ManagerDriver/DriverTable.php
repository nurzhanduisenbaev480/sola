<?php

namespace App\Orchid\Layouts\ManagerDriver;

use App\Models\City;
use App\Models\Overhead;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class DriverTable extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'overheads';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('order_code', '№ Заявки'),
            TD::make('overhead_code', '№ Накл-й'),
            TD::make('from_name', 'ФИО'),
            TD::make('from_city', 'Город')->render(function (Overhead $overhead){
                return City::find($overhead->from_city)->city_name;
            }),
            TD::make('from_address', 'Адрес'),
            TD::make('from_phone', 'Телефон'),
            TD::make('actions', 'Действие')->render(function(Overhead $overhead){
                return $this->getModal($overhead);
            }),
        ];
    }

    public function getModal($overhead): Link|string
    {
        return match ($overhead->last_status) {
            4 => Link::make('Принять')->route('platform.driver.changeAccept', compact('overhead')),
            5 => Link::make('Забрать')->route('platform.driver.changeTake', compact('overhead')),
            6 => Link::make('Завершить')->route('platform.driver.changeFinish', compact('overhead')),
            default => "Не установлен",
        };
    }


}

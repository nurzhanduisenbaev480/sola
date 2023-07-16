<?php

namespace App\Orchid\Layouts\ManagerLogistician;

use App\Models\City;
use App\Models\Overhead;
use App\Models\User;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class OrderTable extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'overheads1';

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
            TD::make('from_city', 'г. Отправителя')->render(function (Overhead $overhead){
                return City::where('city_id', $overhead->from_city)->get()->first()->city_name;
            }),
            TD::make('to_city', 'г. Получателя')->render(function (Overhead $overhead){
                return City::where('city_id', $overhead->to_city)->get()->first()->city_name;
            }),
            TD::make('from_name', 'Отправитель'),
            TD::make('to_name', 'Получатель'),
			TD::make('sum', 'Цена'),
            TD::make('comment', 'Комментарий'),
			TD::make('user_id', 'Автор')->render(function(Overhead $overhead){
				return User::find($overhead->user_id)->name;
			}),
            TD::make('actions', 'Действие')->render(function (Overhead $overhead){
                if($overhead->last_status == 1 || $overhead->last_status == 2){
					return Link::make('Редактировать')
                    	->route('platform.orders.edit', compact('overhead'));
				}
				return "Обработан";
            }),
        ];
    }
}

<?php

namespace App\Orchid\Layouts\ManagerTrack;

use App\Models\City;
use App\Models\Overhead;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class TrackTable extends Table
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
            TD::make('overhead_code', '№')->render(function (Overhead $overhead) {
                return "<div class='sola-order'><span>Заявка: </span><span class='sola-font-weight'>".$overhead->order_code."</span></div>".
                    "<div class='sola-order'><span>№: </span><span class='sola-font-weight'>".$overhead->overhead_code."</span></div>";
            }),
            TD::make('from', 'Отправитель')->render(function (Overhead $overhead){
                return "<div class='sola-order'><span>ФИО: </span><span class='sola-font-weight'>".$overhead->from_name."</span></div>".
                    "<div class='sola-order'><span>Компания: </span><span class='sola-font-weight'>".$overhead->from_company."</span></div>".
                    "<div class='sola-order'><span>Город: </span><span class='sola-font-weight'>".City::find($overhead->from_city)->city_name."</span></div>".
                    "<div class='sola-order'><span>Адрес: </span><span class='sola-font-weight'>".$overhead->from_address."</span></div>".
                    "<div class='sola-order'><span>Телефон: </span><span class='sola-font-weight'>".$overhead->from_phone."</span></div>";
            }),
            TD::make('to', 'Получатель')->render(function (Overhead $overhead){
                return "<div class='sola-order'><span>ФИО: </span><span class='sola-font-weight'>".$overhead->to_name."</span></div>".
                    "<div class='sola-order'><span>Компания: </span><span class='sola-font-weight'>".$overhead->to_company."</span></div>".
                    "<div class='sola-order'><span>Город: </span><span class='sola-font-weight'>".City::find($overhead->to_city)->city_name."</span></div>".
                    "<div class='sola-order'><span>Адрес: </span><span class='sola-font-weight'>".$overhead->to_address."</span></div>".
                    "<div class='sola-order'><span>Телефон: </span><span class='sola-font-weight'>".$overhead->to_phone."</span></div>";
            }),
            TD::make('details', 'Детали')->render(function (Overhead $overhead){
                return "<div class='sola-order'><span>Упаковка: </span><span class='sola-font-weight'>".$this->isPackage($overhead->is_package)."</span></div>".
                    "<div class='sola-order'><span>Грузчики: </span><span class='sola-font-weight'>".$this->needMovers($overhead->need_movers)."</span></div>".
                    "<div class='sola-order'><span>Масса: </span><span class='sola-font-weight'>".$overhead->mass."</span></div>".
                    "<div class='sola-order'><span>Объем: </span><span class='sola-font-weight'>".$overhead->volume."</span></div>";
            }),
            TD::make('actions', 'Действие')->render(function (Overhead $overhead){
                return ModalToggle::make("Назначить")
                    ->modal("trackDriver")
                    ->method('trackUpdate')
                    ->modalTitle("Назначить водителя на №".$overhead->overhead_code)
                    ->asyncParameters([
                        'overhead' => $overhead->id
                    ]);
            }),
        ];
    }



    public function isPackage($is_package): String{
        return match ($is_package) {
            1 => "Да",
            2 => "Нет",
            default => "Не установлен",
        };
    }
    public function needMovers($need_movers): String{
        return match ($need_movers) {
            1 => "Забор",
            2 => "Доставка",
            3 => "Оба",
            default => "Не установлен",
        };
    }
}

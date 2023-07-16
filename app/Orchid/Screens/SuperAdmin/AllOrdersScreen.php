<?php

namespace App\Orchid\Screens\SuperAdmin;

use App\Models\City;
use App\Models\User;
use App\Models\Overhead;
use App\Orchid\Filters\OverheadFilter;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class AllOrdersScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Request $request): iterable
    {
        $overheads = Overhead::filters()->paginate(100);
//        dd($overheads);
//        if ($request->overhead_code != null){
//            $overhead = Overhead::where('overhead_code', $request->overhead_code)->get()->first();
//            if($overhead != null){
//                $arr[0] = $overhead;
//                $overheads = collect($arr);
//            }else{
//                $overheads = Overhead::paginate(100);
//            }
        //}
        return [
            'overheads' => $overheads,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Все заявки';
    }
    public function commandBar(): iterable
    {
        return [
            Link::make("Создать")->route('platform.all.create.overhead')
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::wrapper('all_overheads',[
                'table'=>[
                    Layout::table('overheads', [
                        TD::make('overhead_code', '№')->filter(TD::FILTER_TEXT)->render(function (Overhead $overhead){
                            return '<a href="'.route('platform.all.edit', compact('overhead')).'">'.$overhead->overhead_code.'</a>';
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
						TD::make('sum', 'Цена'),
						TD::make('user_id','Автор')->render(function(Overhead $overhead){
							return User::find($overhead->user_id)->name;
						}),
                        TD::make('actions', 'Действие')->render(function (Overhead $overhead){
                            return Link::make('Редактировать')->icon('bs.pen')->route('platform.all.edit', compact('overhead'));
                        }),
                    ])
                ]
            ])
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
            1 => "При заборе",
            2 => "При доставке",
            3 => "Оба",
            default => "Не установлен",
        };
    }
}

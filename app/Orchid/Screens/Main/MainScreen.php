<?php

declare(strict_types=1);

namespace App\Orchid\Screens;

use App\Models\City;
use App\Models\Overhead;
use App\Models\User;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class MainScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        dd(Overhead::all());
        return [
            'overheads' => Overhead::filters()->paginate(200)
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return 'Панель управления';
    }

    /**
     * Display header description.
     */
    public function description(): ?string
    {
        return 'Добро пожаловать в систему Cabes';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]
     */
    public function layout(): iterable
    {
        return [
            Layout::table('overheads', [
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
            ])
//            Layout::view('platform::partials.update-assets'),
//            Layout::view('platform::partials.welcome'),
        ];
    }
}

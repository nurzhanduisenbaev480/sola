<?php

namespace App\Orchid\Screens\Client;

use App\Models\City;
use App\Models\Overhead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class ClientOverheadScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'overheads' => Overhead::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->paginate(100)
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Мои заявки';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Создать заявку')->icon('bs.file-plus')->route('platform.client.create')
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
                TD::make('comment', 'Комментарий'),
                TD::make('last_status', 'Статус'),
                TD::make('actions', 'Действие')->render(function (Overhead $overhead){
                    return Link::make('Смотреть')
                        ->route('platform.client.show', compact('overhead'));
                    })
            ])
        ];
    }
    public function asyncGetOverhead(Overhead $overhead): array{
        return [
            'overhead'=>$overhead
        ];
    }

    public function editOverhead(Request $request):void{
        $overhead = Overhead::find($request->input('overhead.id'))->update($request->overhead);
        if ($overhead){

        }
        Toast::info("Заявка №".$request->input('overhead.overhead_code')." обновлен");
    }
}

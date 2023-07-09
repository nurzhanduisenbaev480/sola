<?php

namespace App\Orchid\Screens\ManagerDriver;

use App\Models\City;
use App\Models\History;
use App\Models\Overhead;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class DriverEditScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Overhead $overhead): iterable
    {
        return [
            'overhead'=>$overhead
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Редактировать заявку';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Сохранить')
                ->icon('save')
                ->class('btn btn-link')
                ->method('updateOverhead'),
            Link::make('Назад')
                ->icon('arrow-left')
                ->class('btn btn-link')
                ->route('platform.driver.ordersFrom')
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
            Layout::rows([
                Input::make('overhead.id')->type('hidden'),
                Input::make('overhead.overhead_code')->placeholder('1234656')->title('№ Накладного')->readonly(),
                Input::make('overhead.from_name')->required()->placeholder('Тестов Тест')->title('ФИО Отправителя')->readonly(),
                Group::make([
                    Input::make('overhead.from_company')->placeholder('ТОО Тест')->title('Компания')->readonly(),
                    Input::make('overhead.from_phone')->placeholder('+7(777)-777-77-77')->title('Телефон')->readonly(),
                ]),
                Group::make([
                    Relation::make('overhead.from_city')->required()->placeholder('Выберите город')
                        ->fromModel(City::class, 'city_name')->title('г. Отправителя')->disabled(),
                    Input::make('overhead.from_address')->placeholder('ул Тест, ...')->title('Адрес')->readonly(),
                ]),


                Select::make('overhead.is_package')->options(['1'=>'Да', '2'=>'Нет'])->title('Упаковка'),

                TextArea::make('overhead.description')->title('Детали доставки')->rows(5),
                Button::make('Сохранить')
                    ->icon('save')
                    ->class('btn btn-link')
                    ->method('updateOverhead'),
            ])
        ];
    }
    public function updateOverhead(Overhead $overhead, Request $request):void{
        $data = $request->overhead;
        $res = Overhead::find($request->input('overhead.id'))->update($data);
        if ($res){
            Toast::info("Заявка №".$request->input('overhead.overhead_code')." обработан");
        }
    }
}

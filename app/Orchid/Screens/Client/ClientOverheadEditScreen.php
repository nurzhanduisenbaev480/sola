<?php

namespace App\Orchid\Screens\Client;

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

class ClientOverheadEditScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Overhead $overhead): iterable
    {
        return [
            'overhead' => $overhead
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Просмотр заявки';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Назад')
                ->icon('arrow-left')
                ->class('btn btn-link')
                ->route('platform.orders')
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
                Input::make('overhead.id')->type('hidden')->readonly(),
                Input::make('overhead.overhead_code')->placeholder('1234656')->title('№ Накладного')->readonly(),
                Input::make('overhead.from_name')->required()->placeholder('Тестов Тест')->title('ФИО Отправителя')->readonly(),
                Group::make([
                    Input::make('overhead.from_company')->placeholder('ТОО Тест')->title('Компания')->readonly(),
                    Input::make('overhead.from_phone')->placeholder('+7(777)-777-77-77')->title('Телефон')->readonly(),
                ]),
                Group::make([
                    Relation::make('overhead.from_city')->required()->placeholder('Выберите город')->fromModel(City::class, 'city_name')->title('г. Отправителя')->disabled(),
                    Input::make('overhead.from_address')->placeholder('ул Тест, ...')->title('Адрес')->readonly(),
                ]),
                Input::make('overhead.to_name')->required()->placeholder('Тестов Тест')->title('ФИО Получателя')->readonly(),
                Group::make([
                    Input::make('overhead.to_company')->placeholder('ТОО Тест')->title('Компания')->readonly(),
                    Input::make('overhead.to_phone')->placeholder('+7(777)-777-77-77')->title('Телефон')->readonly(),
                ]),
                Group::make([
                    Relation::make('overhead.to_city')->required()->placeholder('Выберите город')->fromModel(City::class, 'city_name')->title('г. Получателя')->disabled(),
                    Input::make('overhead.to_address')->placeholder('ул Тест, ...')->title('Адрес')->readonly(),
                ]),
                Relation::make('overhead.counterparty')->fromModel(User::class, 'name')->title('Контрагент')->disabled(),
                Group::make([
                    Select::make('overhead.company_type')->options(['1'=>'Юр.лицо', '2'=>'Физ.лицо'])->title('Юр/Физ лицо')->disabled(),
                    Select::make('overhead.is_package')->options(['1'=>'Да', '2'=>'Нет'])->title('Упаковка')->disabled(),
                    Select::make('overhead.need_movers')->options(['1'=>'При заборе', '2'=>'При доставка', '3'=>'Оба'])->title('Грузчики')->disabled(),
                ]),
                Group::make([
                    Input::make('overhead.mass')->placeholder('0.0')->title('Масса(кг)')->readonly(),
                    Input::make('overhead.length')->placeholder('0.0')->title('Длина(см)')->readonly(),
                    Input::make('overhead.width')->placeholder('0.0')->title('Ширина(см)')->readonly(),
                    Input::make('overhead.height')->placeholder('0.0')->title('Высота(см)')->readonly(),
                ]),
                TextArea::make('overhead.comment')->title('Комментарий')->rows(5)->readonly(),
                //TextArea::make('overhead.description')->title('Детали доставки')->rows(5),
            ])
        ];
    }

}

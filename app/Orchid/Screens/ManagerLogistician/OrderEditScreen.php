<?php

namespace App\Orchid\Screens\ManagerLogistician;

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
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class OrderEditScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Overhead $overhead): iterable
    {
        $histories = $overhead->getHistories()->where('status_id', '2')->get()->first();
        if ($histories == null){
            $overhead->last_status = 2;
            $overhead->save();
            $history = History::create([
                'status_id' => 2,
                'user_id' => Auth::user()->id,
                'overhead_id'=>$overhead->id,
                'history_name'=>'В обработке',
                'is_show'=>1
            ]);
        }
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
        return 'Обработка заявки';
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
                Input::make('overhead.id')->type('hidden'),
                Input::make('overhead.overhead_code')->placeholder('1234656')->title('№ Накладного'),
                Input::make('overhead.from_name')->required()->placeholder('Тестов Тест')->title('ФИО Отправителя'),
                Group::make([
                    Input::make('overhead.from_company')->placeholder('ТОО Тест')->title('Компания'),
                    Input::make('overhead.from_phone')->placeholder('+7(777)-777-77-77')->title('Телефон'),
                ]),
                Group::make([
                    Relation::make('overhead.from_city')->required()->placeholder('Выберите город')->fromModel(City::class, 'city_name')->title('г. Отправителя'),
                    Input::make('overhead.from_address')->placeholder('ул Тест, ...')->title('Адрес'),
                ]),
                Input::make('overhead.to_name')->required()->placeholder('Тестов Тест')->title('ФИО Получателя'),
                Group::make([
                    Input::make('overhead.to_company')->placeholder('ТОО Тест')->title('Компания'),
                    Input::make('overhead.to_phone')->placeholder('+7(777)-777-77-77')->title('Телефон'),
                ]),
                Group::make([
                    Relation::make('overhead.to_city')->required()->placeholder('Выберите город')->fromModel(City::class, 'city_name')->title('г. Получателя'),
                    Input::make('overhead.to_address')->placeholder('ул Тест, ...')->title('Адрес'),
                ]),
                Relation::make('overhead.counterparty')->fromModel(User::class, 'name')->title('Контрагент'),
                Group::make([
                    Select::make('overhead.company_type')->options(['1'=>'Юр.лицо', '2'=>'Физ.лицо'])->title('Юр/Физ лицо'),
                    Select::make('overhead.is_package')->options(['1'=>'Да', '2'=>'Нет'])->title('Упаковка'),
                    Select::make('overhead.need_movers')->options(['1'=>'При заборе', '2'=>'При доставка', '3'=>'Оба'])->title('Грузчики'),
                ]),
                Group::make([
                    Input::make('overhead.mass')->placeholder('0.0')->title('Масса(кг)'),
                    Input::make('overhead.length')->placeholder('0.0')->title('Длина(см)'),
                    Input::make('overhead.width')->placeholder('0.0')->title('Ширина(см)'),
                    Input::make('overhead.height')->placeholder('0.0')->title('Высота(см)'),
                ]),
				Group::make([
					Input::make('overhead.sum')->placeholder('Введите сумму')->title('Сумма(тг)'),
					DateTimer::make('overhead.order_start_date')
					->title('Дата начало')
					->format24hr()
					->enableTime(),
				]),
				Group::make([
					Input::make('overhead.product_name')->title('Наименование товаров'),
					Input::make('overhead.place')->title('Количество мест'),
				]),
                TextArea::make('overhead.comment')->title('Комментарий')->rows(5),
                //TextArea::make('overhead.description')->title('Детали доставки')->rows(5),
                Button::make('Сохранить')
                    ->icon('save')
                    ->class('btn btn-link')
                    ->method('updateOverhead'),
            ])
        ];
    }

    public function updateOverhead(Overhead $overhead, Request $request):void{
        $data = $request->overhead;
        $data['last_status'] = 3;
        $res = Overhead::find($request->input('overhead.id'))->update($data);
        if ($res){
            $history = History::create([
                'status_id' => 3,
                'user_id' => Auth::user()->id,
                'overhead_id'=>$overhead->id,
                'history_name'=>'Заявка обработан',
                'is_show'=>1
            ]);
            if ($history){
                Toast::info("Заявка №".$request->input('overhead.overhead_code')." обработан");
            }
        }

    }
}

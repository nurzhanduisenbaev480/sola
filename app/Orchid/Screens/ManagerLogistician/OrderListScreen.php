<?php

namespace App\Orchid\Screens\ManagerLogistician;

use App\Models\City;
use App\Models\History;
use App\Models\User;
use App\Models\Overhead;
use App\Orchid\Layouts\ManagerLogistician\OrderTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Modal;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class OrderListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        $overheads = Overhead::whereIn('last_status', [1,2])->paginate(100);

        return [
            'overheads'=>$overheads,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Панель логиста';
    }

    /**
     * The screen's action buttons.
     *
     * @return Action[]
     */
    public function commandBar(): iterable
    {
        return [
            ModalToggle::make('Создать заявку')->modal('createOverhead')->method("createOverhead"),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            OrderTable::class,
            Layout::modal('createOverhead', Layout::rows([
                Input::make('overhead_code')->placeholder('1234656')->title('№ Накладного(при необходимости)'),
                Input::make('from_name')->required()->placeholder('Тестов Тест')->title('ФИО Отправителя'),
                Group::make([
                    Input::make('from_company')->placeholder('ТОО Тест')->title('Компания'),
                    Input::make('from_phone')->placeholder('+7(777)-777-77-77')->title('Телефон'),
                ]),
                Group::make([
                    Relation::make('from_city')->required()->placeholder('Выберите город')->fromModel(City::class, 'city_name')->title('г. Отправителя'),
                    Input::make('from_address')->placeholder('ул Тест, ...')->title('Адрес'),
                ]),
                Input::make('to_name')->required()->placeholder('Тестов Тест')->title('ФИО Получателя'),
                Group::make([
                    Input::make('to_company')->placeholder('ТОО Тест')->title('Компания'),
                    Input::make('to_phone')->placeholder('+7(777)-777-77-77')->title('Телефон'),
                ]),
                Group::make([
                    Relation::make('to_city')->required()->placeholder('Выберите город')->fromModel(City::class, 'city_name')->title('г. Получателя'),
                    Input::make('to_address')->placeholder('ул Тест, ...')->title('Адрес'),
                ]),
                Relation::make('counterparty')->fromModel(User::class, 'name')->title('Контрагент'),
                Group::make([
                    Select::make('company_type')->options(['1'=>'Юр.лицо', '2'=>'Физ.лицо'])->title('Юр/Физ лицо'),
                    Select::make('is_package')->options(['1'=>'Да', '2'=>'Нет'])->title('Упаковка'),
                    Select::make('need_movers')->options(['1'=>'Забор', '2'=>'Доставка', '3'=>'Оба'])->title('Грузчики'),
                ]),
                Group::make([
                    Input::make('mass')->placeholder('0.0')->title('Масса'),
                    Input::make('length')->placeholder('0.0')->title('Длина'),
                    Input::make('width')->placeholder('0.0')->title('Ширина'),
                    Input::make('height')->placeholder('0.0')->title('Высота'),
                ]),
                TextArea::make('comment')->title('Комментарий')->rows(5),
                TextArea::make('description')->title('Детали доставки')->rows(5),
            ]))->title('Создание заявки')
                ->size(Modal::SIZE_LG)
                ->applyButton('Создать'),
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

    public function createOverhead(Request $request): void{
        //dd($request);
        $data = $request->except(['_token', '_state']);
        $overhead_code = "";
        $order_code = "";
        $lastOverhead = Overhead::where(DB::raw('LENGTH(overhead_code)'),'<','8')->orderBy('id', 'DESC')->first();
        if ($data["overhead_code"] == null){
            if($lastOverhead == null){
                $overhead_code = "100000";
                $order_code = "KZ100000";
            }else{
                $overhead_code = intval($lastOverhead->overhead_code) + 1;
                $order_code = intval(ltrim($lastOverhead->order_code, "KZ")) + 1;
            }
        }else{
            $overhead_code = $data["overhead_code"];
            if($lastOverhead == null){
                $order_code = "KZ100000";
            }else{
                $order_code = intval(ltrim($lastOverhead->order_code, "KZ")) + 1;
            }
        }
        $data["order_code"] = "KZ".$order_code;
        $data["overhead_code"] = $overhead_code;
        $data["volume"] = floatval($data["width"]) * floatval($data["length"]) * floatval($data["height"]);
        $data["order_start_date"] = date("Y-m-d H:i:s");
        $data["user_id"] = Auth::user()->id;
        $data["last_status"] = 1;
        //dd($data);
        $overhead = Overhead::create($data);
        if ($overhead){
            $history = History::create([
                'status_id' => 1,
                'user_id' => Auth::user()->id,
                'overhead_id'=>$overhead->id,
                'history_name'=>'Новая заявка',
                'is_show'=>1
            ]);
            if ($history){
                Toast::info("Заявка под номером №".$overhead->overhead_code." была создана");
            }
        }else{
            Toast::warning("Заявка не создалась. Пожалуйста проверьте полей, или обратитесь к администратору");
        }

    }
}

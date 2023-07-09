<?php

namespace App\Orchid\Screens\Client;

use App\Models\City;
use App\Models\History;
use App\Models\Overhead;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class ClientOverheadCreateScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Создать заявку';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Сохранить')->icon('bs.file-plus')->method('createOverhead')
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
                Group::make([
                    Select::make('counterparty')->fromQuery(User::where("type", "counterparty")->where('author', Auth::user()->id), 'name')->title('Контрагент'),
                    ModalToggle::make('Добавить Юр-лицо контрагент')
                        ->modal('createCounterparty1')
                        ->method("createCounterparty1")
                        ->style('position:absolute;'),
                    ModalToggle::make('Добавить Физ-лицо контрагент')
                        ->modal('createCounterparty2')
                        ->method("createCounterparty2")
                        ->style('position:absolute;'),
                ]),
                Group::make([
                    Select::make('company_type')->options(['1'=>'Юр.лицо', '2'=>'Физ.лицо'])->title('Юр/Физ лицо'),
                    Select::make('is_package')->options(['1'=>'Да', '2'=>'Нет'])->title('Упаковка'),
                    Select::make('need_movers')->options(['1'=>'При заборе', '2'=>'При доставке', '3'=>'Оба'])->title('Грузчики'),
                ]),
                Group::make([
                    Input::make('mass')->placeholder('0.0')->title('Масса(кг)'),
                    Input::make('length')->placeholder('0.0')->title('Длина(см)'),
                    Input::make('width')->placeholder('0.0')->title('Ширина(см)'),
                    Input::make('height')->placeholder('0.0')->title('Высота(см)'),
                ]),
                TextArea::make('comment')->title('Комментарий')->rows(5),
                //TextArea::make('description')->title('Детали доставки')->rows(5),
                Button::make('Сохранить')->icon('bs.file-plus')->method('createOverhead')
            ]),
            Layout::modal('createCounterparty1', Layout::rows([
                Input::make('company_name')->title('Полное название')->placeholder(''),
                Input::make('company_address')->title('Юридический адрес')->placeholder(''),
                Input::make('company_real_address')->title('Фактический адрес')->placeholder(''),
                Input::make('bin')->title('БИН')->placeholder(''),
                Input::make('bik')->title('БИК')->placeholder(''),
                Input::make('payment_card')->title('Расчетный счет')->placeholder(''),
                Input::make('bank_name')->title('Название Банка')->placeholder(''),
                Input::make('director_name')->title('ФИО Директора')->placeholder(''),
                Input::make('email')->title('Email')->placeholder(''),
                Input::make('phone')->title('Контактный номер')->placeholder(''),
                Input::make('author')->type('hidden'),
                Upload::make('attachment')->title('Загрузить Договор')
            ]))->title('Добавить контрагент'),
            Layout::modal('createCounterparty2', Layout::rows([
                Input::make('name')->title('ФИО')->placeholder(''),
                Input::make('author')->type('hidden'),
                Input::make('iin')->title('ИИН')->placeholder(''),
                Select::make('payment_type')->options([
                    'Наличные'=>'Наличными',
                    'Карта'=>'Каспи',
                    'Иное'=>'Иное',
                ]),
                Upload::make('attachment')->title('Загрузить Договор')
            ]))->title('Добавить контрагент'),
        ];
    }
    public function createCounterparty1(Request $request){
        $data = $request->except('_token');
        if (empty($data['email'])){
            $data['email'] = strtolower(str_replace(" ", "", $data['company_name']))."@cabes.com";
        }
        $data['password'] = Hash::make('12345');
        $data['name'] = $request->company_name;
        $data['type'] = 'counterparty';
        $data['author'] = Auth::user()->id;
        $user = User::create($data);
        $user->attachment()->syncWithoutDetaching(
            $request->input('attachment', [])
        );
        if($user){
            Toast::info('Контрагент создан');
        }
        //dd($data);
    }
    public function createCounterparty2(Request $request){
        $data = $request->except('_token');
        if (empty($data['email'])){
            $data['email'] = strtolower(str_replace(" ", "", $data['name']))."@cabes.com";
        }
        $data['password'] = Hash::make('12345');
        $data['name'] = $request->name;
        $data['type'] = 'counterparty';
        $data['author'] = Auth::user()->id;
        $user = User::create($data);
        $user->attachment()->syncWithoutDetaching(
            $request->input('attachment', [])
        );
        if($user){

            Toast::info('Контрагент создан');
        }
        //dd($data);
    }
    public function createOverhead(Request $request){
        //dd($request);
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

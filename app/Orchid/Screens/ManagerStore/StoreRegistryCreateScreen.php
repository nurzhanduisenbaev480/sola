<?php

namespace App\Orchid\Screens\ManagerStore;

use App\Models\City;
use App\Models\History;
use App\Models\Overhead;
use App\Models\Registry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class StoreRegistryCreateScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'overheads'=>Overhead::where('last_status', 8)->paginate(100)
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Создать Реестр';
    }

    /**
     * The screen's action buttons.
     *
     * @return Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Назад')->icon('bs.arrow-left')->route('platform.registry'),
            Button::make('Создать')->method('createRegistry')->icon('bs.save')
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
            Layout::wrapper('registry_create', [
                'left_panels' => [
                    Layout::rows([
                        Input::make('user_id')->type('hidden')->value(Auth::user()->id),
                        Relation::make('from_city')->fromModel(City::class, 'city_name')->placeholder('Выберите город отправки'),
                        Relation::make('to_city')->fromModel(City::class, 'city_name')->placeholder('Выберите город доставки'),
                        Button::make('Создать')->method('createRegistry')->icon('bs.save')
                    ])
                ],
                'right_panels' => [
                    Layout::table('overheads', [
                        TD::make('id', 'ID')
                            ->render(function (Overhead $overhead){
                                return CheckBox::make('overheads[]')
                                    ->value($overhead->id)
                                    ->checked(false);
                            }),
                        TD::make('overhead_code', '№ Накл-й'),
                        TD::make('from_city', 'г. Отправителя')->render(function(Overhead $overhead){return City::find($overhead->from_city)->city_name;}),
                        TD::make('to_city', 'г. Получателя')->render(function(Overhead $overhead){return City::find($overhead->to_city)->city_name;}),
                        TD::make('from_name', 'Отправитель'),
                        TD::make('to_name', 'Получатель'),
                    ])
                ],
            ]),
        ];
    }
    public function createRegistry(Request $request):void{
        $data["registry"] = $request->except(["_token", "_state", "overheads"]);
        $data["registry"]["status_id"] = 14;
        $data["overheads"] = $request->overheads;
        //dd($data["overheads"]);
        $registry = Registry::create($data["registry"]);
        if ($registry){
            $overheads = Overhead::whereIn('id', $data["overheads"]);
            //dd($overheads->get());
            $res = $overheads->update(['registry_id'=> $registry->id, 'last_status'=>9]);
            if ($res){
                foreach ($overheads->get() as $overhead){
                    $history = History::create([
                        'status_id' => 9,
                        'user_id' => Auth::user()->id,
                        'overhead_id'=>$overhead->id,
                        'history_name'=>'На доставке',
                        'is_show'=>1
                    ]);
                }
                Toast::info("Реестр создан");
            }
        }
    }
}

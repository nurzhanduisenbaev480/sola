<?php

namespace App\Orchid\Screens\SuperAdmin;

use App\Models\City;
use App\Models\History;
use App\Models\Overhead;
use App\Models\Registry;
use App\Models\Status;
use App\Models\Transport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class RegistryEditScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Request $request, Registry $registry): iterable
    {
//dd($request);
//        $overheads = Overhead::where('registry_id', $request->registry_id)->get();
        $overheads = Overhead::where('registry_id', $registry->id)->filters()->paginate(100);
        return [
            'registry' =>$registry,
            'overheads' =>$overheads
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Редактировать реестр';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Назад')->route('platform.all.registry')
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
            Layout::wrapper('all_registry_create', [
                'left_panels' => [
                    Layout::rows([
                        Input::make('registry.user_id')->type('hidden')->value(Auth::user()->id),
                        Relation::make('registry.from_city')->fromModel(City::class, 'city_name')->placeholder('Выберите город отправки'),
                        Relation::make('registry.to_city')->fromModel(City::class, 'city_name')->placeholder('Выберите город доставки'),
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
//                        TD::make('overhead_code', '№ Накл-й')->render(function (Overhead $overhead){
//                            return '<a href="'.route('platform.all.edit2', compact('overhead')).'">'.$overhead->overhead_code.'</a>';
//                        }),
                        TD::make('overhead_code', '№ Накл-й')->filter(),
                        TD::make('from_city', 'г. Отправителя')
                            ->render(function(Overhead $overhead){return City::find($overhead->from_city)->city_name;})->sort(),
                        TD::make('to_city', 'г. Получателя')
                            ->render(function(Overhead $overhead){return City::find($overhead->to_city)->city_name;}),
                        TD::make('from_name', 'Отправитель'),
                        TD::make('to_name', 'Получатель'),
                        TD::make('actions')->render(function (Overhead $overhead){
                            return ModalToggle::make('Сменить статус')
                                ->modal('updateStatus')
                                ->method('updateStatus')
                                ->modalTitle('Сменить статус')
                                ->asyncParameters([
                                   'overhead'=>$overhead->id
                                ]);
                        })
                    ]),
                    Layout::modal('updateStatus', Layout::rows([
                        Input::make('overhead.id')->type('hidden'),
                        Relation::make('overhead.last_status')->title('Статус')
                            ->fromModel(Status::class, "status_name"),
                    ]))->async('asyncGetTrack')
                ],
            ]),
        ];
    }
    public function updateStatus(Overhead $overhead, Request $request):void{
        $data = $request->overhead;
        //$data["last_status"] = $request->input('overhead.last_status');
        //dd($data);
        $overhead = Overhead::find($request->input('overhead.id'));
        $overhead->update($data);
        $history = History::create([
            'status_id' => $request->input('overhead.last_status'),
            'user_id' => Auth::user()->id,
            'overhead_id'=>$overhead->id,
            'history_name'=>Status::find($request->input('overhead.last_status'))->status_name,
            'is_show'=>1
        ]);
        if ($history){
            Toast::info("Водитель на заявку №".$overhead->overhead_code." назначен");
        }
    }
    public function asyncGetTrack(Overhead $overhead):array{
        return [
            'overhead'=>$overhead
        ];
    }
}

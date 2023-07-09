<?php

namespace App\Orchid\Screens\ManagerStore;

use App\Models\City;
use App\Models\Overhead;
use App\Models\Registry;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class StoreRegistryEditScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Registry $registry): iterable
    {
        $overheads = Overhead::where('registry_id', $registry->id)->get();
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

    public function commandBar(): iterable
    {
        return [
            Link::make('Назад')->route('platform.registry')
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
            Layout::wrapper('registry_create', [
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
                        TD::make('overhead_code', '№ Накл-й'),
                        TD::make('from_city', 'г. Отправителя')
                            ->render(function(Overhead $overhead){return City::find($overhead->from_city)->city_name;})->sort(),
                        TD::make('to_city', 'г. Получателя')
                            ->render(function(Overhead $overhead){return City::find($overhead->to_city)->city_name;}),
                        TD::make('from_name', 'Отправитель'),
                        TD::make('to_name', 'Получатель'),
                    ])
                ],
            ]),
        ];
    }
}

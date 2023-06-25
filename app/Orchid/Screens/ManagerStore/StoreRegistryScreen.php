<?php

namespace App\Orchid\Screens\ManagerStore;

use App\Models\City;
use App\Models\Registry;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class StoreRegistryScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'registries' => Registry::where('from_city', Auth::user()->from_city)
                ->orWhere('to_city', Auth::user()->from_city)
                ->orderBy('id', 'DESC')->paginate(100)
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Список Реестров';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Создать')->icon('bs.file-word')->route('platform.store.create')
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
            Layout::table('registries', [
                TD::make('from_city', 'Откуда')->render(function(Registry $registry){
                    return City::find($registry->from_city)->city_name;
                }),
                TD::make('to_city', 'Куда')->render(function(Registry $registry){
                    return City::find($registry->to_city)->city_name;
                }),
                TD::make('user_id', 'Автор')->render(function(Registry $registry){
                    return User::find($registry->user_id)->name;
                }),
                TD::make('actions', 'Действие')->render(function (Registry $registry){
                    return Link::make('Печать')
                        ->icon('bs.printer')
                        ->route('platform.registry.printPdf', compact('registry'));
                })->width(100)
            ]),

        ];
    }
}

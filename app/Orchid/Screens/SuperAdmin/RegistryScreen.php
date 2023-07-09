<?php

namespace App\Orchid\Screens\SuperAdmin;

use App\Models\City;
use App\Models\Registry;
use App\Models\User;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class RegistryScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'registries'=>Registry::filters()->paginate(100)
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Реестр';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
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
                TD::make('from_city', 'Откуда')->sort()->render(function(Registry $registry){
                    return "<a href=".route('platform.all.registry.edit', compact('registry')).">".City::find($registry->from_city)->city_name."</a>";
                }),
                TD::make('to_city', 'Куда')->sort()->render(function(Registry $registry){
                    return "<a href=".route('platform.all.registry.edit', compact('registry')).">".City::find($registry->to_city)->city_name."</a>";
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

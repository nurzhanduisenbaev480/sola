<?php

declare(strict_types=1);

namespace App\Orchid;

use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;
use Orchid\Support\Color;

class PlatformProvider extends OrchidServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @param Dashboard $dashboard
     *
     * @return void
     */
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);

        // ...
    }

    /**
     * Register the application menu.
     *
     * @return Menu[]
     */
    public function menu(): array
    {
        return [
            Menu::make('Панель Управления')
                ->icon('bs.display')
                ->title('Главная')
                ->route(config('platform.index')),
            Menu::make('Заявки')
                ->icon('bs.handbag')
                ->route('platform.orders'),
            Menu::make('Забор')
                ->icon('bs.calendar')
                ->route('platform.tracks'),
            Menu::make('Заявки Водителя')
                ->slug('driver-menu')
                ->icon('bs.list-ul')
                ->list([
                    Menu::make('Заявки1')
                        ->route('platform.driver.ordersFrom')
                        ->icon('bs.cart'),
                    Menu::make('Заявки2')
                        ->route('platform.driver.ordersTo')
                        ->icon('bs.cart-check'),
                ]),
            Menu::make('Склад')
                ->slug('store-menu')
                ->icon('bs.shop-window')
                ->list([
                    Menu::make('Заявки')
                        ->route('platform.store')
                        ->icon('bs.cart'),
                    Menu::make('Реестр')
                        ->route('platform.registry')
                        ->icon('bs.file-word'),
                ]),

            Menu::make(__('Users'))
                ->icon('bs.people')
                ->route('platform.systems.users')
                ->permission('platform.systems.users')
                ->title(__('Панель Супер Админа')),

            Menu::make(__('Roles'))
                ->icon('bs.lock')
                ->route('platform.systems.roles')
                ->permission('platform.systems.roles')
                ->divider(),
        ];
    }

    /**
     * Register permissions for the application.
     *
     * @return ItemPermission[]
     */
    public function permissions(): array
    {
        return [
            ItemPermission::group(__('System'))
                ->addPermission('platform.systems.roles', __('Roles'))
                ->addPermission('platform.systems.users', __('Users')),
        ];
    }
}

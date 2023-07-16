<?php

declare(strict_types=1);

use App\Http\Controllers\StatusController;
use App\Orchid\Screens\Client\ClientOverheadCreateScreen;
use App\Orchid\Screens\Client\ClientOverheadEditScreen;
use App\Orchid\Screens\Client\ClientOverheadScreen;
use App\Orchid\Screens\Examples\ExampleActionsScreen;
use App\Orchid\Screens\Examples\ExampleCardsScreen;
use App\Orchid\Screens\Examples\ExampleChartsScreen;
use App\Orchid\Screens\Examples\ExampleFieldsAdvancedScreen;
use App\Orchid\Screens\Examples\ExampleFieldsScreen;
use App\Orchid\Screens\Examples\ExampleLayoutsScreen;
use App\Orchid\Screens\Examples\ExampleScreen;
use App\Orchid\Screens\Examples\ExampleTextEditorsScreen;
use App\Orchid\Screens\MainScreen;
use App\Orchid\Screens\ManagerDriver\DriverEditScreen;
use App\Orchid\Screens\ManagerDriver\DriverListScreen;
use App\Orchid\Screens\ManagerLogistician\OrderCreateScreen;
use App\Orchid\Screens\ManagerLogistician\OrderEditScreen;
use App\Orchid\Screens\ManagerLogistician\OrderListScreen;
use App\Orchid\Screens\ManagerStore\StoreEditScreen;
use App\Orchid\Screens\ManagerStore\StoreRegistryCreateScreen;
use App\Orchid\Screens\ManagerStore\StoreRegistryEditScreen;
use App\Orchid\Screens\ManagerStore\StoreRegistryScreen;
use App\Orchid\Screens\ManagerTrack\TrackListScreen;
use App\Orchid\Screens\ManagerStore\StoreListScreen;
use App\Orchid\Screens\PlatformScreen;
use App\Orchid\Screens\Role\RoleEditScreen;
use App\Orchid\Screens\Role\RoleListScreen;
use App\Orchid\Screens\SuperAdmin\AllOrdersScreen;
use App\Orchid\Screens\SuperAdmin\CounterpartyEditScreen;
use App\Orchid\Screens\SuperAdmin\CounterpartyScreen;
use App\Orchid\Screens\SuperAdmin\OverheadEditScreen;
use App\Orchid\Screens\SuperAdmin\RegistryEditScreen;
use App\Orchid\Screens\SuperAdmin\RegistryOverheadEditScreen;
use App\Orchid\Screens\SuperAdmin\RegistryScreen;
use App\Orchid\Screens\SuperAdmin\SuperOverheadCreateScreen;
use App\Orchid\Screens\User\UserEditScreen;
use App\Orchid\Screens\User\UserListScreen;
use App\Orchid\Screens\User\UserProfileScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the need "dashboard" middleware group. Now create something great!
|
*/

// Main
//Route::screen('/main', PlatformScreen::class)
//    ->name('platform.main');
Route::screen('/main', MainScreen::class)
    ->name('platform.index');

// Manager Logistical Panel
Route::screen('/orders', OrderListScreen::class)
    ->name('platform.orders');
Route::screen('/orders/edit/{overhead}', OrderEditScreen::class)
    ->name('platform.orders.edit');
Route::screen('/orders/create', OrderCreateScreen::class)
    ->name('platform.orders.create');

// Manager Track Panel
Route::screen('/tracks', TrackListScreen::class)
    ->name('platform.tracks');
// Driver Panel
Route::screen('/driver/orders-from', DriverListScreen::class)
    ->name('platform.driver.ordersFrom');
Route::screen('/driver/orders-to', DriverListScreen::class)
    ->name('platform.driver.ordersTo');
Route::screen('/driver/order/edit/{overhead}', DriverEditScreen::class)
    ->name('platform.driver.edit');

Route::get('/driver/change-accept', [StatusController::class, 'changeAccept'])->name('platform.driver.changeAccept');
Route::get('/driver/change-take', [StatusController::class, 'changeTake'])->name('platform.driver.changeTake');
Route::get('/driver/change-finish', [StatusController::class, 'changeFinish'])->name('platform.driver.changeFinish');

// Store Panel
Route::screen('/store', StoreListScreen::class)
    ->name('platform.store');
Route::screen('/store/registry', StoreRegistryScreen::class)
    ->name('platform.registry');
Route::screen('/store/registry/edit/{registry}', StoreRegistryEditScreen::class)
    ->name('platform.registry.edit');
Route::screen('/store/edit/{overhead}', StoreEditScreen::class)
    ->name('platform.store.edit');
Route::screen('/store/create', StoreRegistryCreateScreen::class)
    ->name('platform.store.create');

// Super Admin Panel
Route::screen('/super/allOverheads', AllOrdersScreen::class)
    ->name('platform.all');
Route::screen('/super/allOverheads/create', SuperOverheadCreateScreen::class)
    ->name('platform.all.create.overhead');
Route::screen('/super/edit/{overhead}', OverheadEditScreen::class)
    ->name('platform.all.edit');
Route::screen('/super/registry', RegistryScreen::class)
    ->name('platform.all.registry');
Route::screen('/super/registry/edit/{registry}', RegistryEditScreen::class)
    ->name('platform.all.registry.edit');
Route::screen('/super/edit2/{overhead}', RegistryOverheadEditScreen::class)
    ->name('platform.all.edit2');
Route::screen('/super/counterparty', CounterpartyScreen::class)
    ->name('platform.all.counterparty');
Route::screen('super/{user}/edit', CounterpartyEditScreen::class)
    ->name('platform.all.counterparty.edit');

// Client
Route::screen('/client/overheads', ClientOverheadScreen::class)
    ->name('platform.client');
Route::screen('/client/overheads/create', ClientOverheadCreateScreen::class)
    ->name('platform.client.create');
Route::screen('/client/overheads/show/{overhead}', ClientOverheadEditScreen::class)
    ->name('platform.client.show');

// Platform > Profile
Route::screen('profile', UserProfileScreen::class)
    ->name('platform.profile')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Profile'), route('platform.profile')));



// Platform > System > Users > User
Route::screen('users/{user}/edit', UserEditScreen::class)
    ->name('platform.systems.users.edit')
    ->breadcrumbs(fn (Trail $trail, $user) => $trail
        ->parent('platform.systems.users')
        ->push($user->name, route('platform.systems.users.edit', $user)));

// Platform > System > Users > Create
Route::screen('users/create', UserEditScreen::class)
    ->name('platform.systems.users.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.systems.users')
        ->push(__('Create'), route('platform.systems.users.create')));

// Platform > System > Users
Route::screen('users', UserListScreen::class)
    ->name('platform.systems.users')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Users'), route('platform.systems.users')));

// Platform > System > Roles > Role
Route::screen('roles/{role}/edit', RoleEditScreen::class)
    ->name('platform.systems.roles.edit')
    ->breadcrumbs(fn (Trail $trail, $role) => $trail
        ->parent('platform.systems.roles')
        ->push($role->name, route('platform.systems.roles.edit', $role)));

// Platform > System > Roles > Create
Route::screen('roles/create', RoleEditScreen::class)
    ->name('platform.systems.roles.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.systems.roles')
        ->push(__('Create'), route('platform.systems.roles.create')));

// Platform > System > Roles
Route::screen('roles', RoleListScreen::class)
    ->name('platform.systems.roles')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Roles'), route('platform.systems.roles')));

// Example...
Route::screen('example', ExampleScreen::class)
    ->name('platform.example')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push('Example Screen'));

Route::screen('/form/examples/fields', ExampleFieldsScreen::class)->name('platform.example.fields');
Route::screen('/form/examples/advanced', ExampleFieldsAdvancedScreen::class)->name('platform.example.advanced');
Route::screen('/form/examples/editors', ExampleTextEditorsScreen::class)->name('platform.example.editors');
Route::screen('/form/examples/actions', ExampleActionsScreen::class)->name('platform.example.actions');

Route::screen('/layout/examples/layouts', ExampleLayoutsScreen::class)->name('platform.example.layouts');
Route::screen('/charts/examples/charts', ExampleChartsScreen::class)->name('platform.example.charts');
Route::screen('/cards/examples/cards', ExampleCardsScreen::class)->name('platform.example.cards');

//Route::screen('idea', Idea::class, 'platform.screens.idea');

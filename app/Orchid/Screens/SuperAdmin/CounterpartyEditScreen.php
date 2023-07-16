<?php

namespace App\Orchid\Screens\SuperAdmin;

use App\Models\City;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Orchid\Access\Impersonation;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class CounterpartyEditScreen extends Screen
{
    public $user;
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(User $user): iterable
    {
        $user->load('roles');
        return [
            'user'=>$user,
            'permission'=>$user->getStatusPermission()
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->user->exists ? 'Edit User' : 'Create User';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make(__('Impersonate user'))
                ->icon('bg.box-arrow-in-right')
                ->confirm(__('You can revert to your original state by logging out.'))
                ->method('loginAs')
                ->canSee($this->user->exists && \request()->user()->id !== $this->user->id),

            Button::make(__('Remove'))
                ->icon('bs.trash3')
                ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                ->method('remove')
                ->canSee($this->user->exists),

            Button::make(__('Save'))
                ->icon('bs.check-circle')
                ->method('save'),
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
                Input::make('user.type')->value('counterparty')->hidden(),
                Input::make('user.name')
                    ->type('text')
                    ->max(255)
                    ->required()
                    ->title(__('Name'))
                    ->placeholder(__('Name')),

                Input::make('user.email')
                    ->type('email')
                    ->required()
                    ->title(__('Email'))
                    ->placeholder(__('Email')),
                Input::make('user.username')
                    ->type('text')
                    ->title('Логин'),
                Input::make('user.from_company')
                    ->type('text')
                    ->title('Компания'),
                Select::make('user.from_city')
                    ->fromModel(City::class, 'city_name')
                    ->title('Город'),
                Input::make('user.from_address')
                    ->type('text')
                    ->title('Адрес'),
                Input::make('user.from_phone')
                    ->type('text')
                    ->title('Телефон'),
                Select::make('user.type')
                    ->options([
                        'counterparty'=>'Контрагент',
                    ])
                    ->title('Тип пользователя'),
                Upload::make('user.attachment')->title('Загрузить договор'),
                Button::make(__('Save'))
                    ->icon('bs.check-circle')
                    ->method('save'),
            ])
        ];
    }
    public function save(User $user, Request $request)
    {
        //dd($user);
        $request->validate([
            'user.email' => [
                'required',
                Rule::unique(User::class, 'email')->ignore($user),
            ],
        ]);

        $permissions = collect($request->get('permissions'))
            ->map(fn ($value, $key) => [base64_decode($key) => $value])
            ->collapse()
            ->toArray();

        $user->when($request->filled('user.password'), function (Builder $builder) use ($request) {
            $builder->getModel()->password = Hash::make($request->input('user.password'));
        });
        $user->attachment()->syncWithoutDetaching(
            $request->input('user.attachment', [])
        );
        $user
            ->fill($request->collect('user')->except(['password', 'permissions', 'roles'])->toArray())
            ->fill(['permissions' => $permissions])
            ->save();

        $user->replaceRoles($request->input('user.roles'));

        Toast::info(__('User was saved.'));

        return redirect()->route('platform.all.counterparty');
    }

    /**
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(User $user)
    {
        $user->delete();

        Toast::info(__('User was removed'));

        return redirect()->route('platform.systems.users');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function loginAs(User $user)
    {
        Impersonation::loginAs($user);

        Toast::info(__('You are now impersonating this user'));

        return redirect()->route(config('platform.index'));
    }
}

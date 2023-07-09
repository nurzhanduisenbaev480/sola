<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\User;

use App\Models\City;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Rows;

class UserEditLayout extends Rows
{
    /**
     * The screen's layout elements.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        return [
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
                    'driver'=>'Водитель',
                    'user'=>'Пользователь',
                    'manager'=>'Менеджер',
                    'superadmin'=>'Суперадмин',
                ])
                ->title('Тип пользователя'),
        ];
    }
}

<?php

namespace App\Orchid\Presenters;

use App\Models\City;
use Laravel\Scout\Builder;
use Orchid\Screen\Contracts\Personable;
use Orchid\Screen\Contracts\Searchable;
use Orchid\Support\Presenter;

class ToPresenter extends Presenter implements Searchable, Personable
{
    // Add your presenter methods here
    public function perSearchShow(): int
    {
        // TODO: Implement perSearchShow() method.
    }

    public function searchQuery(string $query = null): Builder
    {
        // TODO: Implement searchQuery() method.
    }

    public function label(): string
    {
        // TODO: Implement label() method.
        return "Получатель";
    }

    public function title(): string
    {
        // TODO: Implement title() method.

        return "ФИО: ".$this->entity->to_name;
    }

    public function subTitle(): string
    {
        // TODO: Implement subTitle() method.
        return "Город: ".City::find($this->entity->to_city)->city_name;
    }

    public function url(): string
    {
        // TODO: Implement url() method.
        return route('platform.systems.users.edit', $this->entity);
    }

    public function image(): ?string
    {
        // TODO: Implement image() method.
        return "";
    }
}

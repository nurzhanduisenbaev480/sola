<?php

namespace App\Orchid\Presenters;

use Laravel\Scout\Builder;
use Orchid\Screen\Contracts\Personable;
use Orchid\Screen\Contracts\Searchable;
use Orchid\Support\Presenter;

class OverheadPresenter extends Presenter implements Searchable, Personable
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
        return "Накладной";
    }

    public function title(): string
    {
        return "Накладной: ".$this->entity->overhead_code;
    }

    public function subTitle(): string
    {
        return "Заявка: ".$this->entity->order_code;
    }

    public function url(): string
    {
        return route('platform.systems.users.edit', $this->entity);
    }

    public function image(): ?string
    {
        // TODO: Implement image() method.
        return "";
    }
}

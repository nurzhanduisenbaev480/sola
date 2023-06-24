<?php

namespace App\Orchid\Screens\ManagerStore;

use App\Models\Overhead;
use App\Orchid\Layouts\ManagerStore\StoreTable;
use Orchid\Screen\Action;
use Orchid\Screen\Layout;
use Orchid\Screen\Screen;

class StoreListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        $overheads = Overhead::whereIn('last_status', [7,8])->paginate(100);
        return [
            'overheads' => $overheads
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Склад';
    }

    /**
     * The screen's action buttons.
     *
     * @return Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * The screen's layout elements.
     *
     * @return Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            StoreTable::class,
        ];
    }
}

<?php

namespace App\Orchid\Screens\ManagerDriver;

use App\Models\Overhead;
use App\Orchid\Layouts\ManagerDriver\DriverTable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Orchid\Screen\Action;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class DriverListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        if (Session::exists('message')){
            if (Session::get('success')){
                Toast::success(Session::get('message'));
            }else{
                Toast::warning(Session::get('message'));
            }
        }
        $overheads = Overhead::whereIn('last_status', [4,5,6])->where('driver', Auth::user()->id)->paginate(100);

        return [
            'overheads'=>$overheads,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Заявки водителя';
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
            DriverTable::class,
        ];
    }
}

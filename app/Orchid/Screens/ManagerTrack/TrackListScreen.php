<?php

namespace App\Orchid\Screens\ManagerTrack;

use App\Models\History;
use App\Models\Overhead;
use App\Models\Transport;
use App\Models\User;
use App\Orchid\Layouts\ManagerTrack\TrackTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Action;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class TrackListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        $overheads = Overhead::whereIn('last_status', [3])->paginate(100);

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
        return 'Панель менеджера по заборам';
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
            TrackTable::class,
            Layout::modal('trackDriver', Layout::rows([
                Input::make('overhead.id')->type('hidden'),
                Select::make('overhead.driver')
                    ->fromQuery(User::where("type", "driver"), "name"),
                Relation::make('overhead.transport_id')
                    ->fromModel(Transport::class, 'transport_name')
            ]))->async('asyncGetTrack')
        ];
    }
    public function trackUpdate(Overhead $overhead, Request $request):void{
        $data = $request->overhead;
        $data["last_status"] = 4;
        //dd($data);
        $overhead = Overhead::find($request->input('overhead.id'));
        $overhead->update($data);
        $history = History::create([
            'status_id' => 4,
            'user_id' => Auth::user()->id,
            'overhead_id'=>$overhead->id,
            'history_name'=>'Назначен на водителя',
            'is_show'=>1
        ]);
        if ($history){
            Toast::info("Водитель на заявку №".$overhead->overhead_code." назначен");
        }
    }
    public function asyncGetTrack(Overhead $overhead):array{
        return [
            'overhead'=>$overhead
        ];
    }
}

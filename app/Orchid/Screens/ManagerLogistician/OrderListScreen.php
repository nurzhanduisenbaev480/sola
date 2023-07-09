<?php

namespace App\Orchid\Screens\ManagerLogistician;

use App\Models\City;
use App\Models\History;
use App\Models\User;
use App\Models\Overhead;
use App\Orchid\Layouts\ManagerLogistician\OrderTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Modal;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class OrderListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        $overheads = Overhead::whereIn('last_status', [1,2])->paginate(100);

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
        return 'Панель логиста';
    }

    /**
     * The screen's action buttons.
     *
     * @return Action[]
     */
    public function commandBar(): iterable
    {
        return [
//            ModalToggle::make('Создать заявку')->modal('createOverhead')->method("createOverhead"),
            Link::make('Создать заявку')->icon('bs.file-plus')->route('platform.orders.create')
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            OrderTable::class,
        ];
    }


    public function asyncGetOverhead(Overhead $overhead): array{
        return [
            'overhead'=>$overhead
        ];
    }

    public function editOverhead(Request $request):void{
        $overhead = Overhead::find($request->input('overhead.id'))->update($request->overhead);
        if ($overhead){

        }
        Toast::info("Заявка №".$request->input('overhead.overhead_code')." обновлен");
    }

}

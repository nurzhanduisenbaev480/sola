<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Overhead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatusController extends Controller
{
    //
    public function changeAccept(Request $request): \Illuminate\Http\RedirectResponse
    {
        $overhead = Overhead::find($request->overhead);
        $overhead->update(['last_status'=>5]);
        $history = History::create([
            'status_id' => 5,
            'user_id' => Auth::user()->id,
            'overhead_id'=>$overhead->id,
            'history_name'=>'Заявка принята',
            'is_show'=>1
        ]);
        if($history){
            return redirect()->back()->with(['message'=>'Заявка принята', 'success'=>1]);
        }else{
            return redirect()->back()->with(['message'=>'Произошла ошибка', 'success'=>0]);
        }
    }
    public function changeTake(Request $request): \Illuminate\Http\RedirectResponse
    {
        $overhead = Overhead::find($request->overhead);
        $overhead->update(['last_status'=>6]);
        $history = History::create([
            'status_id' => 6,
            'user_id' => Auth::user()->id,
            'overhead_id'=>$overhead->id,
            'history_name'=>'Заявку забрал',
            'is_show'=>1
        ]);
        if($history){
            return redirect()->back()->with(['message'=>'Заявку забрал', 'success'=>1]);
        }else{
            return redirect()->back()->with(['message'=>'Произошла ошибка', 'success'=>0]);
        }
    }
    public function changeFinish(Request $request): \Illuminate\Http\RedirectResponse
    {
        $overhead = Overhead::find($request->overhead);
        $overhead->update(['last_status'=>7]);
        $history = History::create([
            'status_id' => 7,
            'user_id' => Auth::user()->id,
            'overhead_id'=>$overhead->id,
            'history_name'=>'Прибыл в центр',
            'is_show'=>1
        ]);
        if($history){
            return redirect()->back()->with(['message'=>'Заявку принес', 'success'=>1]);
        }else{
            return redirect()->back()->with(['message'=>'Произошла ошибка', 'success'=>0]);
        }
    }
}

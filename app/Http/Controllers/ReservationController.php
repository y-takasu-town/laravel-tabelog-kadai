<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function create(Store $store)
    {
        return view('reservations.create', compact('store'));
    }

    public function store(Request $request, Store $store)
    {
        $reservation = new Reservation();
        $reservation->user_id = Auth::user()->id;
        $reservation->store_id = $store->id;
        $reservation->amount = $request->amount;
        $reservation->reserved_time = $request->reserved_time;
        $reservation->save();

        return redirect()->route('mypage')->with('message','予約が完了しました。');
    }

    public function destroy(Reservation $reservation)
    {

        $reservation = Reservation::where("store_id", "$reservation->request_id")
        ->where("user_id", Auth::id())
        ->delete();

        return redirect()->back()->with('message','予約をキャンセルしました。');
    }
}

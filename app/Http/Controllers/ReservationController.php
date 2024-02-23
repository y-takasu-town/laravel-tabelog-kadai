<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ReservationController extends Controller
{
    public function create(Store $store)
    {
        if (!Auth::user()->subscribed('default'))
        {
        return redirect()->route('subscription')->with('message','予約機能は有料会員限定です。');
        }
        return view('reservations.create', compact('store'));
    }

    public function store(Request $request, Store $store)
    {
        $openTime = Carbon::parse($store->open_time);
        $closeTime = Carbon::parse($store->close_time);
        $reservedTime = Carbon::parse($request->reserved_time);
    
        // 予約時間の日付部分を今日の日付に揃える
        $reservedTimeToday = $reservedTime->setDate(now()->year, now()->month, now()->day);
        $openTimeToday = $openTime->setDate(now()->year, now()->month, now()->day);
        $closeTimeToday = $closeTime->setDate(now()->year, now()->month, now()->day);
    
        // 予約時間が営業時間外の場合
        if ($reservedTimeToday->lt($openTimeToday) || $reservedTimeToday->gt($closeTimeToday)) {
            return redirect()->back()->with('error', '予約時間が営業時間外です。');
        }

        // 予約時間が30分ごとでない場合
        if ($reservedTime->minute % 30 != 0) {
            return redirect()->back()->with('error', '予約時間は30分ごとに設定してください。');
        }

        // 予約日時が過去の日付である場合
        if ($reservedTime->lt(now()->startOfDay())) {
            return redirect()->back()->with('error', '過去の日付に予約することはできません。');
        }

        // 予約日時が現在の時刻よりも前の場合
        if ($reservedTime->lt(now())) {
            // 予約日が現在の日付よりも前の場合は、翌日以降の日付であれば予約を受け付ける
            $tomorrow = now()->addDay(); // 現在の日付に1日を加えて翌日の日付を取得
            if (!$reservedTime->isSameDay($tomorrow) && $reservedTime->lt($tomorrow)) {
                return redirect()->back()->with('error', '予約日時は翌日以降の日時に設定してください。');
            }
        }

        // 予約データを保存
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'reserved_time' => 'required|date',
        ]);

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
        $reservation->delete();

        return redirect()->back()->with('message','予約をキャンセルしました。');
    }
}

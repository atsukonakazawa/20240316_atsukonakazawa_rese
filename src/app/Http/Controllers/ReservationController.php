<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Favorite;
use App\Http\Requests\ReservationRequest;
use Carbon\Carbon;

class ReservationController extends Controller
{
    public function done(ReservationRequest $request){

        $userId = $request->user_id;
        $shopId = $request->shop_id;
        $result = [
            'user_id' => $userId,
            'shop_id' => $shopId,
            'rese_date' => $request->date,
            'rese_time' => $request->time,
            'rese_people' => $request->people,
        ];
        Reservation::create($result);

        return view('done');
    }

    public function delete(Request $request){

        $deleteId = $request->delete_id;
        Reservation::where('id',$deleteId)
        ->delete();

        $userId = $request->user_id;
        $today = Carbon::today();
        $reservations = Reservation::where('user_id',$userId)
                    ->whereDate('rese_date','>=',$today)
                    ->orderBy('rese_date','asc')
                    ->orderBy('rese_time','asc')
                    ->get();

        //お気に入り店舗情報を取得
        $favorites = Favorite::where('user_id',$userId)
                    ->with('shop')
                    ->get();

        return view('mypage',compact('reservations','favorites'));
    }

    public function change(Request $request){

        $rese_id = $request->reseId;
        $reservations = Reservation::where('id',$rese_id)
                ->get();

        return view('change',compact('reservations'));
    }

    public function changed(ReservationRequest $request){

        $changedDate = $request->date;
        $changedTime = $request->time;
        $changedPeople = $request->people;
        $result = [
            'rese_date' => $changedDate,
            'rese_time' => $changedTime,
            'rese_people' => $changedPeople,
        ];

        Reservation::where('id',$request->rese_id)
                    ->update($result);

        return view('changed');
    }
}

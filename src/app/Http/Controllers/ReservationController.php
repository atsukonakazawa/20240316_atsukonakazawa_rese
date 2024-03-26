<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Favorite;


class ReservationController extends Controller
{
    public function done(Request $request){

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
        $reservations = Reservation::where('user_id',$userId)->get();

        //お気に入り店舗情報を取得
        $favorites = Favorite::where('user_id',$userId)
                    ->with('shop')
                    ->get();

        return view('mypage',compact('reservations','favorites'));
    }
}

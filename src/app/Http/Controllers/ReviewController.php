<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Review;
use Carbon\Carbon;


class ReviewController extends Controller
{
    public function review(Request $request){

        //予約状況から今日以前の記録を取得
        $userId = $request->user_id;
        $today = Carbon::today();
        $visitations = Reservation::where('user_id',$userId)
                    ->whereDate('rese_date','<=',$today)
                    ->orderBy('rese_date','asc')
                    ->orderBy('rese_time','asc')
                    ->get();

        return view('review', compact('visitations'));
    }

    public function reviewed(Request $request){

        $result = [
            'shop_id' => $request->shopId,
            'user_id' => $request->userId,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ];
        Review::create($result);

        return view('reviewed');
    }
}

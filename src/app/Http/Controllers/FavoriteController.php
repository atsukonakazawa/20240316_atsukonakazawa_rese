<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;



class FavoriteController extends Controller
{
    public function like(Request $request){

        $userId = $request->user_id;
        $shopId = $request->shop_id;
        $check  = Favorite::where('user_id',$userId)
                ->where('shop_id',$shopId)
                ->first();

        if($check !== null){
            //もしお気に入り登録済みなら削除
            Favorite::where('user_id',$userId)
                ->where('shop_id',$shopId)
                ->delete();
        }else{
            //お気に入り登録されていなければ、登録
            $result = [
                'user_id' => $userId,
                'shop_id' => $shopId,
            ];
            Favorite::create($result);
        }

        $shops = Shop::with('area')->with('genre')->get();
        $areas = Area::all();
        $genres = Genre::all();
        $user = Auth::user();
        $favorites = $user->favorites->pluck('shop_id')->toArray();

        return view('home',compact('shops','areas','genres','favorites'));
    }

    public function likeMypage(Request $request){

        $userId = $request->user_id;
        $shopId = $request->shop_id;
        $check  = Favorite::where('user_id',$userId)
                ->where('shop_id',$shopId)
                ->first();

        if($check !== null){
            //もしお気に入り登録済みなら削除
            Favorite::where('user_id',$userId)
                ->where('shop_id',$shopId)
                ->delete();
        }else{
            //お気に入り登録されていなければ、登録
            $result = [
                'user_id' => $userId,
                'shop_id' => $shopId,
            ];
            Favorite::create($result);
        }

        $shops = Shop::with('area')->with('genre')->get();
        $areas = Area::all();
        $genres = Genre::all();

                //予約状況を取得
        $reservations = Reservation::where('user_id',$userId)->get();

        //お気に入り店舗情報を取得
        $favorites = Favorite::where('user_id',$userId)
                    ->with('shop')
                    ->get();

        return view('mypage',compact('shops','areas','genres','reservations','favorites'));
    }
}

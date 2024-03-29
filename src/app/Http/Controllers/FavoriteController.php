<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Shop;
use App\Models\User;
use App\Models\Area;
use App\Models\Genre;
use Illuminate\Support\Facades\Auth;



class FavoriteController extends Controller
{
    public function like(Request $request){

        $userId = $request->user_id;
        $shopId = $request->shop_id;
        $check  = Favorite::where('user_id',$userId)
                ->where('shop_id',$shopId)
                ->first();

        if($check !== null)
        {
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

        return view('home',compact('shops','areas','genres'));

    }

}

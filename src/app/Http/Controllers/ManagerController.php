<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Shop;
use App\Models\User;
use App\Models\Reservation;
use App\Http\Requests\ShopRequest;
use Illuminate\Support\Facades\Auth;

class ManagerController extends Controller
{
    public function manager(Request $request){

        $userId = $request->user_id;
        $getRole = User::where('id',$userId)
                    ->where('role','manager')
                    ->first();

        if($getRole !== null){

        return view('manager.manager');

        }else{

        $shops = Shop::with('area')->with('genre')->get();
            $areas = Area::all();
            $genres = Genre::all();

            $user = Auth::user();
            $favorites = $user->favorites->pluck('shop_id')->toArray();

            // セッションを削除
            session()->forget('selected_area_id');
            session()->forget('selected_genre_id');
            session()->forget('selected_keyword');
            session()->flash('message','店舗代表者のみがアクセスできます');

            return view('home',compact('shops','areas','genres','favorites'));
        }

    }

    public function newShop(){

        $areas = Area::all();
        $genres = Genre::all();

        return view('manager.newShop',compact('areas','genres'));
    }

    public function newShopCreated(ShopRequest $request){

        $result = [
            'area_id' => $request->area_id,
            'genre_id' => $request->genre_id,
            'shop_name' => $request->shop_name,
            'shop_detail' => $request->shop_detail,
            'shop_img' => $request->shop_img
        ];
        Shop::create($result);

        $newShopId = Shop::where('area_id',$request->area_id)
                    ->where('genre_id',$request->genre_id)
                    ->where('shop_name',$request->shop_name)
                    ->first();

        return view('manager.newShopCreated',compact('newShopId'));
    }

    public function updateShop(){

        $areas = Area::all();
        $genres = Genre::all();

        return view('manager.updateShop',compact('areas','genres'));
    }

    public function updatedShop(ShopRequest $request){

        $update = $request->all();
        $shopId = $request->shop_id;
        $shopName = $request->shop_name;
        $newAreaId = $request->newArea_id;
        $newGenreId = $request->newGenre_id;
        $newShopName = $request->newShop_name;
        $newShopDetail = $request->newShop_detail;
        $newShopImg = $request->newShop_img;

        //エリアを更新
        if($newAreaId !== null && $newAreaId !== 'null'){
            $result1 = [
                'area_id' => $newAreaId,
            ];
            Shop::where('id',$shopId)
                ->where('shop_name',$shopName)
                ->update($result1);
        }else{

        };


        //ジャンルを更新
        if($newGenreId !== null && $newGenreId !== 'null'){
            $result2 = [
                'genre_id' => $newGenreId,
            ];
            Shop::where('id',$shopId)
                ->where('shop_name',$shopName)
                ->update($result2);
        }else{

        };

        //店舗名を更新
        if($newShopName !== null && $newShopName !== 'null'){
            $result3 = [
                'shop_name' => $newShopName,
            ];
            Shop::where('id',$shopId)
                ->where('shop_name',$shopName)
                ->update($result3);
        }else{

        };

        //店舗概要を更新
        if($newShopDetail !== null && $newShopDetail !== 'null'){
            $result4 = [
                'shop_detail' => $newShopDetail,
            ];
            Shop::where('id',$shopId)
                ->where('shop_name',$shopName)
                ->update($result4);
        }else{

        };

        //店舗画像を更新
        if($newShopImg !== null && $newShopImg !== 'null'){
            $result5 = [
                'shop_img' => $newShopImg,
            ];
            Shop::where('id',$shopId)
                ->where('shop_name',$shopName)
                ->update($result5);
        }else{

        };

        return view('manager.updatedShop');

    }

    public function confirmRese(Request $request){

        $reservations = Reservation::where('shop_id',$request->shop_id)
                    ->get();

        return view('manager.confirmRese',compact('reservations'));
    }
}

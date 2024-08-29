<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Shop;
use App\Models\User;
use App\Models\Reservation;
use App\Http\Requests\ShopRequest;
use App\Http\Requests\UpdateRequest;
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

    public function store(ShopRequest $request){

        // genre_idに応じた画像のURLを生成
        switch ($request->genre_id) {
            case 1:
                $imageUrl = 'https://rese.s3.ap-northeast-1.amazonaws.com/shop_images/sushi.jpg';
                break;
            case 2:
                $imageUrl = 'https://rese.s3.ap-northeast-1.amazonaws.com/shop_images/yakiniku.jpg';
                break;
            case 3:
                $imageUrl = 'https://rese.s3.ap-northeast-1.amazonaws.com/shop_images/izakaya.jpg';
                break;
            case 4:
                $imageUrl = 'https://rese.s3.ap-northeast-1.amazonaws.com/shop_images/italian.jpg';
                break;
            case 5:
                $imageUrl = 'https://rese.s3.ap-northeast-1.amazonaws.com/shop_images/ramen.jpg';
                break;
            default:
                $imageUrl = null;
                break;
        }

        // データベースに保存する情報をまとめる
        $result = [
            'area_id' => $request->area_id,
            'genre_id' => $request->genre_id,
            'shop_name' => $request->shop_name,
            'shop_detail' => $request->shop_detail,
            // 画像URLを保存する
            'shop_img' => $imageUrl,
        ];

        // データベースに新しい店舗情報を作成
        Shop::create($result);

        // 新しい店舗情報を取得
        $newShopId = Shop::where('area_id',$request->area_id)
                    ->where('genre_id',$request->genre_id)
                    ->where('shop_name',$request->shop_name)
                    ->first();

        // 新しい店舗情報の表示
        return view('manager.newShopCreated',compact('newShopId'));
    }

    public function updateShop(){

        $areas = Area::all();
        $genres = Genre::all();

        return view('manager.updateShop',compact('areas','genres'));
    }

    public function updatedShop(UpdateRequest $request){

        $update = $request->all();
        $shopId = $request->shop_id;
        $shopName = $request->shop_name;
        $newAreaId = $request->newArea_id;
        $newGenreId = $request->newGenre_id;
        $newShopName = $request->newShop_name;
        $newShopDetail = $request->newShop_detail;
        $newShopImg = $request->newShop_img;

        $areas = Area::all();
        $genres = Genre::all();

        $match = Shop::where('id',$shopId)
                ->where('shop_name',$shopName)
                ->first();

        //エリアを更新
        if($match == null){

            session()->flash('message','店舗IDと店舗名が一致しません');

            return view('manager.updateShop',compact('areas','genres'));

        }else{
            if($newAreaId !== null && $newAreaId !== 'null'){
                $result1 = [
                    'area_id' => $newAreaId,
                ];
                Shop::where('id',$shopId)
                    ->where('shop_name',$shopName)
                    ->update($result1);
            }else{

            }
        }

        //ジャンルを更新
        if($match == null){

            session()->flash('message','店舗IDと店舗名が一致しません');

            return view('manager.updateShop',compact('areas','genres'));

        }else{

            if($newGenreId !== null && $newGenreId !== 'null'){

                $result2 = [
                    'genre_id' => $newGenreId,
                ];
                // ジャンルが更新された場合は、それに応じた画像URLも更新
                //$imageUrl = null; // デフォルトの画像URLをnullに設定
                switch ($newGenreId) {
                    case 1:
                        $imageUrl = 'https://rese.s3.ap-northeast-1.amazonaws.com/shop_images/sushi.jpg';
                        break;
                    case 2:
                        $imageUrl = 'https://rese.s3.ap-northeast-1.amazonaws.com/shop_images/yakiniku.jpg';
                        break;
                    case 3:
                        $imageUrl = 'https://rese.s3.ap-northeast-1.amazonaws.com/shop_images/izakaya.jpg';
                        break;
                    case 4:
                        $imageUrl = 'https://rese.s3.ap-northeast-1.amazonaws.com/shop_images/italian.jpg';
                        break;
                    case 5:
                        $imageUrl = 'https://rese.s3.ap-northeast-1.amazonaws.com/shop_images/ramen.jpg';
                        break;
                    default:
                        // デフォルトの画像URLを元々保存されていたものに設定
                        $imageUrl = $match->shop_img;
                        break;
                }
                // 画像URLが更新される場合のみ更新処理を行う
                if ($imageUrl !== null) {
                    $result2['shop_img'] = $imageUrl;
                }
                Shop::where('id', $shopId)
                    ->where('shop_name', $shopName)
                    ->update($result2);
            }
        }

        //店舗名を更新
        if($match == null){

            session()->flash('message','店舗IDと店舗名が一致しません');

            return view('manager.updateShop',compact('areas','genres'));

        }else{

            if($newShopName !== null && $newShopName !== 'null'){
                $result3 = [
                    'shop_name' => $newShopName,
                ];
                Shop::where('id',$shopId)
                    ->where('shop_name',$shopName)
                    ->update($result3);
            }else{

            }
        }

        //店舗概要を更新
        if($match == null){

            session()->flash('message','店舗IDと店舗名が一致しません');

            return view('manager.updateShop',compact('areas','genres'));

        }else{

            if($newShopDetail !== null && $newShopDetail !== 'null'){
                $result4 = [
                    'shop_detail' => $newShopDetail,
                ];
                Shop::where('id',$shopId)
                    ->where('shop_name',$shopName)
                    ->update($result4);
            }else{

            }
        }
        return view('manager.updatedShop');
    }

    public function confirmRese(Request $request){

        $reservations = Reservation::where('shop_id',$request->shop_id)
                        ->get();

        return view('manager.confirmRese',compact('reservations'));
    }
}

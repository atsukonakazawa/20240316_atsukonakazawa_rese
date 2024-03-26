<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Favorite;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;


class ShopController extends Controller
{
    public function index(){

        $shops = Shop::with('area')->with('genre')->get();
        $areas = Area::all();
        $genres = Genre::all();

        return view('index',compact('shops','areas','genres'));
    }

    public function searchArea(Request $request){

        $areaId = $request->area_id;
        $shops = Shop::where('area_id',$areaId)
                    ->get();
        $areas = Area::all();
        $genres = Genre::all();

        return view('index',compact('shops','areas','genres'));
    }

    public function searchGenre(Request $request){

        $genreId = $request->genre_id;
        $shops = Shop::where('genre_id',$genreId)
                    ->get();
        $areas = Area::all();
        $genres = Genre::all();

        return view('index',compact('shops','areas','genres'));
    }

    public function searchKeyword(Request $request){

        $keyword = $request->keyword;
        $shops = Shop::where('shop_name','like', '%'.$keyword.'%')
                    ->get();
        $areas = Area::all();
        $genres = Genre::all();

        return view('index',compact('shops','areas','genres'));
    }

    public function home(){

        $shops = Shop::with('area')->with('genre')->get();
        $areas = Area::all();
        $genres = Genre::all();

        return view('home',compact('shops','areas','genres'));
    }

    public function searchAreaHome(Request $request){

        $areaId = $request->area_id;
        $shops = Shop::where('area_id',$areaId)
                    ->get();
        $areas = Area::all();
        $genres = Genre::all();

        return view('home',compact('shops','areas','genres'));
    }

    public function searchGenreHome(Request $request){

        $genreId = $request->genre_id;
        $shops = Shop::where('genre_id',$genreId)
                    ->get();
        $areas = Area::all();
        $genres = Genre::all();

        return view('home',compact('shops','areas','genres'));
    }

    public function searchKeywordHome(Request $request){

        $keyword = $request->keyword;
        $shops = Shop::where('shop_name','like', '%'.$keyword.'%')
                    ->get();
        $areas = Area::all();
        $genres = Genre::all();

        return view('home',compact('shops','areas','genres'));
    }

    public function detail(Request $request){

        $shop_id = $request->shop_id;
        $shops = Shop::where('id',$shop_id)
                ->get();

        return view('detail',compact('shops'));
    }

    public function mypage(Request $request){

        //予約状況を取得
        $userId = $request->user_id;
        $reservations = Reservation::where('user_id',$userId)->get();

        //お気に入り店舗情報を取得
        $favorites = Favorite::where('user_id',$userId)
                    ->with('shop')
                    ->get();

        return view('mypage', compact('reservations','favorites'));
    }

}

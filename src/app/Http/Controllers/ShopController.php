<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Favorite;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class ShopController extends Controller
{
    public function index(){

        $shops = Shop::with('area')->with('genre')->get();
        $areas = Area::all();
        $genres = Genre::all();

        // セッションを削除
        session()->forget('selected_area_id');
        session()->forget('selected_genre_id');
        session()->forget('selected_keyword');

        return view('index',compact('shops','areas','genres'));
    }

    public function searchArea(Request $request){

        $areaId = $request->area_id;
        $shops = Shop::where('area_id',$areaId)
                    ->get();
        $areas = Area::all();
        $genres = Genre::all();

        //選択されたエリアのIDを取得し、セッションに保存
        $selectedAreaId = $areaId;
        session(['selected_area_id' => $selectedAreaId]);

        // セッションを削除
        session()->forget('selected_genre_id');
        session()->forget('selected_keyword');

        return view('index',compact('shops','areas','genres'));
    }

    public function searchGenre(Request $request){

        $genreId = $request->genre_id;
        $shops = Shop::where('genre_id',$genreId)
                    ->get();
        $areas = Area::all();
        $genres = Genre::all();

        //選択されたジャンルのIDを取得し、セッションに保存
        $selectedGenreId = $genreId;
        session(['selected_genre_id' => $selectedGenreId]);

        // セッションを削除
        session()->forget('selected_area_id');
        session()->forget('selected_keyword');


        return view('index',compact('shops','areas','genres'));
    }

    public function searchKeyword(Request $request){

        $keyword = $request->keyword;
        $shops = Shop::where('shop_name','like', '%'.$keyword.'%')
                    ->get();
        $areas = Area::all();
        $genres = Genre::all();

        //入力されたキーワードを取得し、セッションに保存
        $selectedKeyword = $keyword;
        session(['selected_keyword' => $selectedKeyword]);

        // セッションを削除
        session()->forget('selected_area_id');
        session()->forget('selected_genre_id');

        return view('index',compact('shops','areas','genres'));
    }

    public function home(){

        $shops = Shop::with('area')->with('genre')->get();
        $areas = Area::all();
        $genres = Genre::all();

        $user = Auth::user();
        $favorites = $user->favorites->pluck('shop_id')->toArray();

        // セッションを削除
        session()->forget('selected_area_id');
        session()->forget('selected_genre_id');
        session()->forget('selected_keyword');

        return view('home',compact('shops','areas','genres','favorites'));
    }

    public function searchAreaHome(Request $request){

        $areaId = $request->area_id;
        $shops = Shop::where('area_id',$areaId)
                    ->get();
        $areas = Area::all();
        $genres = Genre::all();

        $user = Auth::user();
        $favorites = $user->favorites->pluck('shop_id')->toArray();

        //選択されたエリアのIDを取得し、セッションに保存
        $selectedAreaId = $areaId;
        session(['selected_area_id' => $selectedAreaId]);

        // セッションを削除
        session()->forget('selected_genre_id');
        session()->forget('selected_keyword');

        return view('home',compact('shops','areas','genres','favorites'));
    }

    public function searchGenreHome(Request $request){

        $genreId = $request->genre_id;
        $shops = Shop::where('genre_id',$genreId)
                    ->get();
        $areas = Area::all();
        $genres = Genre::all();

        $user = Auth::user();
        $favorites = $user->favorites->pluck('shop_id')->toArray();

        //選択されたジャンルのIDを取得し、セッションに保存
        $selectedGenreId = $genreId;
        session(['selected_genre_id' => $selectedGenreId]);

        // セッションを削除
        session()->forget('selected_area_id');
        session()->forget('selected_keyword');

        return view('home',compact('shops','areas','genres','favorites'));
    }

    public function searchKeywordHome(Request $request){

        $keyword = $request->keyword;
        $shops = Shop::where('shop_name','like', '%'.$keyword.'%')
                    ->get();
        $areas = Area::all();
        $genres = Genre::all();

        $user = Auth::user();
        $favorites = $user->favorites->pluck('shop_id')->toArray();

        //入力されたキーワードを取得し、セッションに保存
        $selectedKeyword = $keyword;
        session(['selected_keyword' => $selectedKeyword]);

        // セッションを削除
        session()->forget('selected_area_id');
        session()->forget('selected_genre_id');

        return view('home',compact('shops','areas','genres','favorites'));
    }

    public function detail(Request $request){

        $shop_id = $request->shop_id;
        $shops = Shop::where('id',$shop_id)
                ->get();
        $today = Carbon::today();

        return view('detail',compact('shops','today'));
    }

    public function mypage(Request $request){

        //予約状況から今日以降のデータを取得
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

        return view('mypage', compact('reservations','favorites'));
    }

}

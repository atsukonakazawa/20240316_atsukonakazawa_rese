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

    public function indexShuffle(){

        $shops = Shop::with('area')->with('genre')->get();

        // 並び順をランダムにする
        $shops = $shops->shuffle();

        $areas = Area::all();
        $genres = Genre::all();

        // セッションを削除
        session()->forget('selected_area_id');
        session()->forget('selected_genre_id');
        session()->forget('selected_keyword');

        return view('index',compact('shops','areas','genres'));
    }

    public function indexDesc(){

        // 評価の平均値が高い順にソートしてショップを取得
        $shops = Shop::with('area', 'genre')
                 ->withAvg('reviews', 'rating') // reviewsの平均ratingを取得
                 ->orderByDesc('reviews_avg_rating') // 平均ratingでソート
                ->get();
        $areas = Area::all();
        $genres = Genre::all();

        // セッションを削除
        session()->forget('selected_area_id');
        session()->forget('selected_genre_id');
        session()->forget('selected_keyword');

        return view('index',compact('shops','areas','genres'));
    }

    public function indexAsc(){

        // 評価の平均値が低い順にソートしてショップを取得し、レビューがないショップを最後に配置
        $shops = Shop::with('area', 'genre')
                 ->withAvg('reviews', 'rating') // reviewsの平均ratingを取得
                 ->orderByRaw('reviews_avg_rating IS NULL') // NULLのものを最後に配置
                 ->orderBy('reviews_avg_rating') // 平均ratingで昇順ソート
                ->get();

        $areas = Area::all();
        $genres = Genre::all();

        // セッションを削除
        session()->forget('selected_area_id');
        session()->forget('selected_genre_id');
        session()->forget('selected_keyword');

        return view('index',compact('shops','areas','genres'));
    }


    public function search(Request $request) {
        // 各検索条件を取得
        $areaId = $request->input('area_id');
        $genreId = $request->input('genre_id');
        $keyword = $request->input('keyword');

        // ベースのクエリ
        $query = Shop::query();

        // エリアでのフィルタリング
        if ($areaId) {
            $query->where('area_id', $areaId);
            session(['selected_area_id' => $areaId]);
        } else {
            session()->forget('selected_area_id');
        }

        // ジャンルでのフィルタリング
        if ($genreId) {
            $query->where('genre_id', $genreId);
            session(['selected_genre_id' => $genreId]);
        } else {
            session()->forget('selected_genre_id');
        }

        // キーワードでのフィルタリング
        if ($keyword) {
            $query->where('shop_name', 'like', '%' . $keyword . '%');
            session(['selected_keyword' => $keyword]);
        } else {
            session()->forget('selected_keyword');
        }

        // フィルタリングされた結果を取得
        $shops = $query->get();

        // 必要なデータをビューに渡す
        $areas = Area::all();
        $genres = Genre::all();

        return view('index', compact('shops', 'areas', 'genres'));
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

    public function searchHome(Request $request){
        // 各検索条件を取得
        $areaId = $request->input('area_id');
        $genreId = $request->input('genre_id');
        $keyword = $request->input('keyword');

        // ベースのクエリ
        $query = Shop::query();

        // エリアでのフィルタリング
        if ($areaId) {
            $query->where('area_id', $areaId);
            session(['selected_area_id' => $areaId]);
        } else {
            session()->forget('selected_area_id');
        }

        // ジャンルでのフィルタリング
        if ($genreId) {
            $query->where('genre_id', $genreId);
            session(['selected_genre_id' => $genreId]);
        } else {
            session()->forget('selected_genre_id');
        }

        // キーワードでのフィルタリング
        if ($keyword) {
            $query->where('shop_name', 'like', '%' . $keyword . '%');
            session(['selected_keyword' => $keyword]);
        } else {
            session()->forget('selected_keyword');
        }

        // フィルタリングされた結果を取得
        $shops = $query->get();

        // 必要なデータをビューに渡す
        $areas = Area::all();
        $genres = Genre::all();

        $user = Auth::user();
        $favorites = $user->favorites->pluck('shop_id')->toArray();

        return view('home',compact('shops','areas','genres','favorites'));
    }

    public function homeShuffle(){

        $shops = Shop::with('area')->with('genre')->get();

        // 並び順をランダムにする
        $shops = $shops->shuffle();

        $areas = Area::all();
        $genres = Genre::all();

        // セッションを削除
        session()->forget('selected_area_id');
        session()->forget('selected_genre_id');
        session()->forget('selected_keyword');

        return view('index',compact('shops','areas','genres'));
    }

    public function homeDesc(){

        // 評価の平均値が高い順にソートしてショップを取得
        $shops = Shop::with('area', 'genre')
                 ->withAvg('reviews', 'rating') // reviewsの平均ratingを取得
                 ->orderByDesc('reviews_avg_rating') // 平均ratingでソート
                ->get();
        $areas = Area::all();
        $genres = Genre::all();

        // セッションを削除
        session()->forget('selected_area_id');
        session()->forget('selected_genre_id');
        session()->forget('selected_keyword');

        return view('index',compact('shops','areas','genres'));
    }

    public function homeAsc(){

        // 評価の平均値が低い順にソートしてショップを取得し、レビューがないショップを最後に配置
        $shops = Shop::with('area', 'genre')
                 ->withAvg('reviews', 'rating') // reviewsの平均ratingを取得
                 ->orderByRaw('reviews_avg_rating IS NULL') // NULLのものを最後に配置
                 ->orderBy('reviews_avg_rating') // 平均ratingで昇順ソート
                ->get();

        $areas = Area::all();
        $genres = Genre::all();

        // セッションを削除
        session()->forget('selected_area_id');
        session()->forget('selected_genre_id');
        session()->forget('selected_keyword');

        return view('index',compact('shops','areas','genres'));
    }

    public function detail(Request $request){

        $shop_id = $request->shop_id;
        $shops = Shop::where('id',$shop_id)
                ->get();
        $today = Carbon::today();

        return view('detail',compact('shops','today'));
    }

    public function detailIndex(Request $request){

        $shop_id = $request->shop_id;
        $shops = Shop::where('id',$shop_id)
                ->get();
        $today = Carbon::today();

        return view('detail_index',compact('shops','today'));
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

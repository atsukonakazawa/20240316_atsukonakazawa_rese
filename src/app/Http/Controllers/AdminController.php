<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Shop;
use App\Models\Review;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use File;



class AdminController extends Controller
{
    public function adminMenu(Request $request){

        $userId = $request->user_id;
        $getRole = User::where('id',$userId)
                    ->where('role','admin')
                    ->first();

        if($getRole !== null){

            return view('admin.admin_menu');

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
            session()->flash('message','管理者のみがアクセスできます');

            return view('home',compact('shops','areas','genres','favorites'));
        }
    }

    public function admin(Request $request){

        $userId = $request->user_id;
        $getRole = User::where('id',$userId)
                    ->where('role','admin')
                    ->first();

        if($getRole !== null){

        return view('admin.admin');

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
            session()->flash('message','管理者のみがアクセスできます');

            return view('home',compact('shops','areas','genres','favorites'));
        }
    }

    public function adminReview(Request $request){

        $reviews = Review::all();

        return view('admin.admin_review',compact('reviews'));
    }

    public function adminReviewDelete(Request $request){

        $reviewId = $request->review_id;
        $review = Review::where('id',$reviewId)
                        ->first();
        return view('admin.admin_review_delete_confirm',compact('review'));
    }

    public function adminReviewRemove(Request $request){

        $reviewId = $request->review_id;
        Review::where('id',$reviewId)
                        ->delete();
        $reviews = Review::all();


        session()->flash('message','選択したコメントを削除しました');

        return view('admin.admin_review',compact('reviews'));
    }

    public function createManager(UserRequest $request){

        $result = [
            'name' => $request->name,
            'role' => 'manager',
            'email' => $request->email,
            'password' => $request->password,
        ];
        $manager = User::create($result);

        return view('admin.createdManager');
    }

    public function toImport(Request $request){

        return view('admin.import');
    }

    public function shopsImport(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt',
        ]);

        // CSVファイルを開く
        $file = fopen($request->file('csv_file'), 'r');

        // CSVのヘッダーをスキップ
        fgetcsv($file);

        // ファイルの行を一つずつ読み込む
        while (($data = fgetcsv($file)) !== FALSE) {
            // 各列のデータを取得し、バリデーションを行う
            $shopData = [
                'shop_name' => $data[0],
                'area' => $data[1],
                'genre' => $data[2],
                'shop_detail' => $data[3],
                'shop_img' => $data[4],
            ];

            // バリデーションルールの適用
            $validator = Validator::make($shopData, [
                'shop_name' => 'required|max:50|unique:shops,shop_name',
                'area' => 'required|in:東京都,大阪府,福岡県',
                'genre' => 'required|in:寿司,焼肉,イタリアン,居酒屋,ラーメン',
                'shop_detail' => 'required|max:400',
                'shop_img' => 'required',
                'shop_image.*' => 'required|mimes:png,jpg,jpeg|max:2048'
            ]);

            if ($validator->fails()) {
                // エラーメッセージの取得
                $errors = $validator->errors();

                return redirect()->back()->withErrors($errors)->withInput();

                // バリデーションエラーをログに記録
                Log::error('CSVインポートのバリデーションエラー', ['errors' => $validator->errors(), 'data' => $shopData]);
                continue;
            }

            // 地域名からIDを取得
            $area = Area::where('area_name', $shopData['area'])->first();
            if ($area) {
                $shopData['area_id'] = $area->id; // 地域IDを設定
            } else {
                // 地域名がマスターに存在しない場合、処理をスキップするかエラーハンドリング
                continue;
            }

            // ジャンル名からIDを取得
            $genre = Genre::where('genre_name', $shopData['genre'])->first();
            if ($genre) {
                $shopData['genre_id'] = $genre->id; // 地域IDを設定
            } else {
                // 地域名がマスターに存在しない場合、処理をスキップするかエラーハンドリング
                continue;
            }

            // 画像ファイルの処理
            if ($shopData['shop_img']) {
                // 画像ファイルのパスを取得
                $imagePath = public_path('temp_images/' . $shopData['shop_img']);

                if (File::exists($imagePath)) {
                    // 新しいファイル名を生成
                    $newFileName = $shopData['area_id'] . '_' . $shopData['genre_id'] . '_' . $shopData['shop_img'];

                    // 画像ファイルを保存するディレクトリを指定
                    $destinationPath = storage_path('app/public/images');
                    File::makeDirectory($destinationPath, 0755, true, true);

                    // 画像ファイルを指定したディレクトリにコピー
                    File::copy($imagePath, $destinationPath . '/' . $newFileName);

                    // 新しいファイル名を保存
                    $shopData['shop_img'] = $newFileName;
                }else{
                    return back()->withErrors(['shop_img' => '指定された画像ファイルが存在しません: ' . $shopData['shop_img']]);
                }
            }

            // 店舗情報の保存
            Shop::create([
                'shop_name' => $shopData['shop_name'],
                'area_id' => $shopData['area_id'],
                'genre_id' => $shopData['genre_id'],
                'shop_detail' => $shopData['shop_detail'],
                'shop_img' => $shopData['shop_img'],
            ]);
        }

        fclose($file);

        return redirect()->back()->with('success', 'CSVファイルがインポートされました。');
    }

}

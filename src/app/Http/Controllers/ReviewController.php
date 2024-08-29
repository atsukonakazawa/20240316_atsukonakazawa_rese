<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Review;
use App\Models\Shop;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ReviewRequest;


class ReviewController extends Controller
{
    public function showReviews(Request $request){

        //今日以前の記録を取得
        $userId = $request->user_id;
        $shopId = $request->shop_id;
        $shop = Shop::where('id',$shopId)
                ->first();
        $reviews = Review::where('shop_id',$shopId)
                            ->orderBy('id','asc')
                            ->get();

        return view('reviews_list', compact('shop','reviews','userId'));
    }

    public function visited(Request $request){

        //予約状況から今日以前の記録を取得
        $userId = $request->user_id;
        $today = Carbon::today();
        $visitations = Reservation::where('user_id',$userId)
                    ->whereDate('rese_date','<=',$today)
                    ->orderBy('rese_date','asc')
                    ->orderBy('rese_time','asc')
                    ->get();

        return view('visited', compact('visitations'));
    }

    public function review(Request $request){

        //選択された店舗の情報を取得
        $shopName = $request->shop_name;
        $shop = Shop::where('shop_name',$shopName)
                    ->first();

        //選択された店舗に過去に口コミを投稿済みの場合はエラーメッセージを表示する
        $userId = $request->user_id;
        $shopId = $shop->id;
        $already = Review::where('user_id',$userId)
                            ->where('shop_id',$shopId)
                            ->first();

        if($already !== null){
            //予約状況から今日以前の記録を取得
            $userId = $request->user_id;
            $today = Carbon::today();
            $visitations = Reservation::where('user_id',$userId)
                        ->whereDate('rese_date','<=',$today)
                        ->orderBy('rese_date','asc')
                        ->orderBy('rese_time','asc')
                        ->get();

            session()->flash('message','選択した店舗にはすでに投稿済みです');

            return view('visited', compact('visitations'));
        }
        return view('review', compact('shop'));
    }

    public function edit(Request $request){

        $userId = $request->user_id;
        $shopId = $request->shop_id;
        $shop = Shop::where('id',$shopId)->first();
        $already = Review::where('user_id',$userId)
                            ->where('shop_id',$shopId)
                            ->first();
        $today = Carbon::today();
        $visitations = Reservation::where('user_id',$userId)
                    ->whereDate('rese_date','<=',$today)
                    ->orderBy('rese_date','asc')
                    ->orderBy('rese_time','asc')
                    ->get();

        if($already == null){

            session()->flash('message','選択した店舗にはまだレビューを投稿していません');

            return view('visited', compact('visitations'));
        }
        return view('review_edit', compact('shop','already'));
    }

    public function upload(ReviewRequest $request){

        // ユーザーID、ショップIDを取得
        $userId = $request->userId;
        $shopId = $request->shopId;

        // 既存のレビュー情報を取得
        $already = Review::where('user_id', $userId)
                    ->where('shop_id', $shopId)
                    ->first();

        // 画像ファイルがアップロードされているかチェック
        if ($request->hasFile('review_img')) {

            // 既存の画像がある場合、それを削除する
            if ($already && $already->review_img) {
                $existingFile = 'public/' . $already->review_img;
                if (Storage::exists($existingFile)) {
                    Storage::delete($existingFile);
                }
            }

            $file = $request->file('review_img');

            // 新しいファイル名を生成
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $filename = "{$userId}_{$shopId}_{$originalName}.{$extension}";

            // 新しい画像をpublicディレクトリに保存
            $path = $file->storeAs('public', $filename);

            // レビュー情報を更新
            $already->update([
                'rating' => $request->rating,
                'comment' => $request->comment,
                'review_img' => $filename,
            ]);
        } else {
            // 画像がアップロードされていない場合は、画像以外の情報を更新
            $already->update([
                'rating' => $request->rating,
                'comment' => $request->comment,
            ]);
        }
        return view('review_uploaded');
    }


    public function reviewed(ReviewRequest $request){

        // 画像ファイルがアップロードされているかチェック
        if ($request->hasFile('review_img')) {
            $file = $request->file('review_img');

            // ユーザーID、ショップID、元のファイル名と拡張子を取得
            $userId = $request->userId;
            $shopId = $request->shopId;
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();

            // 新しいファイル名を生成
            $filename = "{$userId}_{$shopId}_{$originalName}.{$extension}";

            // 画像をpublicディレクトリに保存
            $path = $file->storeAs('public', $filename);

        }

        $result = [
            'shop_id' => $request->shopId,
            'user_id' => $request->userId,
            'rating' => $request->rating,
            'comment' => $request->comment,
            //画像アップロードがあった場合は、ファイルパスを保存
            //画像アップロードがなかった場合は、nullを保存
            'review_img' => $filename ?? null,
        ];
        Review::create($result);

        return view('reviewed');
    }

    public function delete(Request $request){

        $userId = $request->user_id;
        $shopId = $request->shop_id;

        return view('review_delete_confirm', compact('userId','shopId'));
    }

    public function remove(Request $request){

        // ユーザーID、ショップIDを取得
        $userId = $request->user_id;
        $shopId = $request->shop_id;

        // 既存のレビュー情報を取得
        $already = Review::where('user_id', $userId)
                    ->where('shop_id', $shopId)
                    ->first();

        //今日までの来店履歴を取得
        $today = Carbon::today();
        $visitations = Reservation::where('user_id',$userId)
                    ->whereDate('rese_date','<=',$today)
                    ->orderBy('rese_date','asc')
                    ->orderBy('rese_time','asc')
                    ->get();

        if($already == null){

            session()->flash('message','選択した店舗にはまだレビューを投稿していません');

            return view('visited', compact('visitations'));
        }


        // 既存の画像がある場合、それを削除する
        if ($already && $already->review_img) {
            $existingFile = 'public/' . $already->review_img;
            if (Storage::exists($existingFile)) {
                Storage::delete($existingFile);
            }
        }

        //既存のレビューをreviewsテーブルから削除
        Review::where('shop_id',$shopId)
                ->where('user_id',$userId)
                ->delete();

        return view('review_deleted', compact('userId'));
    }
}

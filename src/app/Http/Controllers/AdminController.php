<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Shop;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
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

}

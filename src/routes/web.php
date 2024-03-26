<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ReservationController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/',[ShopController::class,'index']);
Route::get('/index/area',[ShopController::class,'searchArea']);
Route::get('/index/genre',[ShopController::class,'searchGenre']);
Route::get('/index/keyword',[ShopController::class,'searchKeyword']);
Route::get('/register',[AuthController::class,'toRegister']);
//Route::post('/register',[AuthController::class,'register']);
Route::get('/login',[AuthController::class,'toLogin']);
Route::post('/thanks',[AuthController::class,'thanks']);
Route::get('/home',[ShopController::class,'home']);
Route::get('/home/area',[ShopController::class,'searchAreaHome']);
Route::get('/home/genre',[ShopController::class,'searchGenreHome']);
Route::get('/home/keyword',[ShopController::class,'searchKeywordHome']);
Route::get('/detail',[ShopController::class,'detail']);
Route::get('/like',[FavoriteController::class,'like']);
Route::get('/done',[ReservationController::class,'done']);
Route::get('mypage',[ShopController::class,'mypage']);
Route::get('/delete',[ReservationController::class,'delete']);
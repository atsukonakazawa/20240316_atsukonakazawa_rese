<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MailSendController;
use App\Http\Controllers\PaymentController;


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

/* 利用者 */
Route::get('/',[ShopController::class,'index'])->name("index");
Route::get('/index/area',[ShopController::class,'searchArea']);
Route::get('/index/genre',[ShopController::class,'searchGenre']);
Route::get('/index/keyword',[ShopController::class,'searchKeyword']);
Route::get('/register',[AuthController::class,'toRegister']);
Route::get('/login',[AuthController::class,'toLogin']);


Route::middleware('auth')->group(function () {
    Route::get('/home',[ShopController::class,'home']);
    Route::get('/home/area',[ShopController::class,'searchAreaHome']);
    Route::get('/home/genre',[ShopController::class,'searchGenreHome']);
    Route::get('/home/keyword',[ShopController::class,'searchKeywordHome']);
    Route::get('/detail',[ShopController::class,'detail']);
    Route::get('/like',[FavoriteController::class,'like']);
    Route::get('/like/mypage',[FavoriteController::class,'likeMypage']);
    Route::get('/done',[ReservationController::class,'done']);
    Route::get('/mypage',[ShopController::class,'mypage']);
    Route::get('/delete',[ReservationController::class,'delete']);
    Route::get('/change',[ReservationController::class,'change']);
    Route::get('/changed',[ReservationController::class,'changed']);
    Route::get('/review',[ReviewController::class,'review']);
    Route::get('/reviewed',[ReviewController::class,'reviewed']);
});

/* 店舗代表者 */
    Route::get('/manager',[ManagerController::class,'manager']);
    Route::get('/manager/new/shop',[ManagerController::class,'newShop']);
    Route::post('/manager/new/shop/created',[ManagerController::class,'store']);
    Route::get('/manager/update/shop',[ManagerController::class,'updateShop']);
    Route::post('/manager/updated/shop',[ManagerController::class,'updatedShop']);
    Route::get('/manager/confirm/rese',[ManagerController::class,'confirmRese']);

/* 管理者 */
    Route::get('/admin/admin',[AdminController::class,'admin']);
    Route::post('/admin/create/manager',[AdminController::class,'createManager']);

/* メール送信関係 */
    Route::post('/verify',[MailSendController::class,'verify']);
    Route::get('/thanks', [MailSendController::class, 'thanks']);
    Route::get('/manager/notify/email/create', [MailSendController::class, 'notifyEmail']);
    Route::post('/manager/notify/email/confirm', [MailSendController::class, 'notifyEmailConfirm']);
    Route::post('/manager/notify/email/send', [MailSendController::class, 'notifyEmailSend']);

/* 決済 */
    Route::middleware('auth')->group(function () {
        Route::get('/payment',[PaymentController::class,'payment']);//決済ページに飛ぶ
        Route::post('/pay', [PaymentController::class, 'pay']);//カード番号などの送信

    });
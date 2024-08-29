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
Route::get('/index/search',[ShopController::class,'search']);
Route::get('/register',[AuthController::class,'toRegister']);
Route::get('/login',[AuthController::class,'toLogin']);
Route::get('/detail',[ShopController::class,'detail']);
Route::get('/detail/index',[ShopController::class,'detailIndex']);
Route::get('/index/shuffle',[ShopController::class,'indexShuffle']);
Route::get('/index/desc',[ShopController::class,'indexDesc']);
Route::get('/index/asc',[ShopController::class,'indexAsc']);
Route::get('/home/shuffle',[ShopController::class,'homeShuffle']);
Route::get('/home/desc',[ShopController::class,'homeDesc']);
Route::get('/home/asc',[ShopController::class,'homeAsc']);



Route::middleware('auth')->group(function () {
    Route::get('/home',[ShopController::class,'home']);
    Route::get('/home/search',[ShopController::class,'searchHome']);
    Route::get('/like',[FavoriteController::class,'like']);
    Route::get('/like/mypage',[FavoriteController::class,'likeMypage']);
    Route::get('/done',[ReservationController::class,'done']);
    Route::get('/mypage',[ShopController::class,'mypage']);
    Route::get('/delete/rese',[ReservationController::class,'deleteRese']);
    Route::get('/change',[ReservationController::class,'change']);
    Route::get('/changed',[ReservationController::class,'changed']);
    Route::get('/show/reviews',[ReviewController::class,'showReviews']);
    Route::get('/visited',[ReviewController::class,'visited']);
    Route::get('/review',[ReviewController::class,'review']);
    Route::get('/edit',[ReviewController::class,'edit']);
    Route::post('/upload',[ReviewController::class,'upload']);
    Route::get('/delete',[ReviewController::class,'delete']);
    Route::get('/remove',[ReviewController::class,'remove']);
    Route::post('/reviewed',[ReviewController::class,'reviewed']);
});

/* 店舗代表者 */
    Route::get('/manager',[ManagerController::class,'manager']);
    Route::get('/manager/new/shop',[ManagerController::class,'newShop']);
    Route::post('/manager/new/shop/created',[ManagerController::class,'store']);
    Route::get('/manager/update/shop',[ManagerController::class,'updateShop']);
    Route::post('/manager/updated/shop',[ManagerController::class,'updatedShop']);
    Route::get('/manager/confirm/rese',[ManagerController::class,'confirmRese']);

/* 管理者 */
    Route::get('/admin/menu',[AdminController::class,'adminMenu']);
    Route::get('/admin/admin',[AdminController::class,'admin']);
    Route::get('/admin/review',[AdminController::class,'adminReview']);
    Route::get('/admin/review/delete',[AdminController::class,'adminReviewDelete']);
    Route::get('/admin/review/remove',[AdminController::class,'adminReviewRemove']);
    Route::post('/admin/create/manager',[AdminController::class,'createManager']);
    Route::get('/admin/import',[AdminController::class,'toImport']);
    Route::post('/import', [AdminController::class,'shopsImport']);


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



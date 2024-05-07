<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;

class PaymentController extends Controller
{
    public function payment(){

        return view('payment.payment');
    }

    public function pay(Request $request){
        try{
            //.envに追加したシークレットキーを使用
            Stripe::setApiKey(env('STRIPE_SECRET'));

            //送信された金額を取得
            $amount = $request->input('amount');

            //顧客情報をStripe側に登録
            $customer = Customer::create(array('email' => $request->stripeEmail,
                                            'source' => $request->stripeToken
                                            )
                                        );

            //支払処理
            $charge = Charge::create(array('customer' => $customer->id,
                                        'amount' => $amount,//送信された金額
                                        'currency' => 'jpy'
                                        )
                                    );

            return view('payment.complete');

        }catch(Exception $e){

            return $e->getMessage();
        }
    }
}

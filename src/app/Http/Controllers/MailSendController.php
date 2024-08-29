<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Models\User;
use App\Http\Requests\UserRequest;


class MailSendController extends Controller
{
    public function verify(UserRequest $request){

        $user = $request->all();
        $email = $request->email;
        User::create($user);

        $data = [];

        Mail::send('emails.verify', $data, function($message)use($email){
            $message->to($email, 'Test')
            ->subject('This is a test mail');
        });

        return view('auth.verifyEmail');
    }

    public function thanks(Request $request){

        return view('thanks');
    }

    public function notifyEmail(){

        return view('emails.notifyEmailCreate');
    }

    public function notifyEmailConfirm(Request $request){

        $subject = $request->subject;
        $notify = $request->notify;
        $user = User::where('name',$request->name)
                    ->first();

        if($user !== null){

            return view('emails.notifyEmailConfirm',compact('user','subject','notify'));

        }else{
            session()->flash('message','入力された利用者名が見つかりませんでした');

            return view('emails.notifyEmailCreate');
        }
    }

    public function notifyEmailSend(Request $request){

        $name = $request->name;
        $email = $request->email;
        $subject = $request->subject;
        $notify = $request->notify;

        $data = [];

        Mail::send([], [], function($message) use ($email, $name, $subject, $notify) {
        $message->to($email, $name)
            ->subject($subject)
            ->setBody($notify);
        });

        return view('emails.notifyEmailSent');
    }
}

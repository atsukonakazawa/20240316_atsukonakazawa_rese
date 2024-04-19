@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/verifyEmail.css') }}">
@endsection

@section('main')
<div class="verify-email__content">
    <div class="verify-email__content-title">
        <h2 class="h2">メールによる本人確認のお願い</h2>
    </div>
    <p class="verify-email__p">
        メールアドレスに送信された認証ボタンをクリックしてください
    </p>
</div>
@endsection
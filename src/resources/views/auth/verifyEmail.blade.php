@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/emails/verifyEmail.css') }}">
@endsection

@section('header-logo')
<div class="header-logo__outer open-modal" >
    <a class="header-logo" href="/">
        <img class="logo-icon" src="{{ asset('icon/Rese icon.png') }}" alt="Rese" >
        Rese
    </a>
</div>

<!--ここからモーダルウィンドウ-->
<div id="modal" class="modal">
    <!-- ここからモーダルコンテンツ -->
    <div class="modal-content">
        <div class="close-button__outer">
            <button class="close">
                &times;
            </button>
        </div>
        <div class="choices">
            <p>
                お気に入り機能・ご予約はログイン後にご利用いただけます
            </p>
            <a href="/">
                Home
            </a><br>
            <a href="/register">
                Registration
            </a><br>
            <a href="/login">
                Login
            </a>
        </div>
    </div>
</div>
<!--ここまでモーダルウィンドウ-->
<script src="{{ asset('js/index.js') }}"></script>
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
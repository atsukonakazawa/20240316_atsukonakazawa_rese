@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
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
<div class="content-outer">
    <div class="content">
        <div class="thanks-box">
            <h2 class="thanks-message">
                会員登録ありがとうございます
            </h2>
            <div class="button-outer">
                <a href="/login" method="get">
                    ログインする
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
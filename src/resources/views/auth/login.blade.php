@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
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
        <form action="/login" method="post">
        @csrf
            <div class="login-box">
                <h2 class="title">
                    Login
                </h2>

                <div class="email-row">
                    <img src="icon/Rese email icon.png" alt="email">
                    <input class="email" type="text" name="email" value="{{ old('email') }}" placeholder="email"/>
                </div>
                <div class="form__error">
                @error('email')
                    {{ $message }}
                @enderror
                </div>

                <div class="password-row">
                    <img src="icon/Rese password icon.png" alt="password">
                    <input class="password" name="password" type="password" value="{{ old('password') }}" placeholder="password">
                </div>
                <div class="form__error">
                @error('password')
                    {{ $message }}
                @enderror
                </div>

                <div class="login-button__outer">
                    <button class="login-button">
                        ログイン
                    </button>
                </div>
            </div>
        </form>
        <a class="register-a" href="/register">
            会員登録はこちら
        </a>
    </div>
</div>
@endsection

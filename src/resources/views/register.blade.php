@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
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
        <form action="/verify" method="post">
        @csrf
            <div class="register-box">
                <h2 class="title">
                    Registration
                </h2>

                <div class="name-row">
                    <img src="icon/Rese username icon.png" alt="username">
                    <input class="name" name="name" value="{{ old('name') }}" type="text" placeholder="Username(ニックネーム可)">
                </div>
                <div class="form__error">
                @error('name')
                    {{ $message }}
                @enderror
                </div>

                <div class="email-row">
                    <img src="icon/Rese email icon.png" alt="email">
                    <input class="email" type="text" name="email" value="{{ old('email') }}" placeholder="Email"/>
                </div>
                <div class="form__error">
                @error('email')
                    {{ $message }}
                @enderror
                </div>

                <div class="password-row">
                    <img src="icon/Rese password icon.png" alt="password">
                    <input class="password" name="password" type="password" value="{{ old('password') }}" placeholder="Password">
                </div>
                <div class="form__error">
                @error('password')
                    {{ $message }}
                @enderror
                </div>

                <div class="register-button__outer">
                    <button class="register-button">
                        登録
                    </button>
                </div>
            </div>
        </form>
        <a class="login-a" href="/login">
            ログインはこちら
        </a>
    </div>
</div>
@endsection

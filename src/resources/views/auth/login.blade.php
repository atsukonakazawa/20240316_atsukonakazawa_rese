@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
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

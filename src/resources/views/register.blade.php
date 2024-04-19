@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('main')
<div class="content-outer">
    <div class="content">
        <form action="/verify" method="get">
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
    </div>

</div>
@endsection

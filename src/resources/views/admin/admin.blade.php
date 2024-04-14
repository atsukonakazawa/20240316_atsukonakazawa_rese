@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/admin.css') }}">
@endsection

@section('main')
<div class="content-outer">
    <div class="content">
        <div class="title-outer">
            <h2 class="title">
                管理者　専用画面
            </h2>
        </div>
        <div class="subtitle-outer">
            <h2 class="subtitle">
                店舗代表者　新規作成画面
            </h2>
        </div>
        <form action="/admin/create/manager" method="post">
        @csrf
            <div class="inputs-group">
                <div class="name-outer">
                    <input type="text" name="name" placeholder="店舗代表者の名前を入力してください" value="{{ old('name') }}">
                </div>
                <div class="error-outer">
                    @error('name')
                    <p class="error-p" style="color: red">
                        {{$errors->first('name')}}　
                    </p>
                    @enderror
                </div>
                <div class="email-outer">
                    <input type="text" name="email" placeholder="店舗代表者のメールアドレスを入力してください" value="{{ old('email') }}">
                </div>
                <div class="error-outer">
                    @error('email')
                    <p class="error-p" style="color: red">
                        {{$errors->first('email')}}　
                    </p>
                    @enderror
                </div>
                <div class="password-outer">
                    <input type="password" name="password" placeholder="店舗代表者のパスワードを入力してください">
                </div>
                <div class="error-outer">
                    @error('password')
                    <p class="error-p" style="color: red">
                        {{$errors->first('password')}}　
                    </p>
                    @enderror
                </div>
                <div class="button-outer">
                    <button class="button" type="submit">
                        送信する
                    </button>
                </div>
            </div>
        </form>
        <div class="logout-outer">
            <form action="/logout" method="post">
            @csrf
                <button class="logout-button">
                    ログアウト
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
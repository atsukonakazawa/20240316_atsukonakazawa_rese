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
                    <input type="text" name="name" placeholder="店舗代表者の名前を入力してください">
                </div>
                <div class="email-outer">
                    <input type="text" name="email" placeholder="店舗代表者のメールアドレスを入力してください">
                </div>
                <div class="password-outer">
                    <input type="password" name="password" placeholder="店舗代表者のパスワードを入力してください">
                </div>
                <div class="button-outer">
                    <button class="button" type="submit">
                        送信する
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
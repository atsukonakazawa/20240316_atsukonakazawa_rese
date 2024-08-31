@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/emails/notifyEmailCreate.css') }}">
@endsection

@section('header-logo')
<div class="header-logo__outer open-modal" >
    <a class="header-logo" href="">
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
            <a href="/home">
                Home
            </a><br>
            <form action="/mypage" method="get">
            @csrf
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <button class="mypage-button" type="submit">
                        マイページ
                    </button>
            </form><br>
            <form action="/logout" method="post">
            @csrf
                <button class="logout-button">
                    ログアウト
                </button>
            </form>
        </div>
    </div>
</div>
<!--ここまでモーダルウィンドウ-->
<script src="{{ asset('js/index.js') }}"></script>
@endsection


@section('main')
<div class="content-outer">
    <div class="content">
        <div class="title-outer">
            <h2 class="title">
                店舗代表者　専用画面
            </h2>
        </div>
        <div class="subtitle-outer">
            <h2 class="subtitle">
                お知らせメール作成画面
            </h2>
        </div>
        <form action="/manager/notify/email/confirm" method="post">
        @csrf
            <div class="message-outer">
                <p class="message">
                @if(session('message'))
                    {{ session('message')}}
                @endif
                </p>
            </div>
            <div class="inputs-group">
                <div class="name-outer">
                    <label for="name">送信先の利用者名</label><br>
                    <input class="name" name="name" type="text" value="{{ old('name') }}">
                    <div class="error-outer">
                        @error('name')
                        <p class="error-p" style="color: red">
                            {{$errors->first('name')}}
                        </p>
                        @enderror
                    </div>
                </div>
                <div class="subject-outer">
                    <label for="subject">件名</label><br>
                    <input class="subject" name="subject" type="text" value="{{ old('subject') }}">
                    <div class="error-outer">
                        @error('subject')
                        <p class="error-p" style="color: red">
                            {{$errors->first('subject')}}
                        </p>
                        @enderror
                    </div>
                </div>
                <div class="notify-outer">
                    <label for="notify">本文</label><br>
                    <textarea class="notify" name="notify" cols="50" rows="5" value="{{ old('notify') }}"></textarea>
                    <div class="error-outer">
                        @error('notify')
                        <p class="error-p" style="color: red">
                            {{$errors->first('notify')}}
                        </p>
                        @enderror
                    </div>
                </div>
                <div class="button-outer">
                    <button class="button" type="submit">
                        内容を確認する
                    </button>
                    <a class="back-link" href="/manager">
                        戻る
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
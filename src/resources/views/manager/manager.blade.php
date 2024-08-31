@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/manager/manager.css') }}">
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
        <div class="links-outer">
            <div class="new-shop__link-outer">
                <a href="/manager/new/shop">
                    店舗情報を新規作成する
                </a>
            </div>
            <div class="update-shop__link-outer">
                <a href="/manager/update/shop">
                    店舗情報を更新する
                </a>
            </div>
            <div class="confirm-rese__link-outer">
                <a href="/manager/confirm/rese">
                    予約情報を確認する
                </a>
            </div>
            <div class="notify-email__link-outer">
                <a href="/manager/notify/email/create">
                    利用者にメールを送る
                </a>
            </div>
        </div>
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
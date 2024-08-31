@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/manager/newShopCreated.css') }}">
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
        <div class="done-box">
            <h2 class="done-message">
                店舗情報を新規作成しました
            </h2>
            <p class="shop-id__announce">
                新しい店舗の店舗IDは
                <span class="shop-id__span">
                    {{ $newShopId->id }}
                </span>
                です
            </p>
            <p class="shop-id__keep">
                店舗代表者ログインの際に必要なため店舗IDは保管をお願いします
            </p>
            <div class="link-outer">
                <a class="back-link" href="/manager" method="get">
                    戻る
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
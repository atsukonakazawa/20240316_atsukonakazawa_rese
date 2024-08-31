@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/review_delete_confirm.css') }}">
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
<div class="content__outer">
    <div class="title__outer">
        <h2 class="title">
            選択したレビューを本当に削除しますか？
        </h2>
        <p class="title__outer-p">
            ※一度削除すると元に戻せません
        </p>
    </div>
    <div class="button__outer">
        <form action="/remove" method="get">
        @csrf
            <div class="remove__button-outer">
                <button class="remove__button" type="submit">
                    レビューを削除する
                </button>
                <input type="hidden" name="user_id" value="{{ $userId }}">
                <input type="hidden" name="shop_id" value="{{ $shopId }}">
            </div>
        </form>
        <div class="visited-box">
            <form action="/visited" method="get">
            @csrf
                <button class="visited" type="submit" >
                    戻る
                </button>
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            </form>
        </div>
    </div>
</div>
@endsection
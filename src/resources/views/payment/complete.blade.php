@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/payment/complete.css') }}">
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
        <div class="complete-box">
            <h2 class="complete-message">
                決済が完了しました
            </h2>
            <div class="button-outer">
                <button class="back-button open-modal">
                    戻る
                </button>

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
                            <form action="/logout" method="post">
                            @csrf
                            <button class="logout-button">
                                Logout
                            </button>
                            </form><br>
                            <form action="/mypage" method="get">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <button class="mypage-button" type="submit">
                                MyPage
                            </button>
                            </form>
                        </div>
                    </div>
                </div>
                <!--ここまでモーダルウィンドウ-->
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/complete.js') }}"></script>
@endsection
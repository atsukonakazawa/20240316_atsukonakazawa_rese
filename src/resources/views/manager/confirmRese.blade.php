@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/manager/confirmRese.css') }}">
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
                予約情報　確認画面
            </h2>
        </div>
        <div class="input-id__outer">
            <form action="/manager/confirm/rese" method="get">
            @csrf
                <input class="input-id" name="shop_id" type="text" placeholder="店舗IDを入力してください">
                <button class="id-button" type="submit">
                    送信
                </button>
            </form>
        </div>
        <div class="confirm-table__outer">
            <table class="confirm-table">
                <tr class="title-row">
                    <th class="user-name">
                        予約者氏名
                    </th>
                    <th>
                        日付
                    </th>
                    <th>
                        時間
                    </th>
                    <th>
                        人数
                    </th>
                </tr>
                @foreach($reservations as $reservation)
                <tr class="rese-row">
                    <td>
                        {{ $reservation->user->name }}
                    </td>
                    <td>
                        {{ $reservation->rese_date }}
                    </td>
                    <td>
                        {{ $reservation->rese_time }}
                    </td>
                    <td>
                        {{ $reservation->rese_people }}
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
        <div class="back-link__outer">
            <a class="back-link" href="/manager">
                戻る
            </a>
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/emails/notifyEmailConfirm.css') }}">
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
                メール内容確認
            </h2>
        </div>
        <form action="/manager/notify/email/send" method="post">
        @csrf
            <div class="confirm-table__outer">
                    <table class="confirm-table">
                        <tr class="name-row">
                            <th class="user-name">
                                送信先　利用者名
                            </th>
                            <td>
                                {{ $user->name }}
                            </td>
                        </tr>
                        <tr class="email-row">
                            <th>
                                送信先　メールアドレス
                            </th>
                            <td>
                                {{ $user->email }}
                            </td>
                        </tr>
                        <tr class="subject-row">
                            <th>
                                件名
                            </th>
                            <td>
                            {{ $subject }}
                            </td>
                        </tr>
                        <tr class="notify-row">
                            <th>
                                本文
                            </th>
                            <td>
                                {{ $notify }}
                            </td>
                        </tr>
                    </table>
            </div>
            <div class="button-outer">
                <button type="submit" class="button">
                    送信する
                </button>
                <input type="hidden" name="name" value="{{ $user->name }}">
                <input type="hidden" name="email" value="{{ $user->email }}">
                <input type="hidden" name="subject" value="{{ $subject }}">
                <input type="hidden" name="notify" value="{{ $notify }}">
                <a class="back-link" href="/manager/notify/email/create">
                    戻る
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/manager/manager.css') }}">
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
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/done.css') }}">
@endsection

@section('main')
<div class="content-outer">
    <div class="content">
        <div class="done-box">
            <h2 class="done-message">
                ご予約ありがとうございます
            </h2>
            <div class="button-outer">
                <div class="choices">
                    <a class="home-button" href="/home">
                        ホーム
                    </a><br>
                    <form action="/logout" method="post">
                    @csrf
                        <button class="logout-button">
                            ログアウト
                        </button>
                    </form><br>
                    <form action="/mypage" method="get">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <button class="mypage-button" type="submit">
                            マイページ
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
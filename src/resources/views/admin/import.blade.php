@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/import.css') }}">
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
                新規店舗情報　追加画面
            </h2>
        </div>
        <div class="import-box">
            <form action="/import" method="post" enctype="multipart/form-data">
            @csrf
                <p class="csv-p">
                    CSVファイルを選択してください
                </p>
                <input class="input" type="file" name="csv_file" accept=".csv">
                <button class="button" type="submit">インポート</button>
            </form>
            <div class="message-outer">
            @if ($errors->any())
                <div class="alert-danger">
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif
            @if(session('success'))
                <div class="alert-success">
                    {{ session('success') }}
                </div>
            @endif
            </div>
        </div>
    </div>
</div>
@endsection

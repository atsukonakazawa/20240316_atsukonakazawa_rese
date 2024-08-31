@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/manager/newShop.css') }}">
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
                店舗情報　新規作成画面
            </h2>
        </div>
        <form action="/manager/new/shop/created" method="post">
        @csrf
            <div class="inputs-group">
                <div class="area-outer">
                    <select name="area_id" id="" >
                        <option disabled selected value="">
                            エリアを選択してください
                        </option>
                        @foreach($areas as $area)
                        <option value="{{ $area->id }}">{{ $area->area_name }}</option>
                        @endforeach
                    </select>
                    <div class="error-outer">
                        @error('area_id')
                        <p class="error-p" style="color: red">
                            {{$errors->first('area_id')}}
                        </p>
                        @enderror
                    </div>
                </div>
                <div class="genre-outer">
                    <select name="genre_id" id="">
                        <option disabled selected value="">
                            ジャンルを選択してください
                        </option>
                        @foreach($genres as $genre)
                        <option value="{{ $genre->id }}">{{ $genre->genre_name }}</option>
                        @endforeach
                    </select>
                    <div class="error-outer">
                        @error('genre_id')
                        <p class="error-p" style="color: red">
                            {{$errors->first('genre_id')}}
                        </p>
                        @enderror
                    </div>
                </div>
                <div class="name-outer">
                    <input type="text" name="shop_name" placeholder="店舗名を入力してください" value="{{ old('shop_name') }}">
                    <div class="error-outer">
                        @error('shop_name')
                        <p class="error-p" style="color: red">
                            {{$errors->first('shop_name')}}
                        </p>
                        @enderror
                    </div>
                </div>
                <div class="detail-outer">
                    <textarea name="shop_detail" id="" cols="50" rows="5" placeholder="店舗概要を入力してください" value="{{ old('shop_detail') }}"></textarea>
                    <div class="error-outer">
                        @error('shop_detail')
                        <p class="error-p" style="color: red">
                            {{$errors->first('shop_detail')}}
                        </p>
                        @enderror
                    </div>
                </div>
                <div class="button-outer">
                    <button class="button" type="submit">
                        新規作成する
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
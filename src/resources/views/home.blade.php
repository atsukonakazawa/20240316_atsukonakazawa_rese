@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
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


@section('search')
<!--search-->
<div class="search-outer">
    <div class="search-box">
        <div class="search-area" >
            <form id="search-form" action="/home/search" method="get">
                @csrf
                <select class="search-area__inner" name="area_id" onchange="this.form.submit()">
                    <option disabled selected value="">Area</option>
                    @foreach($areas as $area)
                    <option value="{{ $area['id'] }}" {{ session('selected_area_id') == $area['id'] ? 'selected' : '' }}>
                        {{ $area['area_name'] }}
                    </option>
                    @endforeach
                </select>
        </div>
        <div class="search-genre">
                <select class="search-genre__inner" name="genre_id" onchange="this.form.submit()">
                    <option disabled selected value="">Genre</option>
                    @foreach($genres as $genre)
                    <option value="{{ $genre['id'] }}" {{ session('selected_genre_id') == $genre['id'] ? 'selected' : '' }}>
                        {{ $genre['genre_name'] }}
                    </option>
                    @endforeach
                </select>
        </div>
        <div class="search-keyword">
                <input class="search-keyword__inner" type="text" name="keyword" onchange="this.form.submit()" placeholder="🔍Search" value="{{ session('selected_keyword') }}">
            </form>
        </div>
    </div>
</div>
@endsection

@section('main')
<!--店舗一覧-->
<div class="content-outer">
    <div class="title-outer">
        <p class="message">
        {{ Auth::user()->name }}さま、ようこそ！
        </p>
        <form action="/mypage" method="get">
        @csrf
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <button class="mypage-button" type="submit">
                    マイページ
                </button>
        </form>
        <form action="/logout" method="post">
        @csrf
            <button class="logout-button">
                ログアウト
            </button>
        </form>
    </div>
    <div class="sort-row">
        <div class="shuffle-button__outer">
            <form action="/home/shuffle">
            @csrf
                <button class="shuffle-button" type="submit">
                    ランダムに表示
                </button>
            </form>
        </div>
        <div class="desc-button__outer">
            <form action="/home/desc">
            @csrf
                <button class="desc-button" type="submit">
                    評価が高い順に表示
                </button>
            </form>
        </div>
        <div class="asc-button__outer">
            <form action="/home/asc">
            @csrf
                <button class="asc-button" type="submit">
                    評価が低い順に表示
                </button>
            </form>
        </div>
    </div>
    <div class="shops-content">
        <!--1店舗-->
        @foreach($shops as $shop)
        <div class="shop-box">
            <div class="shop-img">
                <img src="{{ asset('storage/images/' . $shop->shop_img) }}" alt="shop_img">
            </div>
            <div class="shop-content">
                <h2 class="shop-name">
                    {{ $shop->shop_name }}
                </h2>
                <div class="area-genre__row">
                    <div class="shop-area">
                        #{{ $shop->area->area_name }}
                    </div>
                    <div class="shop-genre">
                        #{{ $shop->genre->genre_name }}
                    </div>
                </div>
                <div class="button-outer">
                    <form action="/detail" method="get">
                    @csrf
                    <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                    <button type="submit" class="detail-button">
                        詳しく見る
                    </button>
                    </form>
                    <form action="/like" method="get">
                    @csrf
                    <button class="like-button" onclick="toggleLike(this, {{ $shop->id }})">
                        <img class="heart-icon" src="{{ in_array($shop->id, $favorites) ? asset('icon/heart-red.jpeg') : asset('icon/heart-white.png') }}" alt="heart">
                    </button>
                    @if (Auth::check())
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    @endif
                    <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="manager-admin">
        <div class="toManager-outer">
            <form action="/manager" method="get">
            @csrf
                <button class="toManager" type="submit">
                    店舗代表者さまはこちら
                </button>
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            </form>
        </div>
        <div class="to-admin-outer">
            <form action="/admin/menu" method="get">
            @csrf
                <button class="to-admin__menu" type="submit">
                    管理者さまはこちら
                </button>
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            </form>
        </div>
    </div>
    <div class="second-message__outer">
        <p class="second-message">
        @if(session('message'))
            {{ session('message')}}
        @endif
        </p>
    </div>
</div>
@endsection

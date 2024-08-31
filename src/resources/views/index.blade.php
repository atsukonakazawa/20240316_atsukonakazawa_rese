@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('header-logo')
<div class="header-logo__outer open-modal" >
    <a class="header-logo" href="/">
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
            <p>
                お気に入り機能・ご予約はログイン後にご利用いただけます
            </p>
            <a href="/">
                Home
            </a><br>
            <a href="/register">
                Registration
            </a><br>
            <a href="/login">
                Login
            </a>
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
            <form id="search-form" action="/index/search" method="get">
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
    <div class="sort-row">
        <div class="shuffle-button__outer" type="submit">
            <form action="/index/shuffle">
                <button class="shuffle-button">
                    ランダムに表示
                </button>
            </form>
        </div>
        <div class="desc-button__outer" type="submit">
            <form action="/index/desc">
                <button class="desc-button">
                    評価が高い順に表示
                </button>
            </form>
        </div>
        <div class="asc-button__outer" type="submit">
            <form action="/index/asc">
                <button class="asc-button">
                    評価が低い順に表示
                </button>
            </form>
        </div>
    </div>
    <div class="shops-content">
        <!--各店舗-->
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
                    <form action="/detail/index" method="get">
                    @csrf
                    <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                    <button type="submit" class="detail-button">
                        詳しく見る
                    </button>
                    </form>

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
                                <p>
                                    お気に入り機能・ご予約はログイン後にご利用いただけます
                                </p>
                                <a href="/">
                                    Home
                                </a><br>
                                <a href="/register">
                                    Registration
                                </a><br>
                                <a href="/login">
                                    Login
                                </a>
                            </div>
                        </div>
                    </div>
                    <!--ここまでモーダルウィンドウ-->

                    <button class="like-button open-modal">
                        <img class="heart-icon" src="{{ asset('icon/heart-white.png') }}" alt="heart">
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<script src="{{ asset('js/index.js') }}"></script>
@endsection
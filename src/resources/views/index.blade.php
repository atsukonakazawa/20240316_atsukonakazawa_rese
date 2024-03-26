@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('search')
<!--search-->
<div class="search-outer">
    <div class="search-box">
        <div class="search-area" >
            <form id="area-form" action="/index/area" method="get">
            @csrf
                <select class="search-area__inner" name="area_id" onchange="this.form.submit()">
                    <option disabled selected value="">All area</option>
                    @foreach($areas as $area)
                    <option value="{{ $area['id'] }}">{{ $area['area_name'] }}</option>
                    @endforeach
                </select>
            </form>
        </div>
        <div class="search-genre" >
            <form id="genre-form" action="/index/genre" method="get">
                <select class="search-genre__inner" name="genre_id" onchange="this.form.submit()">
                    <option disabled selected value="">All genre</option>
                    @foreach($genres as $genre)
                    <option value="{{ $genre['id'] }}">{{ $genre['genre_name'] }}</option>
                    @endforeach
                </select>
            </form>
        </div>
        <div class="search-keyword" >
            <form id="keyword-form" action="/index/keyword" method="get">
            <input class="search-keyword__inner" type="text" name="keyword" onchange="this.form.submit()" placeholder="🔍Search..." value="">
        </div>
    </div>
</div>
@endsection

@section('main')
<!--店舗一覧-->
<div class="content-outer">
    <div class="shops-content">

        <!--1店舗-->
        @foreach($shops as $shop)
        <div class="shop-box">
            <div class="shop-img">
                <img src="{{ $shop->shop_img }}" alt="shop_img">
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
                    <button class="detail-button open-modal">
                        詳しくみる
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
                        <img class="heart-icon" src="icon/heart-white.png" alt="heart">
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<script src="{{ asset('js/index.js') }}"></script>
@endsection
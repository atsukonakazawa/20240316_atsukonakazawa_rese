@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection

@section('search')
<!--search-->
<div class="search-outer">
    <div class="search-box">
        <div class="search-area" >
            <form id="area-form" action="/home/area" method="get">
                <select class="search-area__inner" name="area_id" onchange="this.form.submit()">
                    <option disabled selected value="">All area</option>
                    @foreach($areas as $area)
                    <option value="{{ $area['id'] }}">{{ $area['area_name'] }}</option>
                    @endforeach
                </select>
            </form>
        </div>
        <div class="search-genre" >
            <form id="genre-form" action="/home/genre" method="get">
            @csrf
                <select class="search-genre__inner" name="genre_id" onchange="this.form.submit()">
                    <option disabled selected value="">All genre</option>
                    @foreach($genres as $genre)
                    <option value="{{ $genre['id'] }}">{{ $genre['genre_name'] }}</option>
                    @endforeach
                </select>
            </form>
        </div>
        <div class="search-keyword" >
            <form id="keyword-form" action="/home/keyword" method="get">
            @csrf
                <input class="search-keyword__inner" type="text" name="keyword" placeholder="Search..." value="{{ old('keyword') }}">
            </form>
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
                    <form action="/detail" method="get">
                    @csrf
                    <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                    <button type="submit" class="detail-button">
                        詳しく見る
                    </button>
                    </form>
                    <form action="/like" method="get">
                    @csrf
                    @php
                        $isFavorite = auth()->user()->favorites()->where('shop_id', $shop->id)->exists();
                    @endphp
                    <button class="like-button" onclick="toggleLike(this, {{ $shop->id }})">
                        <img class="heart-icon" src="{{ $isFavorite ? 'icon/heart-red.jpeg' : 'icon/heart-white.png' }}" alt="heart">
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
</div>
@endsection
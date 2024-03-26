@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection 

@section('main')
<div class="content-outer">
    <div class="content">
        <div class="reservation-list__box">
            <h2 class="reservation-list__title">
                予約状況
            </h2>
            @foreach($reservations as $reservation)
            <div class="each-reservation__box">
                <div class="each-reservation__title-row">
                    <img src="icon/Rese clock icon.png" alt="clock">
                    <h3 class="each-title">

                    </h3>
                    <form action="/delete" method="get">
                    @csrf
                        <input type="hidden" name="delete_id" value="{{ $reservation->id }}">
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <button class="close">
                            &times;
                        </button>
                    </form>
                </div>
                <table class="each-reservation__table">
                    <tr class="shop-row">
                        <th>
                            Shop
                        </th>
                        <td>
                            {{ $reservation->shop->shop_name }}
                        </td>
                    </tr>
                    <tr class="date-row">
                        <th>
                            Date
                        </th>
                        <td>
                            {{ $reservation->rese_date }}
                        </td>
                    </tr>
                    <tr class="time-row">
                        <th>
                            Time
                        </th>
                        <td>
                            {{ $reservation->rese_time }}
                        </td>
                    </tr>
                    <tr class="number-row">
                        <th>
                            Number
                        </th>
                        <td>
                            {{ $reservation->rese_people }}
                        </td>
                    </tr>
                </table>
            </div>
            @endforeach
        </div>
        <div class="favorites-box">
            <h2 class="user-name">
                {{ Auth::user()->name }}さん
            </h2>
            <h3 class="favorites-title">
                お気に入り店舗
            </h3>
            <div class="favorites-content">

                <!--１店舗-->
                @foreach($favorites as $favorite)
                <div class="each-favorite__box">
                    <div class="shop-img">
                        <img src="{{ $favorite->shop->shop_img }}" alt="shop_img">
                    </div>
                    <div class="shop-content">
                        <form action="/detail" method="get">
                        @csrf
                        <h2 class="shop-name">
                            {{ $favorite->shop->shop_name }}
                        </h2>
                        <div class="area-genre__row">
                            <div class="shop-area">
                                #{{ $favorite->shop->area->area_name }}
                            </div>
                            <div class="shop-genre">
                                #{{ $favorite->shop->genre->genre_name }}
                            </div>
                        </div>
                        <div class="button-outer">
                            <input type="hidden" name="shop_id" value="{{ $favorite->shop_id }}">
                            <button type="submit" class="detail-button">
                                詳しく見る
                            </button>
                            </form>
                            <form action="/like" method="get">
                            @csrf
                            @php
                                $isFavorite = auth()->user()->favorites()->where('shop_id', $favorite->shop_id)->exists();
                            @endphp
                            <button class="like-button" onclick="toggleLike(this, {{ $favorite->shop_id }})">
                                <img class="heart-icon" src="{{ $isFavorite ? 'icon/heart-red.jpeg' : 'icon/heart-white.png' }}" alt="heart">
                            </button>
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <input type="hidden" name="shop_id" value="{{ $favorite->shop_id }}">
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

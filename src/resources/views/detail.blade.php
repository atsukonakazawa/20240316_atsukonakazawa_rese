@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
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
        <div class="detail-box">
        @foreach($shops as $shop)
            <div class="shop-title__row">
                <a class="back-button" href="/home">
                    <
                </a>
                <h2 class="shop-name">
                    {{ $shop->shop_name }}
                </h2>
            </div>
            <div class="shop-img__outer">
                <img class="shop-img" src="{{ asset('storage/images/' . $shop->shop_img) }}" alt="shop_img">
            </div>
            <div class="area-genre__row">
                <div>
                    #{{ $shop->area->area_name }}
                </div>
                <div>
                    #{{ $shop->genre->genre_name }}
                </div>
            </div>
            <p class="shop-detail">
                {{ $shop->shop_detail }}
            </p>
        @endforeach
        </div>
        <div class="reservation-box">
        <form action="/done" method="get">
        @csrf
            <h2 class="reservation-title">
                予約
            </h2>
            <p class="reservation-p">
                翌日以降のご予約のみ選択可能です。<br>
                当日につきましては直接お問い合わせください。
            </p>
            <input class="date" name="date" type="date" id="date"  min="{{ \Carbon\Carbon::now()->addDay()->format('Y-m-d') }}"><br>
            <select class="time" name="time" id="time"><br>
                <option disabled selected value="">時間を選択してください</option>
                <option value="11:00">11:00</option>
                <option value="12:00">12:00</option>
                <option value="13:00">13:00</option>
                <option value="14:00">14:00</option>
                <option value="15:00">15:00</option>
                <option value="16:00">16:00</option>
                <option value="17:00">17:00</option>
                <option value="18:00">18:00</option>
                <option value="19:00">19:00</option>
                <option value="20:00">20:00</option>
                <option value="21:00">21:00</option>
            </select>
            <select class="people" name="people" id="people"><br>
                <option disabled selected value="">人数を選択してください</option>
                <option value="1">1人</option>
                <option value="2">2人</option>
                <option value="3">3人</option>
                <option value="4">4人</option>
                <option value="5">5人</option>
                <option value="6">6人</option>
                <option value="7">7人</option>
                <option value="8">8人</option>
                <option value="9">9人</option>
                <option value="10">10人</option>
                <option value="" disabled>
                    それ以上の場合はお電話にてお問い合わせください
                </option>
            </select>
            <div class="confirm-outer" id="confirmationSection">
                <table class="confirm-table">
                    <tr class="confirm-shop__name-row">
                        <th>
                            Shop
                        </th>
                        <td>
                        @foreach($shops as $shop)
                            {{ $shop->shop_name }}
                        @endforeach
                        </td>
                    </tr>
                    <tr class="confirm-shop__date-row">
                        <th>
                            Date
                        </th>
                        <td id="confirmDate">
                            <span class="output-date">
                        </td>
                    </tr>
                    <tr class="confirm-shop__time-row">
                        <th>
                            Time
                        </th>
                        <td id="confirmTime">
                            <span class="output-time">
                        </td>
                    </tr>
                    <tr class="confirm-shop__people-row">
                        <th>
                            Number
                        </th>
                        <td id="confirmPeople">
                            <span class="output-people">
                        </td>
                    </tr>
                </table>
                @foreach($shops as $shop)
                    <input type="hidden" name="shop_name" value="$shop->id">
                @endforeach
                    @if (Auth::check())
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    @endif
                    <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                <div class="error-messages">
                    @if (count($errors) > 0)
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </ul>
                    @endif
                </div>
            </div>
            <button class="reservation-button" type="submit">
                予約する
            </button>
        </form>
        </div>
    </div>
</div>
<script src="{{ asset('js/detail.js') }}"></script>
@endsection
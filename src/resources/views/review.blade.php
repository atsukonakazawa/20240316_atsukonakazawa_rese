@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/review.css') }}">
@endsection

@section('main')
<div class="content-outer">
    <div class="content">
        <div class="visited-list__box">
            <h2 class="visited-list__title">
                来店履歴
            </h2>

            <!--１店舗-->
            @foreach($visitations as $key => $visitation)
            <div class="each-visited__box">
                <div class="each-visited__title-row">
                    <img src="{{ asset('icon/Rese clock icon.png') }}" alt="clock">
                    <h3 class="each-title">
                        履歴{{ $key + 1 }} <!-- 予約番号を表示 -->
                    </h3>
                </div>
                <table class="each-visited__table">
                    <tr class="shop-row">
                        <th>
                            Shop
                        </th>
                        <td>
                            {{ $visitation->shop->shop_name }}
                        </td>
                    </tr>
                    <tr class="date-row">
                        <th>
                            Date
                        </th>
                        <td>
                            {{ $visitation->rese_date }}
                        </td>
                    </tr>
                    <tr class="time-row">
                        <th>
                            Time
                        </th>
                        <td>
                            {{ $visitation->rese_time }}
                        </td>
                    </tr>
                    <tr class="number-row">
                        <th>
                            Number
                        </th>
                        <td>
                            {{ $visitation->rese_people }}
                        </td>
                    </tr>
                </table>
                <form action="/reviewed" method="get">
                @csrf
                <div class="rating-outer">
                    <p class="rating-p">
                        満足度は５段階でいくつですか？
                    </p>
                    <select class="stars" name="rating">
                        <option value="1">⭐️</option>
                        <option value="2">⭐️⭐️</option>
                        <option value="3">⭐️⭐️⭐️</option>
                        <option value="4">⭐️⭐️⭐️⭐️</option>
                        <option value="5">⭐️⭐️⭐️⭐️⭐️</option>
                    </select>
                </div>
                <div class="comment-outer">
                    <p class="comment-p">
                        ご感想をお聞かせください
                    </p>
                    <textarea class="comment" name="comment" id="" cols="30" rows="5"></textarea>
                </div>
                <div class="review-button__outer">
                    <button class="review-button" type="submit">
                        レビューを送信する
                    </button>
                    <input type="hidden" name="shopId" value="{{ $visitation->shop->id }}">
                    @if (Auth::check())
                    <input type="hidden" name="userId" value="{{ Auth::user()->id }}">
                    @endif
                </div>
                </form>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

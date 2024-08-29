@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/reviews_list.css') }}">
@endsection

@section('main')
<div class="content-outer">
    <div class="content">
        <div class="detail-box">
            <div class="shop-title__row">
                <a class="back-button" href="/home">
                    <
                </a>
                <h2 class="shop-name">
                    {{ $shop->shop_name }}
                </h2>
            </div>
            <img class="shop-img" src="{{ $shop->shop_img }}" alt="shop_img">
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
            <div class="show-reviews__outer">
                <form action="/show/reviews" method="get">
                @csrf
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                    <button class="show-reviews__button" type="submit">
                        全ての口コミ情報
                    </button>
                </form>
            </div>
            @foreach($reviews as $review)
            <div class="review__list">
                <div class="edit-delete">
                @if( $review->user_id == $userId )
                    <div class="to-edit__outer">
                        <form action="/edit" method="get">
                        @csrf
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                            <button class="to-edit">
                                投稿した口コミを編集
                            </button>
                        </form>
                    </div>
                    <div class="to-delete__outer">
                        <form action="/delete" method="get">
                        @csrf
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                            <button class="to-delete">
                                投稿した口コミを削除
                            </button>
                        </form>
                    </div>
                @endif
                </div>
                <div class="review-user__outer">
                    <div class="review-user">
                        {{ $review->user->name }}さん
                    </div>
                    <div class="rating__outer">
                        <div class="rating">
                            {{-- レビューが存在し、評価があるか確認 --}}
                            @if($review && $review->rating)
                                {{-- 評価に基づいて星を表示 --}}
                                {{ str_repeat('★ ', $review->rating) }}
                                {{-- 残りの星を空の星で表示 --}}
                                {{ str_repeat('☆ ', 5 - $review->rating) }}
                            @endif
                        </div>
                    </div>
                </div>
                <div class="comment-content__outer">
                    <div class="comment-content">
                        {{ $review->comment ?? 'コメントはありません'}}
                    </div>
                </div>
                <div class="review-img__outer">
                    @if($review->review_img)
                        <img class="review-img" src="{{ asset('storage/' . $review->review_img) }}" alt="review_img">
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        <div class="reservation-box">
        <form action="/done" method="get">
        @csrf
            <h2 class="reservation-title">
                予約
            </h2>
            <input class="date" name="date" type="date" id="date"  min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"><br>
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
                            {{ $shop->shop_name }}
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
                    <input type="hidden" name="shop_name" value="$shop->id">
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
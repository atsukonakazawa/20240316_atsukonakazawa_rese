@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/visited.css') }}">
@endsection

@section('main')
<div class="content-outer">
    <h2 class="visited-list__title">
        来店履歴
    </h2>
    <div class="message__outer">
        <p class="message">
        @if(session('message'))
            {{ session('message')}}
        @endif
        </p>
    </div>
    <div class="content">
        @foreach($visitations as $visitation)
        <div class="detail-box">
            <div class="shop-title__row">
                <a class="back-button" href="/home">
                    <
                </a>
                <h2 class="shop-name">
                    {{ $visitation->shop->shop_name }}
                </h2>
            </div>
            <div class="shop-img">
                <img class="shop-img__img" src="{{ $visitation->shop->shop_img }}" alt="shop_img">
            </div>
            <div class="area-genre__row">
                <div>
                    #{{ $visitation->shop->area->area_name }}
                </div>
                <div>
                    #{{ $visitation->shop->genre->genre_name }}
                </div>
            </div>
            <p class="shop-detail">
                {{ $visitation->shop->shop_detail }}
            </p>
            <div class="show-reviews__outer">
                <form action="/show/reviews" method="get">
                @csrf
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="shop_id" value="{{ $visitation->shop->id }}">
                    <button class="show-reviews__button" type="submit">
                        全ての口コミ情報
                    </button>
                </form>
            </div>
            <div class="links-outer">
                <div class="to-review__outer">
                    <form action="/review" method="get">
                    @csrf
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="shop_name" value="{{ $visitation->shop->shop_name }}">
                        <button class="to-review">
                            新規の口コミを投稿する
                        </button>
                    </form>
                </div>
                <div class="to-edit__outer">
                    <form action="/edit" method="get">
                    @csrf
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="shop_id" value="{{ $visitation->shop->id }}">
                        <button class="to-edit">
                            投稿した口コミを編集
                        </button>
                    </form>
                </div>
                <div class="to-delete__outer">
                    <form action="/delete" method="get">
                    @csrf
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="shop_id" value="{{ $visitation->shop->id }}">
                        <button class="to-delete">
                            投稿した口コミを削除
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<script src="{{ asset('js/detail.js') }}"></script>
@endsection
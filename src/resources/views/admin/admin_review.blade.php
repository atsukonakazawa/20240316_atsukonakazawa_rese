@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/admin_review.css') }}">
@endsection

@section('main')
    <div class="content__outer">
        <div class="title__outer">
            <h2 class="title">
                口コミ管理画面
            </h2>
        </div>
        <div class="message__outer">
            <p class="message">
            @if(session('message'))
                {{ session('message')}}
            @endif
            </p>
        </div>
        <div class="table__outer">
            <table class="table">
                <tr class="title__row">
                    <th class="id">
                        id
                    </th>
                    <th class="user__name">
                        投稿者名
                    </th>
                    <th class="shop__name">
                        店舗名
                    </th>
                    <th class="rating">
                        ５段階評価
                    </th>
                    <th class="comment">
                        口コミ内容
                    </th>
                    <th class="review__img">
                        画像
                    </th>
                </tr>
                @foreach($reviews as $review)
                <form action="/admin/review/delete" method="get">
                @csrf
                    <tr class="each__row">
                        <td class="id">
                            {{ $review->id }}
                            <input type="hidden" name="review_id" value="{{ $review->id }}">
                        </td>
                        <td class="user__name">
                            {{ $review->user->name }}
                        </td>
                        <td class="shop__name">
                            {{ $review->shop->shop_name }}
                        </td>
                        <td class="rating">
                            {{ $review->rating }}
                        </td>
                        <td class="comment">
                            @if($review->comment)
                            {{ $review->comment }}
                            @endif
                        </td>
                        <td class="review__img">
                            @if ($review && $review->review_img)
                            <img class="img" src="{{ asset('storage/' . $review->review_img) }}" >
                            @endif
                        </td>
                        <td class="delete">
                            <button class="delete__button">
                                削除
                            </button>
                        </td>
                    </tr>
                </form>
                @endforeach
            </table>
        </div>
        <div class="to-admin__outer">
            <form action="/admin/menu" method="get">
            @csrf
                <button class="to-admin__menu" type="submit">
                    管理者専用画面に戻る
                </button>
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            </form>
        </div>
    </div>
@endsection
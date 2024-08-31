@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/admin_review_delete_confirm.css') }}">
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
            </form>
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
<div class="content__outer">
    <div class="title__outer">
        <h2 class="title">
            選択したレビューを本当に削除しますか？
        </h2>
        <p class="title__outer-p">
            ※一度削除すると元に戻せません
        </p>
    </div>
    <table class="table">
        <tr class="title__row">
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
        <tr class="each__row">
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
                <img src="{{ asset('storage/' . $review->review_img) }}" style="max-width: 100px; margin-top: 10px;">
                @endif
            </td>
        </tr>
    </table>
    <div class="button__outer">
        <form action="/admin/review/remove" method="get">
        @csrf
            <div class="remove__button-outer">
                <button class="remove__button" type="submit">
                    口コミを削除する
                </button>
                <input type="hidden" name="review_id" value="{{ $review->id }}">
            </div>
        </form>
        <div class="to-review__outer">
            <form action="/admin/review" method="get">
            @csrf
                <button class="to-review" type="submit">
                    口コミ管理画面へ戻る
                </button>
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            </form>
        </div>
    </div>
</div>
@endsection
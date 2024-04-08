@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/manager/newShopCreated.css') }}">
@endsection

@section('main')
<div class="content-outer">
    <div class="content">
        <div class="done-box">
            <h2 class="done-message">
                店舗情報を新規作成しました
            </h2>
            <p class="shop-id__announce">
                新しい店舗の店舗IDは
                <span class="shop-id__span">
                    {{ $newShopId->id }}
                </span>
                です
            </p>
            <p class="shop-id__keep">
                店舗代表者ログインの際に必要なため店舗IDは保管をお願いします
            </p>
            <div class="link-outer">
                <a class="back-link" href="/manager" method="get">
                    戻る
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/manager/updatedShop.css') }}">
@endsection

@section('main')
<div class="content-outer">
    <div class="content">
        <div class="done-box">
            <h2 class="done-message">
                店舗情報を更新しました
            </h2>
            <div class="link-outer">
                <a class="back-link" href="/manager" method="get">
                    戻る
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
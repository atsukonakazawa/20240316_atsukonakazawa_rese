@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/createdManager.css') }}">
@endsection

@section('main')
<div class="content-outer">
    <div class="content">
        <div class="done-box">
            <h2 class="done-message">
                店舗代表者情報を作成しました
            </h2>
            <div class="link-outer">
                <a class="back-link" href="/admin/admin" method="get">
                    戻る
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
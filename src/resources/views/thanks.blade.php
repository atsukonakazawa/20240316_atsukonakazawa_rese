@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('main')
<div class="content-outer">
    <div class="content">
        <div class="thanks-box">
            <h2 class="thanks-message">
                会員登録ありがとうございます
            </h2>
            <div class="button-outer">
                <a href="/login" method="get">
                    ログインする
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/reviewed.css') }}">
@endsection

@section('main')
<div class="content-outer">
    <div class="content">
        <div class="changed-box">
            <h2 class="changed-message">
                レビューを送信しました<br>
                ありがとうございました！
            </h2>
            <div class="visited-box">
                <form action="/visited" method="get">
                @csrf
                    <button class="visited" type="submit" >
                        戻る
                    </button>
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
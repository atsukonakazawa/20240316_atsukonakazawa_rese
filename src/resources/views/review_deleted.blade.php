@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/review_deleted.css') }}">
@endsection

@section('main')
<div class="content-outer">
    <div class="content">
        <div class="deleted-box">
            <h2 class="deleted-message">
                レビューを削除しました
            </h2>
            <div class="visited-box">
                <form action="/visited" method="get">
                @csrf
                    <button class="visited" type="submit" >
                        戻る
                    </button>
                    <input type="hidden" name="user_id" value="{{ $userId }}">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
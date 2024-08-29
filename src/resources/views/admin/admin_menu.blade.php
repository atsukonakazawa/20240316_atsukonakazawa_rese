@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/admin_menu.css') }}">
@endsection

@section('main')
<div class="content-outer">
    <div class="content">
        <div class="title-outer">
            <h2 class="title">
                管理者<br>
                専用画面
            </h2>
        </div>
        <div class="links-outer">
            <div class="to-admin__outer">
                <form action="/admin/admin" method="get">
                @csrf
                    <button class="to-admin" type="submit">
                        店舗代表者<br>
                        新規作成画面
                    </button>
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                </form>
            </div>
            <div class="to-review__outer">
                <form action="/admin/review" method="get">
                @csrf
                    <button class="to-review" type="submit">
                        口コミ管理画面
                    </button>
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                </form>
            </div>
            <div class="to-import__outer">
                <form action="/admin/import" method="get">
                @csrf
                    <button class="to-import" type="submit">
                        新規店舗情報<br>
                        追加画面
                    </button>
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                </form>
            </div>
        </div>
        <div class="logout-outer">
            <form action="/logout" method="post">
            @csrf
                <button class="logout-button">
                    ログアウト
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
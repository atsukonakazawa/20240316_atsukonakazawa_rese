@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/manager/updateShop.css') }}">
@endsection

@section('main')
<div class="content-outer">
    <div class="content">
        <div class="title-outer">
            <h2 class="title">
                店舗代表者　専用画面
            </h2>
        </div>
        <div class="subtitle-outer">
            <h2 class="subtitle">
                店舗情報　更新画面
            </h2>
        </div>
        <div class="message-outer">
            <p class="message">
            @if(session('message'))
                {{ session('message')}}
            @endif
            </p>
        </div>
        <form action="/manager/updated/shop" method="post" enctype="multipart/form-data">
        @csrf
            <div class="required">
                <div class="id-outer">
                    <span class="id-span">
                        ※必須（数字・半角）
                    </span><br>
                    <input class="shop-id" name="shop_id" type="text" placeholder="店舗IDを入力してください">
                    @error('shop_id')
                    <p class="error-p" style="color: red">
                        {{$errors->first('shop_id')}}
                    </p>
                    @enderror
                </div>
                <div class="name-outer">
                    <span class="name-span">
                        ※必須
                    </span><br>
                    <input class="shop-name" name="shop_name" type="text" placeholder="店舗名を入力してください">
                    @error('shop_name')
                    <p class="error-p" style="color: red">
                        {{$errors->first('shop_name')}}
                    </p>
                    @enderror
                </div>
            </div>
            <div class="inputs-group">
                <p class="inputs-group__p">
                    ※以下は、更新したい項目のみ入力し更新ボタンを押してください。
                </p>
                <div class="area-outer">
                    <select name="newArea_id" id="">
                        <option disabled selected value="null">
                            更新後のエリアを選択してください
                        </option>
                        @foreach($areas as $area)
                        <option value="{{ $area->id }}">{{ $area->area_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="genre-outer">
                    <select name="newGenre_id" id="">
                        <option disabled selected value="null">
                            更新後のジャンルを選択してください
                        </option>
                        @foreach($genres as $genre)
                        <option value="{{ $genre->id }}">{{ $genre->genre_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="name-outer">
                    <input type="text" name="newShop_name" placeholder="更新後の店舗名を入力してください">
                </div>
                <div class="detail-outer">
                    <textarea name="newShop_detail" id="" cols="50" rows="5" placeholder="更新後の店舗概要を入力してください"></textarea>
                </div>
                <div class="img-outer">
                    <p class="shop-img__title">店舗画像を選択してください</p>
                    <p class="shop-img__size">※容量の単位はKBまで使用可能（MBは使用不可）</p>
                    <input class="img-select" type="file" name="newShop_img">
                </div>
            </div>
            <div class="button-outer">
                <button class="button" type="submit">
                    更新
                </button>
                <a class="back-link" href="/manager">
                    戻る
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
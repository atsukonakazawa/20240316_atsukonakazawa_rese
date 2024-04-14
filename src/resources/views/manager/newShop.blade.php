@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/manager/newShop.css') }}">
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
                店舗情報　新規作成画面
            </h2>
        </div>
        <form action="/manager/new/shop/created" method="post" enctype="multipart/form-data">
        @csrf
            <div class="inputs-group">
                <div class="area-outer">
                    <select name="area_id" id="" >
                        <option disabled selected value="">
                            エリアを選択してください
                        </option>
                        @foreach($areas as $area)
                        <option value="{{ $area->id }}">{{ $area->area_name }}</option>
                        @endforeach
                    </select>
                    <div class="error-outer">
                        @error('area_id')
                        <p class="error-p" style="color: red">
                            {{$errors->first('area_id')}}
                        </p>
                        @enderror
                    </div>
                </div>
                <div class="genre-outer">
                    <select name="genre_id" id="">
                        <option disabled selected value="">
                            ジャンルを選択してください
                        </option>
                        @foreach($genres as $genre)
                        <option value="{{ $genre->id }}">{{ $genre->genre_name }}</option>
                        @endforeach
                    </select>
                    <div class="error-outer">
                        @error('genre_id')
                        <p class="error-p" style="color: red">
                            {{$errors->first('genre_id')}}
                        </p>
                        @enderror
                    </div>
                </div>
                <div class="name-outer">
                    <input type="text" name="shop_name" placeholder="店舗名を入力してください" value="{{ old('shop_name') }}">
                    <div class="error-outer">
                        @error('shop_name')
                        <p class="error-p" style="color: red">
                            {{$errors->first('shop_name')}}
                        </p>
                        @enderror
                    </div>
                </div>
                <div class="detail-outer">
                    <textarea name="shop_detail" id="" cols="50" rows="5" placeholder="店舗概要を入力してください" value="{{ old('shop_detail') }}"></textarea>
                    <div class="error-outer">
                        @error('shop_detail')
                        <p class="error-p" style="color: red">
                            {{$errors->first('shop_detail')}}
                        </p>
                        @enderror
                    </div>
                </div>
                <div class="img-outer">
                    <p class="shop-img__title">店舗画像を選択してください</p>
                    <input class="img-select" type="file" name="shop_img" accept="image/png, image/jpeg">
                    {{session('img_path')}}
                    <div class="error-outer">
                        @error('shop_img')
                        <p class="error-p" style="color: red">
                            {{$errors->first('shop_img')}}
                        </p>
                        @enderror
                    </div>
                </div>
                <div class="button-outer">
                    <button class="button" type="submit">
                        新規作成する
                    </button>
                    <a class="back-link" href="/manager">
                        戻る
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
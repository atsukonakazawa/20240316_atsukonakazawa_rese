@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/import.css') }}">
@endsection

@section('main')
<div class="content-outer">
    <div class="content">
        <div class="title-outer">
            <h2 class="title">
                新規店舗情報　追加画面
            </h2>
        </div>
        <div class="import-box">
            <form action="/import" method="post" enctype="multipart/form-data">
            @csrf
                <p class="csv-p">
                    CSVファイルを選択してください
                </p>
                <input class="input" type="file" name="csv_file" accept=".csv">
                <button class="button" type="submit">インポート</button>
            </form>
            <div class="message-outer">
            @if ($errors->any())
                <div class="alert-danger">
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif
            @if(session('success'))
                <div class="alert-success">
                    {{ session('success') }}
                </div>
            @endif
            </div>
        </div>
    </div>
</div>
@endsection

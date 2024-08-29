@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/review.css') }}">
@endsection

@section('main')
<div class="content-outer">
    <div class="content">
        <div class="left-box">
            <h2 class="review-title">
                今回のご利用はいかがでしたか？
            </h2>
            <div class="shop-box">
                <div class="shop-img">
                    <img src="{{ $shop->shop_img }}" alt="shop_img">
                </div>
                <div class="shop-content">
                    <h2 class="shop-name">
                        {{ $shop->shop_name }}
                    </h2>
                    <div class="area-genre__row">
                        <div class="shop-area">
                            #{{ $shop->area->area_name }}
                        </div>
                        <div class="shop-genre">
                            #{{ $shop->genre->genre_name }}
                        </div>
                    </div>
                    <div class="button-outer">
                        <form action="/detail" method="get">
                        @csrf
                            <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                            <button type="submit" class="detail-button">
                                詳しく見る
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="right-box">
        <form action="/reviewed" method="post" enctype="multipart/form-data">
        @csrf
            <div class="rating-outer">
                <p class="rating-p">
                    体験を評価してください
                </p>
                <select class="stars" name="rating" value="{{ old('rating') }}">
                    <option selected disabled>選択してください</option>
                    <option value="1">⭐️</option>
                    <option value="2">⭐️⭐️</option>
                    <option value="3">⭐️⭐️⭐️</option>
                    <option value="4">⭐️⭐️⭐️⭐️</option>
                    <option value="5">⭐️⭐️⭐️⭐️⭐️</option>
                </select>
                <div class="form__error">
                @error('rating')
                    {{ $message }}
                @enderror
                </div>
            </div>

            <div class="comment-outer">
                <p class="comment-p">
                    口コミを投稿
                </p>
                <textarea class="comment" name="comment" id="review" cols="30" rows="5" value="{{ old('comment') }}" placeholder="カジュアルな夜のお出かけにおすすめのスポット"></textarea>
                <p class="count">
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <span id="charCount">0</span>/400(最高文字数)
                </p>
                <script>
                    $(document).ready(function() {
                        $('#review').on('input', function() {
                            var charCount = $(this).val().length;
                            $('#charCount').text(charCount);
                        });
                    });
                </script>
                <div class="form__error">
                @error('comment')
                    {{ $message }}
                @enderror
                </div>
            </div>

            <div class="review-img__outer">
                <p class="review-img__p">
                    画像の追加
                </p>
                <div class="review-img">
                    <div class="upload-area" id="uploadArea">
                        クリックして写真を追加<br>
                        <span class="or">またはドラッグ&ドロップ</span>
                        <input class="input__img" type="file" id="review_img" name="review_img"  style="display: none;">
                    </div>
                    <!-- プレビュー表示エリア -->
                    <div id="preview"></div>
                </div>

                <script>
                    const uploadArea = document.getElementById('uploadArea');
                    const fileInput = document.getElementById('review_img');
                    const preview = document.getElementById('preview');

                    // ドラッグオーバー時のスタイル変更
                    uploadArea.addEventListener('dragover', (e) => {
                        e.preventDefault();
                        e.stopPropagation();
                        uploadArea.style.border = "2px dashed #000";
                    });

                    // ドラッグアウト時のスタイルリセット
                    uploadArea.addEventListener('dragleave', (e) => {
                        e.preventDefault();
                        e.stopPropagation();
                        uploadArea.style.border = "2px dashed #ccc";
                    });

                    // ドロップ時のファイル処理
                    uploadArea.addEventListener('drop', (e) => {
                        e.preventDefault();
                        e.stopPropagation();
                        uploadArea.style.border = "2px dashed #ccc";
                        const files = e.dataTransfer.files;
                        if (files.length > 0) {
                            fileInput.files = files;
                            displayPreview(files);
                        }
                    });

                    // クリックしてファイルを選択
                    uploadArea.addEventListener('click', () => {
                        fileInput.click();
                    });

                    // ファイル選択後のプレビュー表示
                    fileInput.addEventListener('change', () => {
                        const files = fileInput.files;
                        displayPreview(files);
                    });

                    // プレビュー表示機能
                    function displayPreview(files) {
                        preview.innerHTML = ""; // 既存のプレビューをクリア

                        Array.from(files).forEach(file => {
                            const reader = new FileReader();
                            reader.onload = (e) => {
                                const img = document.createElement('img');
                                img.src = e.target.result;
                                img.style.maxWidth = '200px';
                                img.style.marginTop = '10px';
                                preview.appendChild(img);
                            };
                            reader.readAsDataURL(file);
                        });
                    }
                </script>
                <div class="form__error">
                @error('review_img')
                    {{ $message }}
                @enderror
                </div>
            </div>
        </div>
    </div>

    <div class="review-button__outer">
        <button class="review-button" type="submit">
            口コミを投稿
        </button>
        <input type="hidden" name="shopId" value="{{ $shop->id }}">
        @if (Auth::check())
        <input type="hidden" name="userId" value="{{ Auth::user()->id }}">
        @endif
    </div>
        </form>
</div>
@endsection

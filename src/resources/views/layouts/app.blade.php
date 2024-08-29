<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&family=Zen+Old+Mincho&display=swap" rel="stylesheet">
    @yield('css')
</head>
<body>
    <header class="header">
        <div class="header-logo__outer open-modal" >
            <a class="header-logo" href="/">
                <img class="logo-icon" src="{{ asset('icon/Rese icon.png') }}" alt="Rese" >
                Rese
            </a>
        </div>

        <!--ここからモーダルウィンドウ-->
        <div id="modal" class="modal">
            <!-- ここからモーダルコンテンツ -->
            <div class="modal-content">
                <div class="close-button__outer">
                    <button class="close">
                        &times;
                    </button>
                </div>
                <div class="choices">
                    <p>
                        お気に入り機能・ご予約はログイン後にご利用いただけます
                    </p>
                    <a href="/">
                        Home
                    </a><br>
                    <a href="/register">
                        Registration
                    </a><br>
                    <a href="/login">
                        Login
                    </a>
                </div>
            </div>
        </div>
        <!--ここまでモーダルウィンドウ-->
        <script src="{{ asset('js/index.js') }}"></script>
        @yield('search')
    </header>
    <main>
        @yield('main')
    </main>
</body>
</html>
<!DOCTYPE html>
<html lang="ja">
    <style>
    .h1 {
        font-size: 16px;
        color: #ff6666;
    }
    .button {
        width: 200px;
        text-align: center;
    }
    .button a {
        padding: 10px 20px;
        display: block;
        border: 1px solid #2a88bd;
        background-color: #ffffff;
        color: #2a88bd;
        text-decoration: none;
        box-shadow: 2px 2px 3px #f5deb3;
    }
    .button a:hover {
        background-color: #2a88bd;
        color: #ffffff;
    }
    </style>

    <body>
        <h1 class="h1" >ご本人さま確認</h1>
        <p>以下のボタンを押して認証をお願いいたします。</p>
        <div class="button" id="button">
            <a href="{{ url('/thanks') }}" method="get">認証</a>
        </div>
    </body>
</html>
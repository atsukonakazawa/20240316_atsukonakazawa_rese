// ページが読み込まれた時の処理
window.onload = function() {
    // モーダル要素を取得
    var modal = document.getElementById('modal');
    
    // モーダルを非表示にする
    modal.style.display = 'none';

    // 「戻る」ボタンを取得
    var backButton = document.querySelector('.back-button');

    // 「戻る」ボタンがクリックされた時の処理
    backButton.onclick = function() {
        // モーダルを表示
        modal.style.display = 'block';
    }

    // 閉じるボタンを取得
    var closeBtn = document.querySelector('.close');

    // 閉じるボタンがクリックされた時の処理
    closeBtn.onclick = function() {
        // モーダルを非表示
        modal.style.display = 'none';
    }

    // モーダルの外側（背景）がクリックされた時の処理
    window.onclick = function(event) {
        if (event.target == modal) {
            // モーダルを非表示
            modal.style.display = 'none';
        }
    }
};

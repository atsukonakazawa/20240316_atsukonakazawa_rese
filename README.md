#アプリケーション名’Rese’  
概要：ある企業のグループ会社の飲食店予約サービス  
 <img width="1680" alt="Rese　トップ画面" src="https://github.com/atsukonakazawa/20240316_atsukonakazawa_rese/assets/140526473/993f4f90-3b66-4414-89bd-b570496c3021">　　 
 
##作成した目的  
概要説明：外部の飲食店予約サービスでは手数料がかかるため自社の予約サービスを持ちたい。  
 
##アプリケーションURL  
(まだデプロイしていないので無し）  

 ##他のリポジトリ  
 特になし  

  ##機能一覧  
  会員登録  
  ログイン  
  ログアウト  
  ユーザー情報取得  
  ユーザーの飲食店お気に入り一覧取得  
  ユーザーの飲食店予約情報取得  
  飲食店一覧取得  
  飲食店の詳細取得  
  飲食店のお気に入り追加  
  飲食店のお気に入り削除  
  飲食店予約の追加  
  飲食店予約のキャンセル  
  エリアで検索する  
  ジャンルで検索する  
  店名で検索する  
  飲食店予約の変更機能  
  飲食店の評価機能  
  レスポンシブデザイン（ブレイクポイント７６８px）  
  バリデーション（認証時、予約時、店舗代表者と管理者の権限全般）  
  店舗代表者の管理画面（新規店舗情報の作成、既存店舗情報の更新、予約の確認）  
  管理者の管理画面（店舗代表者の作成）  
  お店の画像をストレージに保存（新規店舗情報の作成時）  
 
  ##使用技術  
  Laravel Framework 8.83.27  
  PHP PHP 8.2.11 (cli)  
  MySQL Community Server - GPL 8.0.26  

   ##テーブル設計  
   <img width="1368" alt="Rese　テーブル設計" src="https://github.com/atsukonakazawa/20240316_atsukonakazawa_rese/assets/140526473/0448b0a9-7938-459a-b8fb-b43dfa34f29a">  
    
    ##ER図  
      <img width="1710" alt="Rese ER図" src="https://github.com/atsukonakazawa/20240316_atsukonakazawa_rese/assets/140526473/a79d3bdb-c1d0-4dec-97e2-56c5b40d9120">　　　
      　
    ##ローカル環境構築
Dockerビルド
1.git clone git@github.com:coachtech-material/laravel-docker-template.git
2.docker compose up -d --build
※MySQLは、OSによっては起動しない場合があるのでそれぞれのPCに合わせてdocker-compose.ymlファイルを編集してください。
Laravel環境構築
1.docker compose exec php bash
2.composer install
3..env.exampleファイルから.envを作成し、環境変数を変更
4.php artisan key:generate
5.php artisan migrate  

 ##その他  
 ⚫︎利用者アカウント  
 名前:a  
 メールアドレス:a@docomo.com  
 パスワード:aaaaaaaa(aが８個)  
 ⚫︎店舗管理者アカウント  
 名前:b-manager  
 メールアドレス:b@docomo.com  
 パスワード:bbbbbbbb(bが8個)  
 ⚫︎管理者アカウント  
 名前：c-admin  
 メールアドレス:c@docomo.com  
 パスワード:cccccccc(cが8個)  
 
 
    
    

  
  
  
  
  
  
  

#アプリケーション名’Rese’  
概要：ある企業のグループ会社の飲食店予約サービス  
<img width="1374" alt="Rese-Protest-top" src="https://github.com/user-attachments/assets/413a4992-4140-430f-bb82-fa4287691e66">  



　【Pro入会テストについてお伝えすること】  
   ・口コミ機能について  
    　レビューのダミーデータはご用意がないためご自身でいずれかのユーザーにログイン後に投稿をお願いいたします。  
    　管理者は管理者専用のメニュー画面より全ユーザーの口コミを閲覧・削除できます。  
   ・CSVインポートについて  
   　管理者専用のメニュー画面よりCSVファイルのインポートが可能となっております。  
   　ただし、下記に記載の通り数ヶ月前にAWSのS3をすでに削除済みのため、  
   　coachtechからあらかじめ提供された他の店舗の画像はcoachtechのS3のURLに保存されていて、  
   　CSVインポートで新規に追加した店舗の画像はStorageに保存される形となっております。  
   　viewに画像を表示する際には、coachtechからあらかじめ提供された他の店舗の画像の表示に合わせているため、  
   　新規に追加した店舗に関しては画像がうまく表示されない状態となっております。  

   　扱いにくい部分があり申し訳ございませんが、採点をよろしくお願いいたします。



   


 
##作成した目的  
概要説明：外部の飲食店予約サービスでは手数料がかかるため自社の予約サービスを持ちたい。  



 
##アプリケーションURL  
※数ヶ月前にReseのAWS　EC2インスタンス、RDS、S3を作成し画像もそこに保存していたのですが、RDSに料金が発生してしまったため、高額請求を避けるために評価シートを受け取った後にReseのAWSの関係のものを全て削除してしまいました。そのためデプロイのURLはなく、この１週間はローカルのみで指定の３機能を追加させていただきました。  



 
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
  レスポンシブデザイン  
  バリデーション  
  店舗代表者の管理内容（新規店舗情報の作成、既存店舗情報の更新、予約の確認）  
  管理者の管理内容（店舗代表者の作成、口コミ管理、CSVインポートによる新規店舗情報追加）  
  お店の画像をストレージに保存  
  ※数ヶ月前にReseに取り組んだ際にはお店の画像をAWSのS３に保存していたが、上記に記載の通りS3は削除してしまったため、現在は提供されたURLをそのままshopsテーブルのカラムに保存し使用させていただいております。  
  メールによって本人確認を行うことができる  
  店舗代表者の管理画面から利用者にお知らせメールを送信することができる  
  タスクスケジューラを利用して、予約当日の朝に予約情報のリマインダーを送る  
  ※数ヶ月前にReseに取り組んだ際にはメールを使用できていましたが、その後フリマアプリに取り組む際にエラー対処のためReseのコンテナからmailhogを削除してしまい、現在Reseにおいてはメール機能は一時的に使えなくなっております。  
  利用者が来店した際に店舗側に見せるQRコードを発行し、お店側は照合することができる  
  Stripeを利用して決済をすることができる　　　
  ※数ヶ月前にStripeの実装は完了したのですが、Reseの後フリマアプリ作成の際にStripeのkeyを変更してしまったため、現在ReseにおいてはStripeは一時的に使えなくなっております。  
  【Pro入会テスト】口コミ機能  
  【Pro入会テスト】店舗一覧ソート機能  
  【Pro入会テスト】CSVインポート機能  
  ※CSVファイルの記述方法は以下の画像の通りにお願いいたします  
  <img width="811" alt="Rese-Protest-CSV入力例" src="https://github.com/user-attachments/assets/26fad481-4651-4cf0-87e2-8f3f8b161491">  
  Excelをお使いの方は画像を参考に１行目に項目名（１つのセルに１つの項目）、２行目に店舗の情報を入力後、csvファイルとして保存してください。  
  スプレッドシートをお使いの方はExcelと同様に入力後、csvを選択してダウンロードしてください。  



   
##使用技術  
  Laravel Framework 8.83.27  
  PHP 8.2.11 (cli)  
  MySQL Community Server - GPL 8.0.26  



   
##テーブル設計  
   <img width="1266" alt="Rese-Protest-tables設計" src="https://github.com/user-attachments/assets/631c43c8-38d4-4b71-970a-456f31bdf7a2">  



   
##ER図  
  <img width="615" alt="Rese-protest-ER図" src="https://github.com/user-attachments/assets/9bbf7923-e5a4-4a9d-896a-9aa81bebedcb">  



   
##ローカル環境構築  
     Dockerビルド  
     1.git clone git@github.com:coachtech-material/laravel-docker-template.git  
     2.docker compose up -d --build  
     ※MySQLは、OSによっては起動しない場合があるのでそれぞれのPCに合わせてdocker-compose.ymlファイルを編集してください。  
     3.メールサーバー(mailhog)立ち上げのため.envとdocker-compose.ymlを編集  
     4.再度docker compose up -d --build  



      
##Laravel環境構築  
     1.docker compose exec php bash  
     2.composer install  
     3.env.exampleファイルから.envを作成し、以下の通り環境変数を変更  
     APP_NAME=Rese
APP_ENV=local
APP_KEY=base64:/ykQEVlUY87mff/hU17paPtEl3Aud1YrGHyAbhzwE8I=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DRIVER=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=mail
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=info@rese.com
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"

STRIPE_KEY=pk_test_51PBdN3IzbSIU1MHKVrPia3U5vPPiCmZsXye7h4EBpq1lwvdm3QEMWaeagHaPEvDagt5EZSETtzIqJMEuWKjnXTn90024rKvEpx
STRIPE_SECRET=sk_test_51PBdN3IzbSIU1MHK4NpwExQfpOQBtRpoPilzRXD0IWXMy9ejcY89jGzVl16pUOcF85lkkZXFRROtFJDoYERI3AjK00jSboz6Vn
CASHIER_CURRENCY=jpy

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=ap-northeast-1
AWS_BUCKET=rese

     4.php artisan key:generate  
     5.php artisan migrate  
     6.php artisan db:seed（DatabaseSeeder.phpの内容に沿って３回に分けてシード）  
     7.composer require laravel/fortify  
     8.(resources/lang/en/validation.phpがない場合）php artisan lang:publish  
        およびresources/lang/en/validation.phpファイルをjaディレクトリに複製後、該当箇所を日本語に変更  
     9.メールサーバー(mailhog)使用のため.envを修正かつ別ターミナルでmailhogコマンドを実行し起動  
     10.php artisan make:command SendReminders  
     11.composer require simplesoftwareio/simple-qrcode  
     12.(git was not found in your pathエラーが出たら)  
        phpコンテナ内でapt-get update  
        phpコンテナ内でapt-get install git  
     13.(Failed to download caouecs/laravel-lang from distエラーが出たら)  
        composer remove caouecs/lang  
        composer require arcanedev/laravel-lang  
        composer clearcache  
        composer.jsonからcaouecs/langを削除  
        composer update  
     14.composer require laravel/cashier  
     15.再度php artisan migrate:refresh
     16.Stripe使用のため、.env編集  
     17.composer require aws/aws-sdk-php  
     18..envのAWS部分を編集  
     19.php artisan make:command MigrateShopImagesToS3  
     20.php artisan migrate:shops-images-s3  
     21.php artisan storage:link　　
　
##Reseテストユーザー  
  ⚫︎管理者 
  名前:a-admin  
  メールアドレス:a@docomo.com  
  パスワード:aaaaaaaa(aが８個)  
  ⚫︎店舗管理者  
  名前:b-manager  
  メールアドレス:b@docomo.com  
  パスワード:bbbbbbbb(bが8個)  
  ⚫︎一般ユーザー 
  名前：c  
  メールアドレス:c@docomo.com  
  パスワード:cccccccc(cが8個)  
  　


 
  
 
    
    

  
  
  
  
  
  
  

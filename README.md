#アプリケーション名’Rese’  
概要：ある企業のグループ会社の飲食店予約サービス  
 <img width="1680" alt="Rese　トップ画面" src="https://github.com/atsukonakazawa/20240316_atsukonakazawa_rese/assets/140526473/993f4f90-3b66-4414-89bd-b570496c3021">　　 
 
##作成した目的  
概要説明：外部の飲食店予約サービスでは手数料がかかるため自社の予約サービスを持ちたい。  
 
##アプリケーションURL  
http://35.76.162.242  

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
  店舗代表者の管理内容（新規店舗情報の作成、既存店舗情報の更新、予約の確認）  
  管理者の管理内容（店舗代表者の作成）  
  お店の画像をストレージに保存（AWSのS3に保存）  
  ※当初はsrc/public/storageに画像を保存する形をとっていたが、  
  AWS　VPCの容量および使用時間が無料利用枠を超過しそうなため、  
  アプリケーション内に画像を増やさない方が良いと考え、  
  画像はAWS S3に保存する形に切り替えた。  
  メールによって本人確認を行うことができる  
  店舗代表者の管理画面から利用者にお知らせメールを送信することができる  
  タスクスケジューラを利用して、予約当日の朝に予約情報のリマインダーを送る  
  利用者が来店した際に店舗側に見せるQRコードを発行し、お店側は照合することができる  
  Stripeを利用して決済をすることができる  
  AWSのストレージをS3、バックエンドをEC２、データベースをRDSとして環境を構築  
  開発環境と本番環境の切り分け  
 
 ##使用技術  
  Laravel Framework 8.83.27  
  PHP 8.2.11 (cli)  
  MySQL Community Server - GPL 8.0.26  

  ##テーブル設計  
   <img width="1386" alt="スクリーンショット 2024-05-22 12 51 02" src="https://github.com/atsukonakazawa/20240316_atsukonakazawa_rese/assets/140526473/55453ed9-ab08-4661-9321-ed1fa9dcc1e2">  

   　


  ##ER図  
    <img width="703" alt="Rese drawio" src="https://github.com/atsukonakazawa/20240316_atsukonakazawa_rese/assets/140526473/3c0f4f19-f613-482a-b534-2d37e04fde6a">


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
     3.env.exampleファイルから.envを作成し、環境変数を変更  
     4.php artisan key:generate  
     5.php artisan migrate  
     6.php artisan db:seed  
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


   ##デプロイ環境
    デプロイ先: AWS EC2  
    DB: RDS  
    ストレージ:S3  
    サーバー: nginx  
     
   ##AWSへのデプロイ  
   1.sudo yum -y install nginx  
   2.sudo systemctl enable nginx  
   3.sudo yum update -y  
   4.sudo yum -y install mysql git httpd curl  
   5.git config --global user.name　"atsukonakazawa"  
   6.git config --global user.email tsqe8qm1bmqztbxbjre9@docomo.ne.jp  
   7.sudo amazon-linux-extras install -y php8.2  
   8.curl -sS https://getcomposer.org/installer | php  
   9.sudo mv composer.phar /usr/local/bin/composer  
   10.sudo chown ec2-user:ec2-user /var/www  
   11.git clone https://github.com/atsukonakazawa/20240316_atsukonakazawa_rese.git  
   12.sudo yum install -y php-xml  
   13.composer update  
   14.composer install  
   15.sudo systemctl start php-fpm.service  
   16.sudo systemctl enable php-fpm.service  
   17.sudo yum install -y php-fpm  
   18.sudo yum install -y php-opcache
   19.php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === 'dac665fdc30fdd8ec78b38b9800061b4150413ff2e3b6f88543c636f7cd84f6db9189d43a81e5503cda447da73c7e5b6') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"  
   20.sudo mv composer.phar /usr/local/bin/composer  
   21.composer  
   22.sudo su -
   23.cd /etc/php-fpm.d/  
   24.sudo cp www.conf www.conf_bk_yyyyMMdd  
   25.sudo vim www.conf(listen owner、listen group、listen modeを変更）  
   26.vim /etc/nginx/nginx.conf(serverのrootを変更)  
   27.sudo systemctl start nginx.service  
   28.cp .env.example .env
   29.php artisan key:generate  
   30..envのDB部分をRDSの内容に合わせて変更  
   31.php artisan migrate:fresh　  
   32.php artisan db:seed  
   33.wget https://github.com/mailhog/MailHog/releases/download/v1.0.0/MailHog_linux_amd64  
   34.chmod +x MailHog_linux_amd64  
   35.sudo mv MailHog_linux_amd64 /usr/local/bin/mailhog  
   36.mailhog(mailhogを使用する際には別ターミナルで起動しておく)  
   37.composer require stripe/stripe-php  
   38.sudo yum install php-mbstring  
   39.sudo yum install php-gd  
   40.sudo yum install php-xml  
   41.sudo systemctl restart php-fpm  
   42.sudo systemctl restart httpd  
   43.composer install  
   44.composer update  
   45..envファイルのmail部分、STRIPE部分を変更  
   46.sudo systemctl nginx restart  

      
  ##AWS アカウント　サインイン情報  
  ルートユーザーメールアドレス：tsqe8qm1bmqztbxbjre9@docomo.ne.jp  
  パスワード：Stillababy1  

  ##Reseテストユーザー  
  ⚫︎利用者（ブラウザにて会員登録済み）  
  名前:a  
  メールアドレス:a@docomo.com  
  パスワード:aaaaaaaa(aが８個)  
  ⚫︎店舗管理者（ブラウザにて管理者専用の管理画面より作成済み）  
  名前:b-manager  
  メールアドレス:b@docomo.com  
  パスワード:bbbbbbbb(bが8個)  
  ⚫︎管理者（ブラウザにて会員登録後、EC2インスタンスのコマンドラインからMySQLでroleのadminを追加）  
  名前：c-admin  
  メールアドレス:c@docomo.com  
  パスワード:cccccccc(cが8個)  

  
 
    
    

  
  
  
  
  
  
  

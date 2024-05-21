<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Aws\S3\S3Client;

class MigrateShopImagesToS3 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:shops-images-s3';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate shop images to S3';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // S3クライアントの設定
        $s3 = new S3Client([
            'region'  => env('AWS_DEFAULT_REGION'),
            'version' => 'latest',
            'credentials' => [
                'key'    => env('AWS_ACCESS_KEY_ID'),
                'secret' => env('AWS_SECRET_ACCESS_KEY'),
            ],
        ]);

        // 既存のshopsテーブルから画像URLを取得
        $shops = DB::table('shops')->get();

        foreach ($shops as $shop) {
            $imagePath = $shop->shop_img; // ローカルパスまたはURL

            // 画像を取得
            $imageContent = file_get_contents($imagePath);

            // 画像をS3にアップロード
            $result = $s3->putObject([
                'Bucket' => env('AWS_BUCKET'),
                'Key'    => 'shop_images/' . basename($imagePath),
                'Body'   => $imageContent,
            ]);

            // 新しいS3のURLを取得
            $s3Url = $result['ObjectURL'];

            // データベースのURLを更新
            DB::table('shops')->where('id', $shop->id)->update(['shop_img' => $s3Url]);
        }

        $this->info('Shop images migrated to S3 successfully.');
    }
}

<?php
require 'vendor/autoload.php'; // AWS SDKのオートローダーを読み込み

use Aws\S3\S3Client;
use Aws\Exception\AwsException;

// 環境変数からAWSキーを取得
$bucketName = getenv('AWS_BUCKET');
$region = getenv('AWS_DEFAULT_REGION');
$key = getenv('AWS_ACCESS_KEY_ID');
$secret = getenv('AWS_SECRET_ACCESS_KEY');

// アップロードされたファイルを取得
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
    $file = $_FILES['image'];

    // 拡張子チェック
    $allowedTypes = ['image/jpeg', 'image/png'];
    if (!in_array($file['type'], $allowedTypes)) {
        die('JPEGまたはPNG形式の画像のみアップロード可能です。');
    }

    // 一時ファイルとS3保存先を設定
    $tempFile = $file['tmp_name'];
    $fileName = 'uploads/' . uniqid() . '_' . basename($file['name']);

    try {
        // S3クライアントを作成
        $s3 = new S3Client([
            'version' => 'latest',
            'region' => $region,
            'credentials' => [
                'key' => $key,
                'secret' => $secret,
            ],
        ]);

        // S3にアップロード
        $result = $s3->putObject([
            'Bucket' => $bucketName,
            'Key' => $fileName,
            'SourceFile' => $tempFile,
        ]);

        echo 'アップロード成功！<br>';
        echo '画像URL: <a href="' . $result['ObjectURL'] . '">' . $result['ObjectURL'] . '</a>';

    } catch (AwsException $e) {
        echo 'アップロードに失敗しました: ' . $e->getMessage();
    }
} else {
    echo 'ファイルがアップロードされていません。';
}

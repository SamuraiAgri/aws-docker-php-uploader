<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>画像アップローダー</title>
</head>
<body>
    <h1>画像アップローダー</h1>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="image" accept="image/*" required>
        <button type="submit">アップロード</button>
    </form>
</body>
</html>

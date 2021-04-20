<?php

// 初期パラメータセット
$maxArticlesPerPage = 5;
$offset = 0;

// データベーへの接続
try {
    $dbh = new PDO('mysql:host=localhost;dbname=sample;charset=utf8', 'root','', array(PDO::ATTR_EMULATE_PREPARES => false));
} catch (PDOException $e) {
    var_dump($e->getMessage());
    exit;
}
    // 記事データ取得
    $sql = "select id, article from articles limit ? offset ?";
    $stmt = ($dbh->prepare($sql));
    $stmt->execute(array($maxArticlesPerPage, $offset));
    $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>ページング機能の実装</title>
</head>
<body>
    <h1>記事一覧</h1>
    <ul>
    <?php foreach ($articles as $article) : ?>
        <li><?php echo htmlspecialchars($article['article'], ENT_QUOTES, 'UTF-8') ?></li>
    <?php endforeach ?>
    </ul>
</body>
</html>

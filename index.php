<?php
// 特殊文字をHTMLエンティティに変換
function h($str){
    return htmlspecialchars($str,ENT_QUOTES, "UTF-8");
}

// 接続に必要な情報を定義
define('DSN', 'mysql:host=db;dbname=pet_shop;charset=utf8;');
define('USER', 'staff');
define('PASSWORD', '9999');

// DBに接続
try {
    $dbh = new PDO(DSN, USER, PASSWORD);
} catch (PDOException $e) {
    echo $e->getMessage();
    exit;
}

// 曖昧検索とSQL文の組み立て
$keyword = $_GET["keyword"];
if (empty($keyword)) {
    $sql = 'SELECT id, description, type, classifcation, birthplace, birthday ' . 
        'FROM animals ORDER BY id ASC';
} else {
    $keyword = '%' . $keyword . '%';
    $sql = 'SELECT id, description, type, classifcation, birthplace, birthday ' .
        'FROM animals WHERE description LIKE :keyword ORDER BY id ASC';
}

// プリペアドステートメントの準備
$stmt = $dbh->prepare($sql);

// パラメータのバインド(プレースホルダへの代入)
$stmt->bindParam(':keyword', $keyword, PDO::PARAM_STR);

// プリペアドステートメントの実行
$stmt->execute();

// 結果の受け取り
$animals = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ペットショップ</title>
</head>

<body>
    <h1>本日のご紹介ペット</h1>
    <form method="get">
        <label>キーワード：</label>
        <input name="keyword" placeholder="キーワードを入力して下さい" size="26" type="text">
        <input type="submit" value="検索">
        <?= '「' . h($_GET["keyword"]) . '」で、曖昧検索しました'; ?>
    </form>

    <p><?php // レコードの表示
    foreach ($animals as $animal) {
        echo $animal['type'] . 'の' .
            $animal['classifcation'] . 'ちゃん' . '<br>' .
            $animal['description'] . '<br>' .
            $animal['birthday'] . '生まれ' . '<br>' .
            '出身地' . $animal['birthplace'] . '<hr>';
    }
    ?></p>
</body>
</html>

<!-- http://localhost/php_exercise/pet_shop/index.php -->
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
        <input name="<?= h("keyword") ?>" placeholder="キーワードを入力下さい" size="24" type="text">
        <input type="submit" value="検索">
        <?php echo '「' . h($_GET["keyword"]) . '」で、曖昧検索しました'; ?>
    </form>
</body>
</html>

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

$keyword = h($_GET["keyword"]);
if (empty($keyword)) {
    $sql = 'SELECT id, description, type, classifcation, birthplace, birthday ' . 
        'FROM animals ORDER BY id ASC';
} else {
    // SQL文の組み立て
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

foreach ($animals as $animal) {
    echo '<br>' . $animal['type'] . 'の' .
        $animal['classifcation'] . 'ちゃん' . '<br>' .
        $animal['description'] . '<br>' .
        $animal['birthday'] . '生まれ' . '<br>' .
        '出身地' . $animal['birthplace'] . '<hr>';
}

/*
<script>alert('警告！！！！');</script>

【XSS対策補足】
htmlspecialchars関数 を利用したことで、<script>alert('警告！！！');</script> は
コードとして認識されず、文字列として吐き出されたということになります。
セキュリティはとても重要なことなので必ず理解出来るようにしておきましょう。

*/
// http://localhost/php_exercise/pet_shop/index.php
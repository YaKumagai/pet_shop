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

$keyword = '%大%';
$sql = 'SELECT * FROM animals WHERE description LIKE :keyword';
echo $keyword;
// プリペアドステートメントの準備
$stmt = $dbh->prepare($sql);

// プリペアドステートメントの実行
$stmt->execute();

// 結果の受け取り
$animals = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($animals as $animal) {
    echo $animal['type'] . 'の' .
        $animal['classifcation'] . 'ちゃん' . '<br>' .
        $animal['description'] . '<br>' .
        $animal['birthday'] . '生まれ' . '<br>' .
        '出身地' . $animal['birthplace'] . '<hr>';
}

// http://localhost/php_exercise/pet_shop/index1.php
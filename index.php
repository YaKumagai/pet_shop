<?php
// 接続に必要な情報を定義
define('DSN', 'mysql:host=db;dbname=pet_shop;charset=utf8;');
define('USER', 'staff');
define('PASSWORD', '9999');

// DBに接続
$dbh = new PDO(DSN, USER, PASSWORD);

// SQL文の組み立て
$sql = 'SELECT id, description, type, classifcation, birthplace, birthday FROM animals ORDER BY id ASC';

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

// http://localhost/php_exercise/pet_shop/index.php
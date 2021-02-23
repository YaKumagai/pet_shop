
-- データベースの作成
CREATE DATABASE pet_shop;

-- 作業ユーザーの作成とパスワードの設定
-- 今回はホストを指定しない
CREATE USER staff IDENTIFIED BY '9999';

-- 「pet_shop」というデータベースの全てのテーブルの操作権限を「staff」に付与。
GRANT ALL ON pet_shop.* TO staff;


-- テーブルの作成
CREATE TABLE animals (
    id INT PRIMARY KEY AUTO_INCREMENT,
    description VARCHAR(150),
    type ENUM('犬','猫','小動物'),
    classifcation VARCHAR(42),
    birthplace VARCHAR(10),
    birthday DATE
);

-- テストレコードの挿入
INSERT INTO animals(description, type, classifcation, birthplace, birthday) VALUES
('しわしわお顔にぺちゃ鼻くりくりぱっちり大きな目、愛嬌たっぷり元気な子です！短毛で色はホワイト系にブラックの混色のブルドックです。',1,'ブルドック','神奈川県','2019/11/30'),
('非常に美人なノルウェージャンフォレストキャットです！色はホワイト系のブルータービーでふわふわ長毛でおっとりとした性格をしています！',2,'ノルウェージャンフォレストキャット','東京都','2019/12/03'),
('臆病ですが、人馴れしています！ベタ慣れしています。ぱっちり目のピグミーヘッジホッグです。おっとりした性格ですが、食いしん坊で食欲旺盛、活発な赤ちゃんです。',3,'ハリネズミ','タイ','2020/01/02'),
('まだ人馴れしていない赤ちゃんヒョウモントカゲモドキです！ぱっちり大きな目で食欲旺盛。なつくとしっぽをふりふりしてくれます。人気のハイポタンジェリンです。',3,'爬虫類','アメリカ','2019/01/01'),
('なつくと主人に忠実な柴犬です！くりくりぱっちり目で元気いっぱい愛嬌のよい子です！色はブラウン系のレッドカラーです！遊ぶことが大好きなかわいい子です',1,'柴犬','静岡県','2019/10/29'),
('非常におっとりした性格のネザーランドドワーフラビットです！ベタ慣れしています。オレンジ系のふわふわ毛の美人さん。',3,'ウサギ','秋田県','2019/12/25'),
('元気いっぱいのチワワです！愛嬌たっぷり人馴れしていて遊ぶことが大好きです。うるうるの大きな目でみつめてきます！色はブラウン系の長毛チョコレートタンです。',1,'チワワ','岩手県','2019/11/30'),
('ふわふわおっとりとした性格で食欲旺盛なかわいい子です！愛嬌たっぷり人馴れしています。色はシルバータビーにホワイトグレイ系の短毛です！',2,'スコティッシュフォールド','神奈川県','2019/12/01'),
('くりくりぱっちり大きな目の元気いっぱいなパグです！とにかく遊ぶことが大好きでしっぽをふりふりしておもちゃをもってきます。食欲旺盛！ぺちゃ鼻でもご飯はもりもり！クリーム系フォーンの短毛です。',1,'パグ','静岡県','2019/11/29'),
('ぺちゃ鼻にくりくりぱっちりうるうる大きな目をした子です！おっとりした性格で癒やしてくれます。人馴れしていてとにかく懐っこいです。しっぽをふりふりしてついて来る姿がかわいい！短毛のつやつやブラック。',1,'パグ','北海道','2019/10/20'),
('元気いっぱい活発な子です！イケメン君でキリッとしています、短毛でしっぽはふわふわです！遊ぶことが大好きで人馴れしています。ブラウン系ルディ。',2,'ソマリ','香川県','2019/10/1'),
('特有のぺちゃ鼻おっとり顔ですが元気いっぱい活発な子です！いつもお気に入りのおもちゃで遊んでいます。エキゾチックの中でも長毛のホワイト系シルバータビーです',2,'エキゾチック','東京都','2019/10/15'),
('目鼻立ちの整った美人さんです。食欲旺盛でぱっちり大きな目おっとりした性格でマイペースなかわいい子です！ふわふわのブラウン系長毛で非常に大きく育ちます。',2,'メイクーン','香川県','2019/10/16'),
('まだ人馴れしていない活発なジャンガリアンハムスターの赤ちゃんです！ふわふわの毛でおしりふりふりぱっちり目でいつも頬袋にひまわりの種でいっぱいな姿がかわいいです。',3,'ハムスター' ,'神奈川県','2019/12/31'),
('鎧のような鱗がかっこいい人気のアルマジロトカゲです！警戒すると丸くなる姿がかわいい。人馴れしているので手に乗ります。おっとりした性格マイペースでよく寝るので暖かい部屋をよういしてあげてください。',3,'爬虫類','南アフリカ','2017/05/08');
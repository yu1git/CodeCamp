<pre>
<?php
// MAMP
$host = 'localhost'; // データベースのホスト名又はIPアドレス
$username = 'root';  // MySQLのユーザ名
$passwd   = 'root';    // MySQLのパスワード
$dbname   = 'codecamp';    // データベース名
$link = mysqli_connect($host, $username, $passwd, $dbname);
// 接続成功した場合
if ($link) {
    // 文字化け防止
    mysqli_set_charset($link, 'utf8');
    // オートインクリメントではないため失敗
    $query = 'INSERT INTO goods_table(goods_name, price) VALUES(\'ボールペン\', 80)';

    // $query = 'UPDATE goods_table SET price = 60 WHERE goods_id = 6';
    // $query = 'DELETE FROM goods_table WHERE goods_id = 6';

    // クエリを実行します
    if (mysqli_query($link, $query) === TRUE) {
        print '成功';
    } else {
        print '失敗';
    }
    
    // 接続を閉じます
    mysqli_close($link);
// 接続失敗した場合
} else {
   print 'DB接続失敗';
}
?>
</pre>
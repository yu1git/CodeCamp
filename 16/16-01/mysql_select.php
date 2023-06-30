<pre>
<?php
// MAMP
$host = 'localhost'; // データベースのホスト名又はIPアドレス ※CodeCampでは「localhost」で接続できます
$username = 'root';  // MySQLのユーザ名
$passwd   = 'root';    // MySQLのパスワード
$dbname   = 'codecamp';    // データベース名
// データベース接続　mysqli_connect()の返り値はリンクID
$link = mysqli_connect($host, $username, $passwd, $dbname);
// 接続成功した場合
if ($link) {
   // 文字化け防止
   mysqli_set_charset($link, 'utf8');
   $query = 'SELECT goods_id, goods_name, price FROM goods_table';
   // クエリを実行します
   $result = mysqli_query($link, $query);
   // 1行ずつ結果を配列で取得します
   while ($row = mysqli_fetch_array($result)) {
       print $row['goods_id'];
       print $row['goods_name'];
       print $row['price'];
       print "\n";
   }
   // 結果セット(メモリ)を開放します
   mysqli_free_result($result);
   // 接続を閉じます
   mysqli_close($link);
// 接続失敗した場合
} else {
   print 'DB接続失敗';
}
?>
</pre>
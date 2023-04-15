<?php
// $valueの値を定義
$value = 55.5555;
 
// 小数切り捨て値の処理を記述
// 参考サイト　https://www.php.net/manual/ja/function.floor.php
$floor_v = floor($value);
 
// 小数切り上げの処理を記述
// 参考サイト　https://www.php.net/manual/ja/function.ceil.php
$ceil_v = ceil($value);
 
// 小数四捨五入の処理を記述
// 参考サイト　https://www.php.net/manual/ja/function.round.php
$round_v = round($value);
 
// 小数点以下第三位四捨五入の処理を記述
$round3_v = round($value, 2);
 
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>課題</title>
</head>
<body>
    <p>元の値: <?php print $value; ?></p>
    <p>小数切り捨て: <?php print $floor_v; ?></p>
    <p>小数切り上げ: <?php print $ceil_v; ?></p>
    <p>小数四捨五入: <?php print $round_v; ?></p>
    <p>小数点第三位で四捨五入: <?php print $round3_v; ?></p>
</body>
</html>
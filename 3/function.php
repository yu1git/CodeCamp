<?php
// 乱数　rand()関数より後にできた関数
$score = mt_rand(0, 100);
print $score;

$str = '<h2>php</h2>';
print $str;
// 特殊文字を表示可能な形式に変換 XSS対策
print htmlspecialchars($str, ENT_QUOTES);

$str = '文字列';
// 文字列の長さを取得
$length = mb_strlen($str);
print $str;
print $length;
?>
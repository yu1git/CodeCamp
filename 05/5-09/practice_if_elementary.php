<pre>
<?php
 
// 0〜2のランダムな数値を2つ取得し、それぞれ変数$rand1と$rand2へ代入
$rand1 = mt_rand(0, 2);
$rand2 = mt_rand(0, 2);
 
// ランダムな数値$rand1と$rand2をそれぞれ表示
print 'rand1: ' . $rand1 . "\n";
print 'rand2: ' . $rand2 . "\n";
 
// $rand1と$rand2のどちらのほうが大きいか比較し、結果を表示
if ($rand1 > $rand2) {
    print 'rand1のほうが大きい値です';
} else if ($rand1 < $rand2) {
    print 'rand2のほうが大きい値です';
} else if ($rand1 === $rand2) {
    print '2つは同じ値です';
}
 
?>
</pre>
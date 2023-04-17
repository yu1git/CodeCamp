<pre>
<?php
// シングルクォートとダブルクォートの違い
// ：変数やエスケープシーケンスを認識できるかできないか
$test_str = 'これは変数です';
print "ダブルクォート: $test_str";
print "\n";
print 'シングルクォート: $test_str';
print '\n';
?>
</pre>
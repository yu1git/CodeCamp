<pre>
<?php
$int = 123;
$str = '123';

// 文字列から数値型への型変換を行った場合、「最初の数値から数値以外の文字が出るまで」を数値として見なし、それ以降は全て無視されます。
//$str = '123abc123'; //$int == $str is trueとなる。

 
// 「==」は型の比較はしない。厳密には「型を片方に合わせるよう変換した後に比較する」
if ($int == $str) {
    print '$int == $str is true' . "\n";
} else {
    print '$int == $str is false' . "\n";
}
 
if ($int === $str) {
    print '$int === $str is true' . "\n";
} else {
    print '$int === $str is false' . "\n";
}
?>
</pre>
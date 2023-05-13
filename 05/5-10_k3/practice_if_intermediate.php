<pre>
<?php
$now = date('s');
$repdigit = substr($now, 0, 1) == substr($now, 1, 1);

if ($now ==='00') {
    print 'ジャストタイム!!';
} else if ($repdigit) {
    print 'ゾロ目!';
} else {
    print '外れ';
}

print "\n" . 'アクセスした瞬間の秒は' . $now . 'でした';

?>
</pre>
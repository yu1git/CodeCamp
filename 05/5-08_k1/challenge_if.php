<pre>
<?php
$dice = mt_rand(1, 6);

print $dice . "\n";

$even_number = $dice % 2 === 0;
if ($even_number) {
    print '偶数';
} else {
    print '奇数';
}
?>
</pre>
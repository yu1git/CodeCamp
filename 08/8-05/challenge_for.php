<?php
// 1から100までの間で、3の倍数の数だけを足した合計値を表示
$result = 0;
for ($i = 1; $i <= 100; $i++) {
    if ($i % 3 === 0) {
        $result = $result + $i;
    }
}
print $result;
?>
<?php
// 1から100までの整数に対し、
// 3で割り切れる場合は「Fizz」
// 5で割り切れる場合は「Buzz」
// 3でも5でも割り切れる場合は「FizzBuzz」
// 上記以外は数値そのまま
// を表示してください。

for ($i = 1; $i <= 100; $i++) {
    if ($i % 3 === 0 && $i % 5 === 0)  {
        print 'FizzBuzz';
    } else if ($i % 3 === 0) {
        print 'Fizz';
    } else if ($i % 5 === 0) {
        print 'Buzz';
    } else {
        print $i;
    }
    print "<br>";
}
?>
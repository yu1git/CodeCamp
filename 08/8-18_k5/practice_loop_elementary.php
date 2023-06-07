<?php
// コイントスをセレクトボックスで指定した回数(10 or 100 or 1000)行い、表と裏が出た回数を表示する

// 回数　選択肢
$times = [10, 100, 1000];
$time = 0;
$coin_front = 0;
$coin_back = 0;
$coin_random = 0;

if (isset($_POST['coin_time']) === TRUE) {
    $time = htmlspecialchars($_POST['coin_time'], ENT_QUOTES, 'UTF-8');

    for ($i = 0; $i < $time; $i++) {
        $coin_random = mt_rand(0, 1);
        if ($coin_random === 0) {
            $coin_back++;
            // $coin_back = ++$coin_back;
        } else if ($coin_random === 1) {
            $coin_front++;
            // $coin_front = ++$coin_front;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
   <meta charset="UTF-8">
   <title>課題(初級)</title>
</head>
<body>
    <article id="wrap">
        <p>表：<?php print $coin_front;?>回</p>
        <p>裏：<?php print $coin_back;?>回</p>
        <form method="post">
            <select name="coin_time">
<?php
foreach ($times as $time) {
?>
                <option value="<?php print $time; ?>"><?php print $time;?></option>
<?php
}
?>
            </select>回
            <button type="submit">コイントス</button>
        </form>
    </article>
</body>
</html>

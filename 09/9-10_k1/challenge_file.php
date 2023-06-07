<?php
// テキストボックスの値をPOSTで送信し、日時とユーザが入力した値を1行ずつファイル(challenge_log.txt)に保存し、ページ下部にファイル内容を1行ずつ表示する

$filename = './challenge_log.txt';
$comment = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
 
    if (isset($_POST['comment']) === TRUE) {
        $comment = $_POST['comment'];
    }

    // ファイル書き込み
    if (($fp = fopen($filename, 'a')) !== FALSE) {
        // 時間　ゾーンを設定してないと日本時間にならないことも
        $log = date('m月d日 H:i:s') . "\t" . $comment . "\n";
        if (fwrite($fp, $log) === FALSE) {
            print 'ファイル書き込み失敗:  ' . $filename;
        }
        fclose($fp);
    }
}

$data = [];
 
if (is_readable($filename) === TRUE) {
    // ファイル読み込み
    if (($fp = fopen($filename, 'r')) !== FALSE) {
        while (($tmp = fgets($fp)) !== FALSE) {
            $data[] = htmlspecialchars($tmp, ENT_QUOTES, 'UTF-8');
        }
        fclose($fp);
    }
} else {
    $data[] = 'ファイルがありません';
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>課題</title>
</head>
<body>
    <h1>課題</h1>
 
    <form method="post">
        <p>発言：
        <input type="text" name="comment">
        <input type="submit" name="submit" value="送信">
        </p>
    </form>
 
    <p>発言一覧</p>
<?php foreach ($data as $read) { ?>
    <p><?php print $read; ?></p>
<?php } ?>
</body>
</html>
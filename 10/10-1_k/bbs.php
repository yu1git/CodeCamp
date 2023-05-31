<?php
$filename = './bbs_log.txt';
$name = '';
$comment = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['name']) === TRUE) {
        $name = $_POST['name'];
    }
    if (isset($_POST['comment']) === TRUE) {
        $comment = $_POST['comment'];
    }

    // ファイル書き込み
    if (($fp = fopen($filename,'a')) !== FALSE) {
        $log = $name . "\t" . $comment . "\t" . '発言日時：' . date('m月d日 H:i:s') .  "\n";
        
        if (fwrite($fp,$log) === FALSE) {
            print 'ファイル書き込み失敗:  ' . $filename;
        }
        fclose($fp);
    }

}

$data = [];

if (is_readable($filename) === TRUE) {
    // ファイル読み込み
    if (($fp = fopen($filename,'r')) !== FALSE) {
        while (($tmp = fgets($fp)) !== FALSE) {
            $data[] = $tmp;
        }
        fclose($fp);
    }
    $data = array_reverse($data);
} else {
    $data[] = '発言がありません';
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ひとこと掲示板</title>
</head>
<body>
    <h1>ひとこと掲示板</h1>
 
    <form method="post">
        <p>名前：
            <input type="text" name="name">
        </p>
        <p>発言：
            <input type="text" name="comment">
        </p>
        <input type="submit" name="submit" value="送信">
    </form>
 
    <p>発言一覧</p>
<?php foreach ($data as $read) { ?>
    <p><?php print htmlspecialchars($read, ENT_QUOTES, 'UTF-8'); ?></p>
<?php } ?>
</body>
</html>
<?php
$bbs_table = [];
$name = '';
$comment = '';

$name_error_messages = [];
$comment_error_messages = [];

// XAMPP
// $host = 'localhost';
// $username = 'root';
// $passwd   = '';
// $dbname   = 'codecamp';

// MAMP
$host = 'localhost';
$username = 'root';
$passwd   = 'root';
$dbname   = 'codecamp';

$link = mysqli_connect($host, $username, $passwd, $dbname);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['name']) === TRUE) {
        $name = $_POST['name'];
    }
    if (isset($_POST['comment']) === TRUE) {
        $comment = $_POST['comment'];
    }
    
    // バリデーションチェック
    if (empty($name)) {
        $name_error_messages[] = '名前は必ず文字を入力してください';
    } else if (mb_strlen($name) >= 20) {
        $name_error_messages[] = '名前は20文字以内で入力してください';
    }
    if (empty($comment)) {
        $comment_error_messages[] = '発言は必ず文字を入力してください';
    } else if (mb_strlen($comment) >= 100) {
        $comment_error_messages[] = '発言は100文字以内で入力してください';
    } 

    if ((empty($name_error_messages) || empty($comment_error_messages)) && $link) {
        // 文字化け防止
        mysqli_set_charset($link, 'utf8');






        // ファイル書き込み
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
    <style type="text/css">
        .error_txt {
            color: red;
        }
    </style>
</head>
<body>
    <h1>ひとこと掲示板</h1>
 
    <form method="post">
        <p>名前(必須)：
            <input type="text" name="name">
        </p>
        <p>名前は20文字以内で入力してください</>
        <p>発言(必須)：
            <input type="text" name="comment">
        </p>
        <p>発言は100文字以内で入力してください</p>
        <?php if (isset($error_messages) && !empty($error_messages)) {
            foreach ($error_messages as $error_message) { ?>
            <p class="error_txt"><?php print $error_message; ?></p>
        <?php }} ?>
        <input type="submit" name="submit" value="送信">
    </form>
 
    <p>発言一覧</p>
<?php foreach ($data as $read) { ?>
    <p><?php print htmlspecialchars($read, ENT_QUOTES, 'UTF-8'); ?></p>
<?php } ?>
</body>
</html>
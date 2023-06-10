<?php
$filename = './bbs_log.txt';
$name = '';
$comment = '';
$error_messages = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['name']) === TRUE) {
        $name = $_POST['name'];
    }
    if (isset($_POST['comment']) === TRUE) {
        $comment = $_POST['comment'];
    }

    // 利用者の名前とコメントは必ず文字が入力される。もし名前あるいはコメントが未入力で発言した場合はエラーメッセージを表示し、発言できないようにする。
    if (empty($name) || empty($comment)) {
        $error_messages[] = '名前とコメントは必ず文字を入力してください';
    }

    // 利用者の名前は最大20文字以内まで発言できる。もし20文字より多くの文字を入力して発言した場合はエラーメッセージを表示し、発言できないようにする。
    if (mb_strlen($name) >= 20) {
        $error_messages[] = '名前は20文字以内で入力してください';
    }

    // 利用者のコメントは最大100文字以内まで発言できる。もし100文字より多くの文字を入力して発言した場合はエラーメッセージを表示し、発言できないようにする。
    if (mb_strlen($comment) >= 100) {
        $error_messages[] = '発言は100文字以内で入力してください';
    } 

    if (empty($error_messages) && ($fp = fopen($filename,'a')) !== FALSE) {
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
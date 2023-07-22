<?php
$bbs_table = [];
$name = '';
$comment = '';

$name_error_messages = '';
$comment_error_messages = '';

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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['name']) === TRUE) {
        $name = $_POST['name'];
    }
    if (isset($_POST['comment']) === TRUE) {
        $comment = $_POST['comment'];
    }
    
    // バリデーションチェック
    if (empty($name)) {
        $name_error_messages = '名前は必ず文字を入力してください';
    } else if (mb_strlen($name) >= 20) {
        $name_error_messages = '名前は20文字以内で入力してください';
    }
    if (empty($comment)) {
        $comment_error_messages = '発言は必ず文字を入力してください';
    } else if (mb_strlen($comment) >= 100) {
        $comment_error_messages = '発言は100文字以内で入力してください';
    }

    $link = mysqli_connect($host, $username, $passwd, $dbname);
    if ((empty($name_error_messages) || empty($comment_error_messages)) && $link) {
        // 文字化け防止
        mysqli_set_charset($link, 'utf8');

        $query = 'INSERT INTO bbs_table(name, comment,create_date) VALUES(\'' . $name . '\',\'' . $comment . '\',\'' . date('Y-m-d H:i:s') . '\')';

        // クエリを実行します
        if (mysqli_query($link, $query) === TRUE) {
            print '追加成功';
        } else {
            print '追加失敗';
        }
        // 接続を閉じます
        mysqli_close($link);
    // 接続失敗した場合
    } else {
        print 'DB接続失敗';
    }

}

$link = mysqli_connect($host, $username, $passwd, $dbname);
if ($link) {
    // 文字化け防止
    mysqli_set_charset($link, 'utf8');
    
    $query = 'SELECT * FROM bbs_table';

    // クエリを実行します
    $result = mysqli_query($link, $query);
    // 1行ずつ結果を配列で取得します
    while ($row = mysqli_fetch_array($result)) {
        $bbs_table[] = $row;
    }
    // 結果セットを開放します ※SELECTでデータを取得したときのみ、メモリの開放が必要
    mysqli_free_result($result);

    // 接続を閉じます
    mysqli_close($link);
// 接続失敗した場合
} else {
    print '発言がありません';
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
        <?php if (isset($name_error_messages) && !empty($name_error_messages)) { ?>
            <p class="error_txt"><?php print $name_error_messages; ?></p>
        <?php } ?>
        <p>発言(必須)：
            <input type="text" name="comment">
        </p>
        <p>発言は100文字以内で入力してください</p>
        <?php if (isset($comment_error_messages) && !empty($comment_error_messages)) { ?>
            <p class="error_txt"><?php print $comment_error_messages; ?></p>
        <?php } ?>
        <input type="submit" name="submit" value="送信">
    </form>
 
    <p>発言一覧</p>
<?php if (!empty($bbs_table)) {foreach ($bbs_table as $read) { ?>
    <p>
        <?php 
            print htmlspecialchars($read['name'], ENT_QUOTES, 'UTF-8');
            print '&nbsp';
            print htmlspecialchars($read['comment'], ENT_QUOTES, 'UTF-8');
            print '&nbsp';
            print htmlspecialchars($read['create_date'], ENT_QUOTES, 'UTF-8');
         ?>
    </p>
<?php }} else {print '発言がありません';} ?>
</body>
</html>
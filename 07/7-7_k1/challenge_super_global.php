<?php
// 変数初期化
$my_name = '';
$gender = '';
$mail = '';

if (isset($_POST['my_name']) === TRUE) {
    $my_name = htmlspecialchars($_POST['my_name'], ENT_QUOTES, 'UTF-8');
 }
if (isset($_POST['gender']) === TRUE) {
   $gender = htmlspecialchars($_POST['gender'], ENT_QUOTES, 'UTF-8');
}
// 質問：なぜboolean型ではないのか？
if (isset($_POST['mail']) === TRUE) {
    $mail = htmlspecialchars($_POST['mail'], ENT_QUOTES, 'UTF-8');
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
   <meta charset="UTF-8">
   <title>課題</title>
</head>
<body>
    <form method="post">
        <label>お名前：
        <input id="my_name" type="text" name="my_name" value="">
        </label>
        <br>
        <label>性別：
        <input type="radio" name="gender" value="man">男
        <input type="radio" name="gender" value="woman">女
        </label>
        <br>
        <input type="checkbox" name="mail" value="OK">お知らせメールを受け取る
        <br>
        <input type="submit" value="送信">
    </form>
    <?php if ($my_name !== '') { ?>
        <p>名前：<?php print $my_name; ?></p>
    <?php } ?>
    <?php if ($gender !== '') { ?>
        <p>性別：<?php print $gender; ?></p>
    <?php } ?>
    <?php if ($mail === 'OK') { ?>
        <p>お知らせメールを受け取ります：<?php print $mail; ?></p>
    <?php } ?>
</body>

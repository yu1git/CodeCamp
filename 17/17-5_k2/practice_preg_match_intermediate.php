<?php
$bbs_table = [];
$email = '';
$password = '';
$result = false;

$email_error_messages = '';
$password_error_messages = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['email']) === TRUE) {
        $email = $_POST['email'];
    }
    if (isset($_POST['password']) === TRUE) {
        $password = $_POST['password'];
    }
    $regexp_mail = '/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9]*.[a-zA-Z0-9]{2,3}.[a-zA-Z0-9]{0,2}$/';
    $regexp_password = '/^[a-zA-Z0-9.?\/-]{6,18}$/';
    // バリデーションチェック
    if (empty($email)) {
        $email_error_messages = 'メールアドレスは必ず文字を入力してください';
    } else if (!preg_match($regexp_mail, $email)) {
        $email_error_messages = 'メールアドレスの形式が正しくありません';
    }
    if (empty($password)) {
        $password_error_messages = 'パスワードは必ず文字を入力してください';
    } else if (mb_strlen($password) <= 6 || mb_strlen($password) >= 18 || !preg_match($regexp_password, $password)) {
        $password_error_messages = 'パスワードは半角英数記号6文字以上18文字以下で入力してください';
    }

    if ((empty($email_error_messages) || empty($password_error_messages)) ) {
        $result = true;
    } else {
        $result = false;
    }

}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>課題</title>
    <style type="text/css">
        .error_txt {
            color: red;
        }
    </style>
</head>
<body>
<?php if ($result){ ?>
    <h1>登録完了</h1>
<?php }else{ ?>
    <form method="post">
        <p>メールアドレス</p>
        <input type="text" name="email">
        <?php if (isset($email_error_messages) && !empty($email_error_messages)) { ?>
            <p class="error_txt"><?php print $email_error_messages; ?></p>
        <?php } ?>

        <p>パスワード</p>
        <input type="text" name="password">
        <?php if (isset($password_error_messages) && !empty($password_error_messages)) { ?>
            <p class="error_txt"><?php print $password_error_messages; ?></p>
        <?php } ?>
        <br>
        <input type="submit" name="submit" value="送信">
    </form>
<?php } ?>
</body>
</html>
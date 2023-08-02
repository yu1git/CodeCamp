<?php
$goods_table = [];
$name = '';
$price = '';
$message = '追加したい商品の名前と価格を入力してください';

// XAMPP
$host = 'localhost';
$username = 'root';
$passwd   = '';
$dbname   = 'codecamp';

// MAMP
// $host = 'localhost';
// $username = 'root';
// $passwd   = 'root';
// $dbname   = 'codecamp';

// 質問：一度の接続でSELECTとINSERTの両方を行う　or　SELECT後、一度接続を閉じて、formの送信があったときだけ再度DBに接続　　どちらが適切か？
// 回答：接続を閉じずに両方の処理をおこなってよい。違うDBに接続する場合は分ける必要がある。
$link = mysqli_connect($host, $username, $passwd, $dbname);

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    if (isset($_POST['name']) === TRUE) {
        $name = $_POST['name'];
    }
    if (isset($_POST['price']) === TRUE) {
        $price = (int) $_POST['price'];
    }

    if ($link) {
        // 文字化け防止
        mysqli_set_charset($link, 'utf8');

        $query = 'INSERT INTO goods_table(goods_name, price) VALUES(\'' . $name . '\',' . $price . ')';

        // クエリを実行します
        if (mysqli_query($link, $query) === TRUE) {
            $message = '追加成功';
        } else {
            $message = '追加失敗';     
        }
        
        // 接続を閉じます
        // mysqli_close($link);
    // 接続失敗した場合
    } else {
        $message = 'DB接続失敗';
    }
}

// 再接続　※一度接続を閉じたあとは、再接続しないと追加が成功しない
// $link = mysqli_connect($host, $username, $passwd, $dbname);
// 接続成功した場合
if ($link) {
    // 文字化け防止
    mysqli_set_charset($link, 'utf8');

    $query = 'SELECT * FROM goods_table';

    // クエリを実行します
    $result = mysqli_query($link, $query);
    // 1行ずつ結果を配列で取得します
    while ($row = mysqli_fetch_array($result)) {
        $goods_table[] = $row;
    }
    // 結果セットを開放します ※SELECTでデータを取得したときのみ、メモリの開放が必要
    mysqli_free_result($result);

    // 接続を閉じます
    mysqli_close($link);
// 接続失敗した場合
} else {
    $message = 'DB接続失敗';
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>課題</title>
    <style type="text/css">
        table, td, th {
            border: solid black 1px;
        }
        table {
            width: 200px;
        }
    </style>
</head>
<body>
    <p><?php print $message ?></p>
    <h1>商品一覧</h1>
    <form method="post">
        <p>
            商品名：<input type="text" name="name" value="<?php if (isset($name) === TRUE) { print $name; } ?>">
            価格：<input type="text" name="price" value="<?php if (isset($price) === TRUE) { print $price; } ?>">
            <!-- 価格：<input type="number" name="price" value="<?php if (isset($price) === TRUE) { print $price; } ?>"> -->
            <input type="submit" value="追加">
        </p>
    </form>
    <table>
        <tr>
            <th>商品名</th>
            <th>価格</th>
        </tr>
<?php
foreach ($goods_table as $value) {
?>
        <tr>
            <td><?php print htmlspecialchars($value['goods_name'], ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php print htmlspecialchars($value['price'], ENT_QUOTES, 'UTF-8'); ?></td>
        </tr>
<?php
}
?>
    </table>
</body>
</html>
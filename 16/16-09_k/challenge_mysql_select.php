<?php
$goods_data = [];
$where = '';
if (isset($_GET['where']) === TRUE) {
    $where = 'WHERE job = \'' . $_GET['where'] . '\'';
}
// MAMP
$host = 'localhost'; // データベースのホスト名又はIPアドレス
$username = 'root';  // MySQLのユーザ名
$passwd   = 'root';    // MySQLのパスワード
$dbname   = 'codecamp';    // データベース名
$link = mysqli_connect($host, $username, $passwd, $dbname);
// 接続成功した場合
if ($link) {
    // 文字化け防止
    mysqli_set_charset($link, 'utf8');
    $query = 'SELECT * FROM emp_table ' . $where;
    var_dump($query);
    // クエリを実行します
    $result = mysqli_query($link, $query);
    // 1行ずつ結果を配列で取得します
    while ($row = mysqli_fetch_array($result)) {
        $emp_table[] = $row;
    }
    // 結果セットを開放します
    mysqli_free_result($result);
    // 接続を閉じます
    mysqli_close($link);
// 接続失敗した場合
} else {
    print 'DB接続失敗';
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
            width: 400px;
        }
    </style>
</head>
<body>
    <h1>商品一覧</h1>
    <form>
            <select name="where">
                <option value="" <?php if ($where === '') {print 'selected';} ?>>全員</option>
                <option value="manager" <?php if ($where === 'manager') {print 'selected';} ?>>マネージャー</option>
                <option value="analyst" <?php if ($where === 'analyst') {print 'selected';} ?>>アナリスト</option>
                <option value="clerk" <?php if ($where === 'clerk') {print 'selected';} ?>>一般職</option>
            </select>
        <input type="submit" value="表示">
    </form>
    <table>
        <tr>
            <th>社員番号</th>
            <th>名前</th>
            <th>職種</th>
            <th>年齢</th>
        </tr>
<?php
foreach ($emp_table as $value) {
?>
        <tr>
            <td><?php print htmlspecialchars($value['emp_id'], ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php print htmlspecialchars($value['emp_name'], ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php print htmlspecialchars($value['job'], ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php print htmlspecialchars($value['age'], ENT_QUOTES, 'UTF-8'); ?></td>
        </tr>
<?php
}
?>
    </table>
</body>
</html>
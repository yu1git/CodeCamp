<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>課題</title>
    <style>
        h1 {
            text-align: center;
            font-size: 14px;
        }
        tr:nth-child(2n+1) td:nth-child(2n+1) {
            background-color: #c7eafa;
        }
        tr:nth-child(2n) td:nth-child(2n) {
            background-color: #c7eafa;
        }
    </style>
</head>
<body>
    <h1>九九表</h1>
    <table border="1">
<?php
for ($i = 1; $i < 10; $i++) {
?>
    <tr>
<?php
    for ($j = 1; $j < 10; $j++) {
        $result = 0;
        $result = $j * $i;

?>
        <td>
            <?php print $j . '*' . $i . '=' . $result ?>
        </td>
<?php
    }
?>
    </tr>
<?php
}
?>
    </table>
</body>
</html>
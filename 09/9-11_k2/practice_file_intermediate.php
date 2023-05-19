<?php
// 日本郵便のページにある郵便番号のデータを利用し、「郵便番号」「住所」のデータを表示

$filenames = ['./zip_data_split_1.csv', './zip_data_split_2.csv', './zip_data_split_3.csv'];

$data = [];
$h = 0;

foreach ($filenames as $filename){
    if (is_readable($filename) === TRUE) {
        // ファイル読み込み
        if (($fp = fopen($filename, 'r')) !== FALSE) {
            while (($tmps = fgetcsv($fp)) !== FALSE) {
                foreach ($tmps as $key => $tmp) {
                    $data[$h][$key] = $tmp;                 
                }
                $h++;
            }
            fclose($fp);
        }
    } else {
        $data[] = 'ファイルがありません';
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>課題</title>
</head>
<body>
    <p>以下にファイルから読み込んだ住所データを表示</p>
    <br>
    <p>住所データ</p>
    <table border="1" cellspacing="0">
        <thead>
            <th>郵便番号</th>
            <th>都道府県</th>
            <th>市区町村</th>
            <th>町域</th>
        </thead>
        <tbody>
<?php foreach ($data as $reads) { ?>
            <tr>
    <?php foreach ($reads as $key => $read) {
        if (in_array($key, [0, 4, 5, 6])) {
    ?>
                <td><?php print $read; ?></td>        
        <?php }} ?>
            </tr>
<?php } ?>
        </tbody>
</table>
</body>
</html>
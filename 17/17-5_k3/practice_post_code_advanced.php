<?php
// 初期化
$zipcode = '';
$pref = '';
$address = '';

$zipcode_error_messages = '';
$pref_address_error_messages = '';

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
    if ( isset( $_POST['zipcode'] ) === TRUE ) {
        $zipcode = $_POST['zipcode'];
        // 入力の前後にある全角及び半角スペースを削除
    }
    if ( isset( $_POST['pref'] ) === TRUE ) {
        $pref = $_POST['pref'];
        // 入力の前後にある全角及び半角スペースを削除

    }
    if ( isset( $_POST['address'] ) === TRUE ) {
        $address = $_POST['address'];
        // 入力の前後にある全角及び半角スペースを削除

    }

    $regexp_zipcode = '/^[0-9]{7}$/';

    // バリデーションチェック
    if (empty($zipcode)) {
        $zipcode_error_messages = '郵便番号は必ず入力してください';
    } else if (!preg_match($regexp_zipcode, $zipcode)) {
        $zipcode_error_messages = '郵便番号は7桁の数値で入力してください';
    }

    if (empty($pref) or empty($address)) {
        $pref_address_error_messages = '都道府県と市区町村は必ず文字を入力してください';
    }
}
?>
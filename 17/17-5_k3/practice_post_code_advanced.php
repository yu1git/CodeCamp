<?php
// 初期化
$zipcode = '';
$pref = '';
$address = '';
$result_list = [];

// データ総数
$count = 0;

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

    if ( $_POST['search_method'] === 'zipcode' ){
        if ( isset( $_POST['zipcode'] ) === TRUE ) {
            $zipcode = $_POST['zipcode'];
            // 入力の前後にある全角及び半角スペースを削除
            // 全角スペースを半角に変換（trimでは全角スペースを削除しないため）
            $zipcode = mb_convert_kana($zipcode, "s", 'UTF-8');
            $zipcode = trim($zipcode);
        }

        // 郵便番号は7桁の数値のみ検索可能
        $regexp_zipcode = '/^[0-9]{7}$/';

        // バリデーションチェック
        if (empty($zipcode)) {
            $zipcode_error_messages = '郵便番号は必ず入力してください';
        } else if (!preg_match($regexp_zipcode, $zipcode)) {
            $zipcode_error_messages = '郵便番号は7桁の数値で入力してください';
        }

        if (empty($zipcode_error_messages) && $link) {
            // 文字化け防止
            mysqli_set_charset($link, 'utf8');
    
            $query = 'SELECT * FROM zip_data_split_1 WHERE zipcode = \'' . $zipcode . '\'';
    
            // クエリを実行します
            $result = mysqli_query($link, $query);
            // 1行ずつ結果を配列で取得します
            while ($row = mysqli_fetch_array($result)) {
                $result_list[] = $row;
            }
            // 結果セットを開放します ※SELECTでデータを取得したときのみ、メモリの開放が必要
            mysqli_free_result($result);

            var_dump($result_list);
        // 接続失敗した場合
        } else {
            print 'DB接続失敗';
        }
    }
    
    if ( $_POST['search_method'] === 'address' ){
        if ( isset( $_POST['pref'] ) === TRUE ) {
            $pref = $_POST['pref'];
            // 入力の前後にある全角及び半角スペースを削除
            // 全角スペースを半角に変換（trimでは全角スペースを削除しないため）
            $pref = mb_convert_kana($pref, "s", 'UTF-8');
            $pref = trim($pref);
        }
        if ( isset( $_POST['address'] ) === TRUE ) {
            $address = $_POST['address'];
            // 入力の前後にある全角及び半角スペースを削除
            // 全角スペースを半角に変換（trimでは全角スペースを削除しないため）
            $address = mb_convert_kana($address, "s", 'UTF-8');
            $address = trim($address);
        }

        // バリデーションチェック
        if (empty($pref) or empty($address)) {
            $pref_address_error_messages = '都道府県と市区町村は必ず両方入力してください';
        }

        if (empty($pref_address_error_messages) && $link) {
            // 文字化け防止
            mysqli_set_charset($link, 'utf8');
    
            $query = 'SELECT * FROM zip_data_split_1 WHERE pref = \'' . $pref . '\' AND address1 = \'' . $address . '\'';
    
            // クエリを実行します
            $result = mysqli_query($link, $query);
            // 1行ずつ結果を配列で取得します
            while ($row = mysqli_fetch_array($result)) {
                $result_list[] = $row;
            }
            // 結果セットを開放します ※SELECTでデータを取得したときのみ、メモリの開放が必要
            mysqli_free_result($result);
            var_dump($result_list);
        // 接続失敗した場合
        } else {
            print 'DB接続失敗';
        }
    }

    
    
}
// 接続を閉じます
mysqli_close($link);

return $result_list;
?>
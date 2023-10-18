<?php
// エラーを表示
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

// 初期化
$zipcode = '';
$pref = '';
$address = '';
$result_list = [];

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
    $search_method = $_POST['search_method'];
    
    if ($search_method === 'zipcode') {
        if ( isset( $_POST['zipcode'] ) === TRUE ) {
            $zipcode = $_POST['zipcode'];
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

        if (empty($zipcode_error_messages)) {            
            if ($link) {
                mysqli_set_charset($link, 'utf8');
                $query = "SELECT * FROM zip_data_split_1 WHERE zipcode = ?";
                $stmt = mysqli_prepare($link, $query);
                mysqli_stmt_bind_param($stmt, 's', $zipcode);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                while ($row = mysqli_fetch_assoc($result)) {
                    $result_list[] = $row;
                }

                mysqli_free_result($result);
                mysqli_stmt_close($stmt);
                mysqli_close($link);
            } else {
                echo 'DB接続失敗';
            }
        }
    }
    
    if ($search_method === 'address') {
        if ( isset( $_POST['pref'] ) === TRUE ) {
            $pref = $_POST['pref'];
            $pref = mb_convert_kana($pref, "s", 'UTF-8');
            $pref = trim($pref);
        }
        if ( isset( $_POST['address'] ) === TRUE ) {
            $address = $_POST['address'];
            $address = mb_convert_kana($address, "s", 'UTF-8');
            $address = trim($address);
        }

        if (empty($pref) || empty($address)) {
            $pref_address_error_messages = '都道府県と市区町村は必ず入力してください';
        }

        if (empty($pref_address_error_messages)) {
            if ($link) {
                mysqli_set_charset($link, 'utf8');
                $query = "SELECT * FROM zip_data_split_1 WHERE pref = ? AND address1 = ?";
                $stmt = mysqli_prepare($link, $query);
                mysqli_stmt_bind_param($stmt, 'ss', $pref, $address);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                while ($row = mysqli_fetch_assoc($result)) {
                    $result_list[] = $row;
                }

                mysqli_free_result($result);
                mysqli_stmt_close($stmt);
                mysqli_close($link);
            } else {
                echo 'DB接続失敗';
            }
        }
    }
}

return $result_list;
?>

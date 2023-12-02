<?php
// エラーを表示
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

// 初期化
$zipcode = '';
$pref = '';
$address = '';
$result_count = 0;
$result_list = [];
$search_method = '';

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

// ページングに関する変数
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1; // 現在のページ番号
$itemsPerPage = 10; // 1ページに表示するアイテム数
$offset = ($page - 1) * $itemsPerPage; // 結果の取得を開始する位置

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['search_method'])) {
        $search_method = $_GET['search_method'];
        
        if ($search_method === 'zipcode') {
            if ( isset( $_GET['zipcode'] ) === TRUE ) {
                $zipcode = $_GET['zipcode'];
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
                    $query_count = "SELECT COUNT(*) AS count FROM zip_data_split_1 WHERE zipcode = ?";
                    $stmt = mysqli_prepare($link, $query_count);
                    // sii：バインドするパラメータの型を表す文字列。sは文字列、iは整数
                    mysqli_stmt_bind_param($stmt, 's', $zipcode);
                    mysqli_stmt_execute($stmt);
                    $result_count = mysqli_stmt_get_result($stmt);
                    if ($result_count !== false) {
                        while ($row = mysqli_fetch_assoc($result_count)) {
                            $result_count = $row;
                        }

                        mysqli_free_result($result_count);
                    } else {
                        // エラー処理
                        echo 'SELECT ステートメントが失敗しました。';
                    }

                    $query = "SELECT * FROM zip_data_split_1 WHERE zipcode = ? LIMIT ?, ?";
                    $stmt = mysqli_prepare($link, $query);
                    // sii：バインドするパラメータの型を表す文字列。sは文字列、iは整数
                    mysqli_stmt_bind_param($stmt, 'sii', $zipcode, $offset, $itemsPerPage);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    if ($result !== false) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $result_list[] = $row;
                        }

                        mysqli_free_result($result);
                    } else {
                        // エラー処理
                        echo 'SELECT ステートメントが失敗しました。';
                    }
                    mysqli_stmt_close($stmt);
                    mysqli_close($link);
                } else {
                    echo 'DB接続失敗';
                }
            }
        }
        
        if ($search_method === 'address') {
            if ( isset( $_GET['pref'] ) === TRUE ) {
                $pref = $_GET['pref'];
                $pref = mb_convert_kana($pref, "s", 'UTF-8');
                $pref = trim($pref);
            }
            if ( isset( $_GET['address'] ) === TRUE ) {
                $address = $_GET['address'];
                $address = mb_convert_kana($address, "s", 'UTF-8');
                $address = trim($address);
            }

            if (empty($pref) || empty($address)) {
                $pref_address_error_messages = '都道府県と市区町村は必ず入力してください';
            }

            if (empty($pref_address_error_messages)) {
                if ($link) {
                    mysqli_set_charset($link, 'utf8');
                    $query_count = "SELECT COUNT(*) AS count FROM zip_data_split_1 WHERE pref = ? AND address1 = ?";
                    $stmt = mysqli_prepare($link, $query_count);
                    // sii：バインドするパラメータの型を表す文字列。sは文字列、iは整数
                    mysqli_stmt_bind_param($stmt, 'ss', $pref, $address);
                    mysqli_stmt_execute($stmt);
                    $result_count = mysqli_stmt_get_result($stmt);
                    if ($result_count !== false) {
                        while ($row = mysqli_fetch_assoc($result_count)) {
                            $result_count = $row;
                        }

                        mysqli_free_result($result_count);
                    } else {
                        // エラー処理
                        echo 'SELECT ステートメントが失敗しました。';
                    }

                    $query = "SELECT * FROM zip_data_split_1 WHERE pref = ? AND address1 = ? LIMIT ?, ?";
                    $stmt = mysqli_prepare($link, $query);
                    mysqli_stmt_bind_param($stmt, 'ssii', $pref, $address, $offset, $itemsPerPage);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    if ($result !== false) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $result_list[] = $row;
                        }

                        mysqli_free_result($result);
                    } else {
                        // エラー処理
                        echo 'SELECT ステートメントが失敗しました。';
                    }
                    mysqli_stmt_close($stmt);
                    mysqli_close($link);
                } else {
                    echo 'DB接続失敗';
                }
            }
        }
    }

}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>郵便番号検索</title>
    <style>
        .search_reslut {
            border-top: solid 1px;
            margin-top: 10px;
        }

        table {
            border-collapse: collapse;
        }

        table,
        tr,
        th,
        td {
            border: solid 1px;
        }

        caption {
            text-align: left;
        }
    </style>
    <style type="text/css">
        @font-face {
            font-family: Roboto;
            src: url("chrome-extension://mcgbeeipkmelnpldkobichboakdfaeon/css/Roboto-Regular.ttf");
        }
    </style>
    <link rel="stylesheet" href="chrome-extension://mcgbeeipkmelnpldkobichboakdfaeon/css/xq-light.css">
    <link rel="stylesheet" href="chrome-extension://mcgbeeipkmelnpldkobichboakdfaeon/css/dracula.css">
    <link rel="stylesheet" href="chrome-extension://mcgbeeipkmelnpldkobichboakdfaeon/css/codemirror.css">
</head>

<body>
    <h1>郵便番号検索</h1>
    <section>
        <h2>郵便番号から検索</h2>
        <!-- <form method="post" action="practice_post_code_advanced.php"> -->
        <!-- ▼質問　　actionには何を書けばいいのか？　　上記のように本ファイルと別のファイル名では正常に動かなかった。　業務：コントローラーのメソッドを書いてる -->
        <!-- action：該当するformを送信する先。URL先のパスが合っているか -->
        <form method="get" action="">
            <input type="text" name="zipcode" placeholder="0600001" value="">
            <input type="hidden" name="search_method" value="zipcode">
            <input type="submit" value="検索">
        </form>
        <?php 
            if(!empty($zipcode_error_messages)) {
                echo '<p style="color:red">' . $zipcode_error_messages . '</p>';
            }
        ?>
        <h2>地名から検索</h2>
        <form method="get" action="practice_post_code_advanced.php">
            都道府県を選択
            <select name="pref">
                <option value="" selected="">都道府県を選択</option>
                <option value="北海道">北海道</option>
                <option value="青森県">青森県</option>
                <option value="岩手県">岩手県</option>
                <option value="宮城県">宮城県</option>
                <option value="秋田県">秋田県</option>
                <option value="山形県">山形県</option>
                <option value="福島県">福島県</option>
                <option value="茨城県">茨城県</option>
                <option value="栃木県">栃木県</option>
                <option value="群馬県">群馬県</option>
                <option value="埼玉県">埼玉県</option>
                <option value="千葉県">千葉県</option>
                <option value="東京都">東京都</option>
                <option value="神奈川県">神奈川県</option>
                <option value="新潟県">新潟県</option>
                <option value="富山県">富山県</option>
                <option value="石川県">石川県</option>
                <option value="福井県">福井県</option>
                <option value="山梨県">山梨県</option>
                <option value="長野県">長野県</option>
                <option value="岐阜県">岐阜県</option>
                <option value="静岡県">静岡県</option>
                <option value="愛知県">愛知県</option>
                <option value="三重県">三重県</option>
                <option value="滋賀県">滋賀県</option>
                <option value="京都府">京都府</option>
                <option value="大阪府">大阪府</option>
                <option value="兵庫県">兵庫県</option>
                <option value="奈良県">奈良県</option>
                <option value="和歌山県">和歌山県</option>
                <option value="鳥取県">鳥取県</option>
                <option value="島根県">島根県</option>
                <option value="岡山県">岡山県</option>
                <option value="広島県">広島県</option>
                <option value="山口県">山口県</option>
                <option value="徳島県">徳島県</option>
                <option value="香川県">香川県</option>
                <option value="愛媛県">愛媛県</option>
                <option value="高知県">高知県</option>
                <option value="福岡県">福岡県</option>
                <option value="佐賀県">佐賀県</option>
                <option value="長崎県">長崎県</option>
                <option value="熊本県">熊本県</option>
                <option value="大分県">大分県</option>
                <option value="宮崎県">宮崎県</option>
                <option value="鹿児島県">鹿児島県</option>
                <option value="沖縄県">沖縄県</option>
            </select>
            市区町村
            <input type="text" name="address" placeholder="札幌市中央区" value="">
            <input type="hidden" name="search_method" value="address">
            <input type="submit" value="検索">
        </form>
        <?php 
            if(!empty($pref_address_error_messages)) {
                echo '<p style="color:red">' . $pref_address_error_messages . '</p>';
            }
        ?>
    </section>
    <section class="search_reslut">
        <?php 
        if (!empty($result_count)) {
            echo '<p>検索結果' . $result_count['count'] . '件</p>';        
        } else {
            echo '<p>ここに検索結果が表示されます</p>';
        }
        ?>
        <table>
            <tr>
                <th>郵便番号</th>
                <th>都道府県</th>
                <th>住所1</th>
                <th>住所2</th>
            </tr>
            
            <?php
            if (!empty($result_list)) {
                foreach ($result_list as $value) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($value['zipcode'], ENT_QUOTES, 'UTF-8') . '</td>';
                    echo '<td>' . htmlspecialchars($value['pref'], ENT_QUOTES, 'UTF-8') . '</td>';
                    echo '<td>' . htmlspecialchars($value['address1'], ENT_QUOTES, 'UTF-8') . '</td>';
                    echo '<td>' . htmlspecialchars($value['address2'], ENT_QUOTES, 'UTF-8') . '</td>';
                    echo '</tr>';
                }
            } else {
                echo "検索結果がありません。";
            }
            ?>
        </table>

        <!-- ページ切り替え -->
        <?php
        if ($page > 1) {
            // ▼MAMP
            echo '<a href="?pref=' . ($pref) . '&address=' . ($address) . '&search_method=' . ($search_method) . '&page=' . ($page-1) . '">前へ</a>';
            // ▼XAMPP
            // echo '<a href="?pref=' . ($pref) . '&address=' . ($address) . '&search_method=' . ($search_method) . '&page=' . ($page-1) . '">前へ</a>';
        }
        if (count($result_list) == $itemsPerPage) {
            // ▼MAMP
            echo '<a href="?pref=' . ($pref) . '&address=' . ($address) . '&search_method=' . ($search_method) . '&page=' . ($page+1) . '">次へ</a>';
            // ▼XAMPP
            // echo '<a href="?pref=' . ($pref) . '&address=' . ($address) . '&search_method=' . ($search_method) . '&page=' . ($page+1) . '">次へ</a>';
        }
        ?>
    </section>
</body>
</html>

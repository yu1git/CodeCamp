<?php
/**
* トランザクション処理を理解するためのサンプルプログラムです。
* あくまで理解を助けるためのプログラムなので、トランザクション関連以外の処理はかなり省いています。
*/
// MySQL接続情報

// XAMPP
// $host = 'localhost';
// $user = 'root';
// $passwd   = '';
// $dbname   = 'codecamp';

// MAMP
$host = 'localhost';
$user = 'root';
$passwd   = 'root';
$dbname   = 'codecamp';

$customer_id = 1;          // 例題のため顧客は1に固定
$payment = 'クレジット'; // 例題のため購入方法はクレジットに固定する
$quantity = 1;          // 例題のため数量は1に固定
$goods_list  = [];
$err_msg = [];

// コネクション取得
if ($link = mysqli_connect($host, $user, $passwd, $dbname)) {
 
   // 文字コードセット
   mysqli_set_charset($link, 'UTF8');
   // 購入処理
   if( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
       // 現在時刻を取得
       $date = date('Y-m-d H:i:s');
       // 商品IDを取得
       $goods_id = (int) $_POST['goods_id'];
       // 更新系の処理を行う前にトランザクション開始(オートコミットをオフ）
       mysqli_autocommit($link, false);
        /**
         * mysqli_autocommit($link, $mode);
         * 
         * $link  リンクID
         * $mode  自動コミットを有効にするか
         * 
         * 機能
         *   クエリの自動コミットモードをオンまたはオフにする。
         * 　　　　デフォルトではクエリを実行した際に自動で処理確定（コミット）する。
         * 　　　　自動コミットをオフにすることでトランザクション開始となり、明示的にコミットを行うまでクエリを実行しても処理が確定しない。
         * 　　　　自動コミットをオフにしたあと、明示的にコミットせず接続を閉じるとデータベースに反映されない
         * 返り値
         *   成功した場合TRUEを返す
         *   失敗した場合FALSEを返す
        　　*/

       /**
        * 発注情報を挿入
        */
       // 挿入情報をまとめる
       $data = [
           'customer_id' => $customer_id,
           'order_date'  => $date,
           'payment' => $payment
       ];
       // insertのSQL
       $sql = 'INSERT INTO order_table (customer_id, order_date, payment) VALUES(\'' . implode('\',\'', $data) . '\')';
       // insertを実行する
       if (mysqli_query($link, $sql) === TRUE) {
 
           // A_Iを取得
           $order_id = mysqli_insert_id($link);
           /**
            * 発注詳細情報を挿入
            */
           // 挿入情報をまとめる
           $data = [
               'order_id' => $order_id,
               'goods_id' => $goods_id,
               'quantity' => $quantity
           ];
           // 注文詳細情報をinsertする
           $sql = 'INSERT INTO order_detail_table (order_id, goods_id, quantity) VALUES(\'' . implode('\',\'', $data) . '\')';
           // insertを実行する
           if (mysqli_query($link, $sql) !== TRUE) {
               $err_msg[] = 'order_detail_table: insertエラー:' . $sql;
           }
       } else {
           $err_msg[] = 'order_table: insertエラー:' . $sql;
       }
       // トランザクション成否判定
       if (count($err_msg) === 0) {
           // 処理確定
           mysqli_commit($link);
            /**
             * mysqli_commit($link);
             * 
             * $link 
             *   リンクID
             * 
             * 機能  
             *   トランザクションをコミットする。
             * 返り値  
             *   成功した場合TRUEを返す  
             *   失敗した場合FALSEを返す
             */
       } else {
           // 処理取消
           mysqli_rollback($link);
            /**
             * mysqli_rollback($link);
             * 
             * $link 
             *   リンクID
             * 
             * 機能  
             *   トランザクションを処理取り消し（ロールバック）する。
             * 返り値  
             *   成功した場合TRUEを返す  
             *   失敗した場合FALSEを返す
             */
       }
   }
   /**
    * 商品情報を取得
    */
   // SQL
   $sql = 'SELECT goods_id, goods_name, price FROM goods_table';
   // クエリ実行
   if ($result = mysqli_query($link, $sql)) {
       $i = 0;
       while ($row = mysqli_fetch_assoc($result)) {
           $goods_list[$i]['goods_id']   = htmlspecialchars($row['goods_id'],   ENT_QUOTES, 'UTF-8');
           $goods_list[$i]['goods_name'] = htmlspecialchars($row['goods_name'], ENT_QUOTES, 'UTF-8');
           $goods_list[$i]['price']   = htmlspecialchars($row['price'],   ENT_QUOTES, 'UTF-8');
           $i++;
       }
   } else {
       $err_msg[] = 'SQL失敗:' . $sql;
   }
   mysqli_free_result($result);
   mysqli_close($link);
} else {
   $err_msg[] = 'error: ' . mysqli_connect_error();
}
//var_dump($err_msg); // エラーの確認が必要ならばコメントを外す
?>
<!DOCTYPE HTML>
<html lang="ja">
<head>
   <meta charset="UTF-8">
   <title>トランザクションサンプル</title>
</head>
<body>
   <section>
       <h1>商品購入</h1>
       <ul>
<?php foreach ($goods_list as $goods) { ?>
           <li>
               <span><?php print $goods['goods_name']; ?></span>
               <span><?php print $goods['price']; ?>円</span>
               <form method="post">
                   <input type="hidden" name="goods_id" value="<?php print $goods['goods_id']; ?>">
                   <input type="submit" value="購入する">
               </form>
           </li>
<?php } ?>
       </ul>
       <p>※サンプルのため購入は1商品 & 1個に固定</p>
   </section>
</body>
</html>
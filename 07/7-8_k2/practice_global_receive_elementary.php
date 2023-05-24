<?php
// 受信ファイル

// 初期化
$my_name = '';

if ( isset( $_POST['my_name'] ) === TRUE ) {
    $my_name = htmlspecialchars($_POST['my_name'], ENT_QUOTES, 'UTF-8');
    
    // 全角スペースを半角に変換（trimでは全角スペースを削除しないため）
    $my_name = mb_convert_kana($my_name, "s", 'UTF-8');

    //空白を取り除く（入力内容がスペースのみの場合は未入力として扱うため）
    $my_name = trim($my_name);
}

// 質問：$my_name !== ''　と　empty($my_name)　とはどう違うのか？　どちらが適切なのか？
// $my_name !== ''　空欄のみを判定
// mb_strlen　文字数を数えて0なら　関数　
// empty($my_name)　https://www.php.net/manual/ja/function.empty.php　で1～8全てをtrue　0などの数字なども。
// if( isset( $my_name ) === TRUE && $my_name !== '' ) {
if( isset( $my_name ) === TRUE && !empty($my_name) ) {
    print 'ようこそ' . $my_name . 'さん';
 } else {
    print '名前を入力してください';
 }
?>
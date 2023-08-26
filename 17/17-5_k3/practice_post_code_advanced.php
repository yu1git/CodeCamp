<?php
// 初期化
$zipcode = '';

$error_messages = '';

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

if ( isset( $_POST['zipcode'] ) === TRUE ) {
    $zipcode = htmlspecialchars($_POST['zipcode'], ENT_QUOTES, 'UTF-8');
}

if( isset( $zipcode ) === TRUE && !empty( $zipcode ) ) {
    
 } else {
    
 }
?>
<?php
/* データベースの秘密情報 */
$db_user = "junnii_portfolio";  // ユーザ名
$db_pass = "junnii0619";   // パスワード
//$db_host = "mysql8042.xserver.jp";   // ホスト名
$db_host = "localhost";   // ホスト名
$db_name = "junnii_bbs";  // データベース名
$db_type = "mysql";       // データベースの種類
?>

<?php

/* DSN組み立て */
$dsn = "$db_type:host=$db_host;dbname=$db_name;charset=utf8";

/* データベース接続 */
try{
  /* データベース接続 */
  $pdo = new PDO($dsn, $db_user, $db_pass);
  /* エラーモード設定 */
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
}catch(PDOException $Exception){
  /* エラーメッセージ */
  die('接続エラー:'.$Exception->getMessage());
}
?>

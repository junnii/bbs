<?php
// データベースに接続
function connectDB() {
  /* データベースの秘密情報 */
  $db_user = "junnii_portfolio";  // ユーザ名
  $db_pass = "junnii0619";   // パスワード
  //$db_host = "mysql8042.xserver.jp";   // リモートホスト名
  db_host = "localhost";   // ローカルホスト名
  $db_name = "junnii_bbs";  // データベース名
  $db_type = "mysql";       // データベースの種類

  /* DSN組み立て */
  $dsn = "$db_type:host=$db_host;dbname=$db_name;charset=utf8";

  try {
      $pdo = new PDO($dsn, $db_user, $db_pass);
      return $pdo;

  } catch (PDOException $e) {
      echo $e->getMessage();
      exit();
  }
}

// XSS対策のためのHTMLエスケープ
function es($data, $charset='UTF-8'){
  // $dataが配列のとき
  if (is_array($data)){
    // 再帰呼び出し
    return array_map(__METHOD__, $data);
  } else {
    // HTMLエスケープを行う
    return htmlspecialchars($data, ENT_QUOTES, $charset);
  }
}

// 配列の文字エンコードのチェックを行う
function cken(array $data){
  $result = true;
  foreach ($data as $key => $value) {
    if (is_array($value)){
      // 含まれている値が配列のとき文字列に連結する
      $value = implode("", $value);
    }
    if (!mb_check_encoding($value)){
      // 文字エンコードが一致しないとき
      $result = false;
      // foreachでの走査をブレイクする
      break;
    }
  }
  return $result;
}
?>

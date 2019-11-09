<?php
/* ユーザ関数 */
require 'lib/util.php';

// 文字エンコードの検証
if (!cken($_POST)){
  $encoding = mb_internal_encoding();
  $err = "Encoding Error! The expected encoding is " . $encoding ;
  // エラーメッセージを出して、以下のコードをすべてキャンセルする
  exit($err);
}
// HTMLエスケープ（XSS対策）
$_POST = es($_POST);

// form.phpから送信されてきた場合
if(isset($_POST["name"], $_POST["content"])){

  //名前が空のとき
  if($_POST["name"] == ''){
    $isName = false;
  }else{
    $isName = true;
  }

  // 内容が空のとき
  if($_POST["content"] == ''){
    $isContent = false;
  }else{
    $isContent = true;
  }
}
?>

<?php
// データベースに追加する
if(isset($isName, $isContent)){
  if($isName && $isContent){

    try{
      // トランザクション開始
      $pdo->beginTransaction();
      // SQL文を発行
      $sql = "INSERT INTO thread1 (name, content) VALUES (:_name, :_content)";
      // ステートメントハンドラを取得
      $stmh = $pdo->prepare($sql);
      // 値を結びつける
      $stmh->bindValue(":_name", $_POST["name"], PDO::PARAM_STR);
      $stmh->bindValue(":_content", $_POST["content"], PDO::PARAM_STR);
      // 実行
      $stmh->execute();
      // トランザクション終了
      $pdo->commit();

    }catch(PDOException $Exception){
      $pdo->rollBack;
      print "エラー".$Exception->getMessage();
    }
  }
}
?>

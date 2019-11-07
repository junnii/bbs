<?php

/* ステートメントハンドラを取得 */
try{
  // トランザクション開始
  $pdo->beginTransaction();
  // SQL文を発行
  $sql = "SELECT * FROM thread1";
  // ステートメントハンドラを取得
  $stmh = $pdo->prepare($sql);
  // 実行
  $stmh->execute();
  // 書き込み件数を取得
  $count = $stmh->rowCount();
  // トランザクション終了
  $pdo->commit();

}catch(PDOException $Exception){
  print "エラー：".$Exception->getMessage();
}

/* 書き込み件数を表示 */
if($count == 0){
  // 書き込みがないとき
  print "書き込みがありません。<br>";
}else{
  // 書き込み件数を表示
  print "書き込み件数は".$count."件です。<br><br><br>";
}
?>

<?php
/* 書き込みを表示する */
while($row = $stmh->fetch(PDO::FETCH_ASSOC)){
?>

変更履歴
2019/11/7 文中にURLがあったらハイパーリンクにする
2019/11/7　文中に改行コードがあったらbrタグに変換する

番号：<?php print $row['number']; ?><br>
名前：<?php print $row['name']; ?><br>
時間：<?php print $row['time']; ?><br>
内容：<?php 

  // URLが１行で投稿されたらハイパーリンクにする（target="_blank"）
  // explode()で改行コードを区切りとして分解して配列に入れる
  $ary = explode(PHP_EOL, $row['content']);
  //配列にいくつ要素があるか
  $countary = count($ary);
  // デバック用
  //print_r($ary);
  //print_r($countary);
  
  // 一行投稿か
  if ($countary == 1) {
    // URL
    if( filter_var($ary[0], FILTER_VALIDATE_URL)){
      // URLが"正しい"場合の処理
      // ハイパーリンクにする
      //print "<a href='" . $row["content"] . "' target=_blank>" . $row["content"] . "</a>";
      //改行を<br>に変換
      $pattern = '/((?:https?|ftp):\/\/[-_.!~*\'()a-zA-Z0-9;\/?:@&=+$,%#]+)/';
      $replace = '<a href="$1" target=_blank>$1</a>';
      print  nl2br(preg_replace( $pattern, $replace, $row["content"]) );
    
    }else{
      // 1行かつURLでは無い場合の処理
      $pattern = '/((?:https?|ftp):\/\/[-_.!~*\'()a-zA-Z0-9;\/?:@&=+$,%#]+)/';
      $replace = '<a href="$1" target=_blank>$1</a>';
      print  nl2br(preg_replace( $pattern, $replace, $row["content"]) );
    }
  }else{
    $pattern = '/((?:https?|ftp):\/\/[-_.!~*\'()a-zA-Z0-9;\/?:@&=+$,%#]+)/';
    $replace = '<a href="$1" target=_blank>$1</a>';
    print  nl2br(preg_replace( $pattern, $replace, $row["content"]) );
  }
?>

<br>
<br>

<?php
}
?>

<?php
// $isNameと$isContentが存在するとき
if(isset($isName, $isContent)){

  // 名前が空のとき
  if(!$isName){
    print '名前が入力されていません。<br>';
  }

  // 内容が空のとき
  if(!$isContent){
    print '内容が入力されていません。<br><br>';
  }
}
?>

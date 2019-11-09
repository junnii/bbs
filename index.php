<!DOCTYPE html>
<html>
<head>
  <title>掲示板</title>
  <style>
  body {
    text-align: left;
    font-family: Arial, sans-serif;
  }
  </style>

</head>
<body>

  <?php /* DB情報 */ ?>
  <?php require 'init.php' ?>

  <?php /* 書き込み追加 */ ?>
  <?php require 'add.php' ?>

更新履歴<br>
2019/11/7 文中にURLがあったらハイパーリンクにする<br>
2019/11/7 文中に改行コードがあったらbrタグに変換する<br>
2019/11/9 XSS対策
<br><br>
  <!-- 書き込み一覧 -->
  <?php require 'view.php'; ?>

  <!-- 投稿フォーム -->
  <?php require 'form.php' ?>

</body>
</html>
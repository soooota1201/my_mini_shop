<?php
function sanitize($post)
{
  foreach($post as $key => $value) { //foreach文にはいくつか使用法があり、この例は配列にキーがある時の使い方
    $sanitized_post[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
  }
  return $sanitized_post;
}

//データベースに接続するための関数
function connectDB()
{
  $dsn = 'mysql:dbname=myshop; host=localhost; charset=utf8';
  $user = 'root';
  $password = 'root';
  $dbh = new PDO($dsn, $user, $password); //引数に指定している内容でデータベースに接続
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  return $dbh;
}
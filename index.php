<?php
//全てのプロジェクトはまずindex.phpにアクセスされる

require_once('common/common.php');

//DB接続時は例外処理を必ず入れる
try 
{
  //データベース接続
  $dbh = connectDB();

  //データを取り出す
  $sql = 'select id, name, price from product where 1'; //1は全てを表す。ここでは全てのレコードを取得する。
  $stmt = $dbh->prepare($sql); //stmt = statement
  $stmt->execute();

  //データベースとの接続を切る
  $dbh = null;

  echo '・商品一覧<br>';
  
  while(true) {
    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    if($rec === false) { //レコードがなくなればループを終了する
      break;
    }
    echo <<<EOD
    <a href="shop/shop_product.php?pro_code=$rec[id]">
      $rec[name]: $re[price]円
    </a><br>
EOD;
  }

  echo '<a href="shop/shop_cartlook.php">カート詳細へ</a><br>';
  echo '<a href="staff/staff_login.php">ログインする</a><br>';

}
catch(Exception $e)
{
  echo '何かしらのエラーが発生しています';
  echo $e->getMessage();
  exit();
}
<?php
//1.  DB接続します
try {
    //localhostの場合
    $db_name = "gs_db_kadai02";    //データベース名
    $db_id   = "root";      //アカウント名
    $db_pw   = "";          //パスワード：XAMPPはパスワード無しに修正してください。
    $db_host = "localhost"; //DBホスト

    //localhost以外＊＊自分で書き直してください！！＊＊
    if($_SERVER["HTTP_HOST"] != 'localhost'){
        $db_name = "jas-mine_gs_db_kadai02";  //データベース名
        $db_id   = "jas-mine";  //アカウント名（さくらコントロールパネルに表示されています）
        $db_pw   = "Myan2022";  //パスワード(さくらサーバー最初にDB作成する際に設定したパスワード)
        $db_host = "mysql57.jas-mine.sakura.ne.jp"; //例）mysql**db.ne.jp...
    }
    $pdo = new PDO('mysql:dbname='.$db_name.';charset=utf8;host='.$db_host, $db_id, $db_pw);
} catch (PDOException $e) {
    exit('DB Connection Error:'.$e->getMessage());
}

// try {
//   Password:MAMP='root',XAMPP=''
//   $pdo = new PDO('mysql:dbname=jas-mine_gs_db_kadai02;charset=utf8;host=mysql57.jas-mine_gs_db_kadai02','jas-mine','Myan2022');
// } catch (PDOException $e) {
//   exit('DBConnection Error:'.$e->getMessage());
// }
// try {
//   Password:MAMP='root',XAMPP='';
//   $pdo = new PDO('mysql:dbname=jas-mine_gs_db_kadai02;charset=utf8;host=mysql57.jas-mine_gs_db_kadai02','jas-mine','Myan2022');
//   //$pdo = new PDO('mysql:dbname=gs_db_kadai02;charset=utf8;host=localhost','root','');
// } catch (PDOException $e) {
//   exit('DBConnection Error:'.$e->getMessage());
// }


//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table");
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("SQL_ERROR:".$error[2]);

}else{
  $view="<table border=1>";
  $view.="<tr><th>ID</th><th>書籍名</th><th>URL</th><th>コメント</th><th>登録日時</th></tr>";

  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  while( $res = $stmt->fetch(PDO::FETCH_ASSOC)){
    $view .= "<tr>";
    $view .= "<td>".$res["BookID"]."</td><td>".$res["BookName"]."</td><td>".$res["BookURL"]."</td><td>".$res["Cpmment"]."</td><td>".$res["BookmarkDate"]."</td>";
    $view .= "</tr>";
  }
  $view .= "</table>";
}
?>  


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>書籍一覧</title>
<link rel="stylesheet" href="css/range.css">
<style>
  body{
          background: url("main_image01.jpg");
          background-repeat: no-repeat;
          background-size: 50%;
          background-position: center top;
          background-color: rgb(245, 238, 198);
  
  }
div{padding: 10px;font-size:16px;}
</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <h2 class="navbar-brand">書籍一覧</h2>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
  <div class="container jumbotron">
    <?php 
    print $view?>

  </div>
</div>

<a href='index.php'>戻る</a>
<!-- Main[End] -->

</body>
</html>

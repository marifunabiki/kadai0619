<?php
//1. POSTデータ取得
//$name = filter_input( INPUT_GET, ","name" ); //こういうのもあるよ
//$email = filter_input( INPUT_POST, "email" ); //こういうのもあるよ
$name = $_POST['name'];
$url = $_POST['url'];
$comment = $_POST['comment'];

//2. DB接続します
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
//   //Password:MAMP='root',XAMPP=''
//   $pdo = new PDO('mysql:dbname=jas-mine_gs_db_kadai02;charset=utf8;host=mysql57.jas-mine_gs_db_kadai02','jas-mine','Myan2022');
// } catch (PDOException $e) {
//   exit('DBConnection Error:'.$e->getMessage());
// }
//３．データ登録SQL作成
$stmt = $pdo->prepare("insert into gs_bm_table(BookName, BookURL, Cpmment, BookmarkDate) values(:name, :url, :comment, sysdate())");
$stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':url', $url, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();
//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("SQL_ERROR:".$error[2]);
}else{
  //５．index.phpへリダイレクト
  header("Location: index.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ登録</title>
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
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="select.php">書籍一覧</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="insert.php">
  <div class="jumbotron row justify-content-end">
   <fieldset>
    <legend>ブック</legend>
    <table>
    <tr><td><label>書籍名：</td><td><input type="text" name="name"></label></td></tr>
    <tr><td> <label>書籍URL：</td><td><input type="text" name="url"></label></td></tr>
    <tr><td><label>書籍コメント：</td><td><input type="text" name="comment"></label></td></tr>
    <tr><td></td><td class="text_center"> <input type="submit" value="送信"></td></tr>
    </table>
    </fieldset>
  </div>
</form>

<!-- Main[End] -->


</body>
</html>

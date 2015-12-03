<html>
  <head>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
    <title>My FB2Reader Example</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <script src="jquery.js"></script>
  </head>
  <body>
<?
if(isset($_GET['action'])){
  if($_GET['action']=='author_act'){

  }elseif($_GET['action']=='regist_form'){
    echo '
      <form method="POST" action="?action=regist_act">
        <table>
          <tr><td colspan="2">Реєстрація</td></tr>
          <tr><td>Логін</td><td><input type="text" name="login"></td></tr>
          <tr><td>Пароль</td><td><input type="password" name="pass"></td></tr>
          <tr><td colspan="2"><input type="submit" value="Зареєструватись"></td></tr>
        </table>
      </form>
      ';
  }elseif($_GET['action']=='regist_act'){

  }
}else{
  if(!isset($_COOKIE['id'])){
    echo '
      <form method="POST" action="?action=author_act">
        <table>
          <tr><td colspan="2">Авторизація</td></tr>
          <tr><td>Логін</td><td><input type="text" name="login"></td></tr>
          <tr><td>Пароль</td><td><input type="password" name="pass"></td></tr>
          <tr><td colspan="2"><input type="submit" value="Увійти"></td></tr>
          <tr><td colspan="2"><a href="?action=regist_form">Реєстрація</a></td></tr>
        </table>
      </form>
      ';
  }else{
    echo '
      <input type="file" name="book" id="file"/>
      <script src="fb2.js"></script>
      <div class="page">
        <img id="fullcover" src="">
      </div>
      <div class="page">
        <h2 id="author"></h2>
        <h1 id="title"></h1>
        <h2 id="genre"></h2>
        <div id="annotation"></div>
        <div id="epigraph"></div>
        <h4 id="year"></h4>
      </div>
      ';
  }
}
?>
  </body>
</html>

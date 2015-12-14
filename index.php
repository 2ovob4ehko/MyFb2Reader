<?
include ('con_db.php');
include ('models/users_model.php');
include ('models/reading_model.php');
$users = new Users($con);
$reading = new Reading($con);
function base_url(){
  	return 'http://'.$_SERVER['HTTP_HOST'].parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
}
?>
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
    $valid=$users->checkPass(strip_tags($_POST['login']),strip_tags($_POST['pass']));
      if($valid){
        setcookie('id',$valid,time()+60*60*24*365);
        header('Location: '.base_url());
      }else{
        header('Location: '.base_url().'?error=Не вірно введений логін чи пароль');
      }
  }elseif($_GET['action']=='regist_form'){
    include ('views/regist_view.php');
  }elseif($_GET['action']=='regist_act'){
    $result=$users->getByLogin(strip_tags($_POST['login']));
    if($result->num_rows==0){
      $users->create(strip_tags($_POST['login']),strip_tags($_POST['pass']));
      header('Location: '.base_url());
    }else{
      header('Location: '.base_url().'?action=regist_form&error=Такий логін вже використовується');
    }
  }elseif($_GET['action']=='save'){
    ini_set('display_errors', '1');
    $rId = $reading->getByInf(urldecode($_GET['title']),urldecode($_GET['author']),$_COOKIE['id']);
    if($rId->num_rows>0){
      $rUp = $reading->update($rId->fetch_object()->id,$_GET['line']);
    }else{
      $qIns = $reading->create(urldecode($_GET['title']),urldecode($_GET['author']),$_COOKIE['id'],$_GET['line']);
    }
  }elseif($_GET['action']=='line'){
    ob_get_clean();
    $rId = $reading->getByInf(urldecode($_GET['title']),urldecode($_GET['author']),$_COOKIE['id']);
    if($rId->num_rows>0){
      echo $rId->fetch_object()->line;
    }else{
      echo '0';
    }
    exit;
  }
}else{
  if(!isset($_COOKIE['id'])){
    include ('views/author_view.php');
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

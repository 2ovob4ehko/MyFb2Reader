<?
include ('fb2.php');
$books=[];
array_push($books,'http://fs.to/get/dl/5s6pwdpwi9vb8fwi7z5dhjmae.0.1139013157.1867975165.1448303648/Payper_Demonolog.416407.fb2');
array_push($books,'http://fs.to/get/dl/5s6pwdpwia7m644qjuozxxcyu.0.1139013157.1867975165.1448304270/%D0%9A%D0%B0%D0%BB%D0%BB%D0%B5%D0%BD.+%D0%90%D1%80%D0%B5%D0%BD%D0%B0.fb2');
array_push($books,'Каллен. Арена.fb2');
/*
$publishInfo=$book->getPublishInfo();
$sections=$book->getSections();
*/
?>
<html>
  <head>
    <title>My FB2Reader Example</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <?if(!isset($_GET['book'])){
      foreach ($books as $b){
        $book=new Fb2($b);
      echo '<div>
        <table>
          <tr>
            <td><img class="tumb" src="'.$book->getCoverImage().'"></td>
          </tr>
        </table>
      </div>';
    }
  }else{
    $book=new Fb2($books[$_GET['book']]);
    echo'<div class="page">
      <img id="fullcover" src="'.$book->getCoverImage().'">
    </div>';
    $bookInfo=$book->getBookInfo();
    echo'<div class="page">
      <h2>'.$bookInfo->author.'</h2>
      <h1>'.$bookInfo->title.'</h1>';
      if($bookInfo->genre!=''){echo'<h2>('.$bookInfo->genre.')</h2>';}
    echo $bookInfo->annotation.'<h4>'.$bookInfo->year.'</h4></div>';
  }
    ?>
  </body>
</html>

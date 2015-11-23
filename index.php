<?
include ('fb2.php');
$book= new Fb2();
$book->setBookFile('Арена.fb2');
try {
  $bookInfo=$book->getInfo();
} catch(Exception $e){
  echo $e->getMessage();
}
?>
<html>
  <head>
    <title>My FB2Reader Example</title>
    <meta charset="utf-8">
  </head>
  <body>
    <?
    print_r($bookInfo);
    ?>
  </body>
</html>

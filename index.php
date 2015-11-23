<?
include ('fb2.php');
$book= new Fb2('Продавец.времени.fb2'); //Арена.fb2 Продавец.времени.fb2
$bookInfo=$book->getBookInfo();
$publishInfo=$book->getPublishInfo();
$firstTitle=$book->getFirstTitle();
$sections=$book->getSections();
$coverImage=$book->getCoverImage();
?>
<html>
  <head>
    <title>My FB2Reader Example</title>
    <meta charset="utf-8">
    <style>
      emphasis{
        display:block;
        border:1px solid red;
        padding:10px;
        margin: 10px 20px;
      }
    </style>
  </head>
  <body>
    <img src="<? echo $coverImage?>">
  </body>
</html>

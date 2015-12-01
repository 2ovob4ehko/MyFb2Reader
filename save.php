<?php
ini_set('display_errors', '1');
include ('con_db.php');
$cookieLoginId=1;
$sqlId = "SELECT * FROM `reading` WHERE title='".urldecode($_GET['title'])."' AND author='".urldecode($_GET['author'])."' AND user='".$cookieLoginId."'";
$qId = mysqli_query($conn, $sqlId) or die(mysqli_error($conn));
if($qId->num_rows>0){
  $sqlUp = "UPDATE `reading` SET line='".$_GET['line']."' WHERE id='".mysqli_fetch_assoc($qId)['id']."'";
  $qUp = mysqli_query($conn, $sqlUp) or die(mysqli_error($conn));
}else{
  $sqlIns = "INSERT INTO `reading` (title,author,user,line) VALUES ('".urldecode($_GET['title'])."','".urldecode($_GET['author'])."',".$cookieLoginId.",".$_GET['line'].")";
  $qIns = mysqli_query($conn, $sqlIns) or die(mysqli_error($conn));
}
?>

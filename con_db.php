<?php
$conn = mysqli_connect("localhost", "root", "ghj", "myfb2");
if(mysqli_connect_errno()){
  echo "Failed to connect to MySQL: ".mysqli_connect_error();
}
mysqli_query($conn,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
?>

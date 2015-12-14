<?php
$mysql_host="localhost";
$mysql_user="root";
$mysql_pass="ghj";
$mysql_db="myfb2";
$con = new mysqli($mysql_host,$mysql_user,$mysql_pass);
if(mysqli_connect_errno()){
  echo "Failed to connect to MySQL: ".mysqli_connect_error();
}
$con->select_db($mysql_db);
$con->query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
?>

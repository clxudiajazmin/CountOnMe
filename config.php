<?php
$host = "localhost";
$dbuser = "root";
$dbpwd = "";
$db = "count_on_me";

$connect = new mysqli($host, $dbuser, $dbpwd, $db);
	if($connect->connect_errno){
        die("La conexión ha fallado");
    }
?>


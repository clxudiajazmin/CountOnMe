<?php
$host = "sql104.epizy.com";
$dbuser = "epiz_27713045";
$dbpwd = "0wNYxr339ROC5sX";
$db = "epiz_27713045_count_on_me";

$connect = new mysqli($host, $dbuser, $dbpwd, $db);
	if($connect->connect_errno){
        die("La conexión ha fallado");
    }
?>


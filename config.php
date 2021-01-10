<?php
$con = mysqli_connect("localhost", "root", "", "count_on_me");

if(mysqli_connect_error()){
    echo "Failed to connect to MySql: ". mysqli_connect_error();
    die();
}
$error="";
?>


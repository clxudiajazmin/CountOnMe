<?php
session_start();
if(!isset($_SESSION["username"])){
    header("Location: registro.php");
    exit();
}
?>
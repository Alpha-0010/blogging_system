<?php require 'sessions.php';?>
<?php require 'functions.php';?>
<?php  
$_SESSION["userid"]=null;
session_destroy();
redirect_to("login.php");
?>
<?php 
session_start();
function message(){
if(isset($_SESSION["ErrorMessage"])){
	$output="<div class=\"alert alert-danger\">";
	$output.=htmlentities($_SESSION["ErrorMessage"]);
	$output.="</div>";
	$_SESSION["ErrorMessage"]=null;
	return $output;
}
}
function successmessage(){
if(isset($_SESSION["SuccessMessage"])){
	$output="<div class=\"alert alert-success\">";
	$output.=htmlentities($_SESSION["SuccessMessage"]);
	$output.="</div>";
	$_SESSION["SuccessMessage"]=null;
	return $output;
}
}
?>
<?php require 'connection.php';?>
<?php require 'sessions.php';?>
<?php require 'functions.php';?>
<?php 
if(isset($_GET['id'])){
	$idfromurl=$_GET['id'];
	$selected;
	$Query="DELETE registration WHERE id='$idfromurl'";
	 $EXECUTE=mysqli_query($Connection,$Query);
  if($EXECUTE){
    $_SESSION["SuccessMessage"]="Admin Deleted successfully";
  redirect_to("admins.php");
  }else{
    $_SESSION["ErrorMessage"]="Something went wrong try again!!!";
  redirect_to("admins.php");
  }
}
?>
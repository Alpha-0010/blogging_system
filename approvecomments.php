<?php require 'connection.php';?>
<?php require 'sessions.php';?>
<?php require 'functions.php';?>
<?php 
if(isset($_GET['id']))
{
	$idfromurl=$_GET['id'];
	$selected;
	$Query="UPDATE comments SET status='ON' WHERE id='$idfromurl'";
	 $EXECUTE=mysqli_query($Connection,$Query);
  if($EXECUTE){
    $_SESSION["SuccessMessage"]="Comment Approved successfully";
  redirect_to("comments.php");
  }else{
    $_SESSION["ErrorMessage"]="Something went wrong try again!!!";
  redirect_to("comments.php");
  }
}
?>
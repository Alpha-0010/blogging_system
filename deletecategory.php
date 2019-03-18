<?php require 'connection.php';?>
<?php require 'sessions.php';?>
<?php require 'functions.php';?>
<?php 
if(isset($_GET['id'])){
	$idfromurl=$_GET['id'];
	$selected;
	$Query="DELETE FROM category WHERE id='$idfromurl'";
	 $EXECUTE=mysqli_query($Connection,$Query);
  if($EXECUTE){
    $_SESSION["SuccessMessage"]="Category Deleted successfully";
  redirect_to("categories.php");
  }else{
    $_SESSION["ErrorMessage"]="Something went wrong try again!!!";
  redirect_to("categories.php");
  }
}
?>
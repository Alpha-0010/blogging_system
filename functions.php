<?php 
function redirect_to($New_Location){
 header("Location:".$New_Location);
 exit;
}
function login_attempt($username,$password){
	$selected;
  $Query="SELECT * FROM registration WHERE username='$username' AND password='$password'";
  $EXECUTE=mysqli_query($Connection,$Query);
  if($admin=mysqli_fetch_assoc($EXECUTE)){
  	return $admin;
  }else{
    return null;
  }
}
function login(){
	if(isset($_SESSION["userid"])){
		return true;
	}
}
function confirm_login(){
	if(!login()){
		$_SESSION["ErrorMessage"]="Login required!!";
		redirect_to("login.php");
	}
}
?>
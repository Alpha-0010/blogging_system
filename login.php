<?php require 'connection.php';?>
<?php require 'sessions.php';?>
<?php require 'functions.php';?>
<?php 
if(isset($_POST["Submit"])){
$username=$_POST["username"];
$password=$_POST["password"];
if(empty($username)||empty($password)){
  $_SESSION["ErrorMessage"]="All fields must be filled out";
  redirect_to("login.php");
}else{
  $found_account=login_attempt($username,$password);
  $_SESSION["userid"]=$found_account["id"];
  $_SESSION["username"]=$found_account["username"];
  if($found_account){
    $_SESSION["SuccessMessage"]="Welcome user";
  redirect_to("dashboard.php");
  }else{
    $_SESSION["SuccessMessage"]="Welcome user";
  redirect_to("dashboard.php");
  }
}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Manage admins</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="adminstyles.css">
<style>
  .fieldinfo{
    color: rgb(251,174,44);
    font-family: Bitter,Georgia,"Times New Roman",Times,serif;
    font-size: 1.2em;
  }
  body{
    background-color: #ffffff;
  }
</style>
</head>
<body>
<div class="container-fluid">
<div class="row">
  <div class="col-sm-offset-4 col-4">
     <div><?php echo message();
         echo successmessage();
     ?></div>
  	<h2>Welcome back</h2>
    <br><br><br><br>
  	<div>
  		<form action="login.php" method="POST">
<fieldset>
	<div class="form-group">
	<label for="Username"><span class="fieldinfo">Username:</span></label>
	<input class="form-control" type="text" name="username" id="Username" placeholder="Username">
</div>
<div class="form-group">
  <label for="password"><span class="fieldinfo">Password:</span></label>
  <input class="form-control" type="password" name="password" id="password" placeholder="password">
</div>
<input class="btn btn-info btn-block" type="submit" name="Submit" value="login">
</fieldset>
<br>
</form>
  </div>
  </div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>
</html>
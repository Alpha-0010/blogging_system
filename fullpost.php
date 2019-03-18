<?php require 'connection.php';?>
<?php require 'sessions.php';?>
<?php require 'functions.php';?>
<?php 
if(isset($_POST["Submit"])){
$name=$_POST["name"];
$email=$_POST["email"];
$comment=$_POST["comment"];
date_default_timezone_get("Asia/Kolkata");
$current_time=time();
$date_time=strftime('%B-%d-%Y %H:%M:%S',$current_time);
$date_time;
$postid=$_GET['id'];
if(empty($name) ||empty($email) ||empty($comment)){
  $_SESSION["ErrorMessage"]="All fields must be filled";
}elseif(strlen($comment)>500) {
  $_SESSION["ErrorMessage"]="Word limit of comment exceeded must be under 500 words";
}else{
  global $selected;
  $postidfromurl=$_GET['id'];
  $Query="INSERT INTO comments (date_time,name,email,comment,status,admin_panel_id)VALUES('$date_time','$name','$email','$comment','OFF','$postid')";
  $EXECUTE=mysqli_query($Connection,$Query);
  if($EXECUTE){
    $_SESSION["SuccessMessage"]="Comment submitted successfully";
  redirect_to("fullpost.php?id={$postid}");
  }else{ 
    $_SESSION["ErrorMessage"]="Something went wrong try again!!!";
   redirect_to("fullpost.php?id={$postid}");
  }
}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Full Blog post</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="publicstyles.css">
<style type="text/css">
  .col-3{
    background-color: green;
  }
  .fieldinfo{
    color: rgb(251,174,44);
    font-family: Bitter,Georgia,"Times new Roman",Times,serif;
    font-size: 1.2em;
  }
  .commentblock{
    background-color: #F6F7F9; 
  }
  .comment-info{
    color: 365899;
    font-family: sans-serif;
    font-size: 1.1em;
    font-weight: bold;
    padding-top: 10px;
  }
  .description{
  color: #868686;
  font-weight: bold;
  margin-top: -2px;
}
.comment{
  margin-top: -2px;
  padding-top: 10px;
  font-size: 1.1em;
}
</style>
</head>
<body>
<div style="height: 10px; background: #27aae1"></div>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="blog.php">
			<img style="margin-top:-5px margin-right:5px" src="https://cdn.images.express.co.uk/img/dynamic/36/590x/Avengers-Iron-Man-was-almost-played-by-another-major-star-936289.jpg" width=200; height=30>
		</a>
		<div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="#">Home</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="blog.php">Blog</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">About us</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Services</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Contact us</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Feature</a>
      </li>
    </ul>
  <form action="blog.php" class="form-inline navbar-right">
    <input class="form-control mr-sm-2" type="text" placeholder="Search" name="Search">
    <button class="btn btn-outline-danger my-2 my-sm-0" name="searchbutton" type="submit">Go!!!</button>
  </form>
 </div>
  </div>
</nav>
<div style="height: 10px; background: #27aae1"></div>
<div class="container">
  <div class="blog-header">
    <h1>Blog spot</h1>
    <p class="lead">Welcome to this blog</p>
  </div>
  <div class="row">
    <div class="col-8">
      <div><?php echo message();
         echo successmessage();
     ?></div>
      <?php 
        global $selected;
        if(isset($_GET["searchbutton"])){
          $Search=$_GET["Search"];
          $viewQuery="SELECT * FROM admin_panel WHERE date_time LIKE '%$Search%' OR title LIKE '%$Search%' OR category LIKE '%$Search%' OR post LIKE '%$Search%'";
        }else{
          $postidfromurl=$_GET["id"];
          $viewQuery="SELECT * FROM admin_panel WHERE id='$postidfromurl' ORDER BY  date_time desc";}
          $EXECUTE=mysqli_query($Connection,$viewQuery);
          
          while ($DataRows=mysqli_fetch_array($EXECUTE)) {
            $postid=$DataRows["id"];
            $date_time=$DataRows["date_time"];
            $title=$DataRows["title"];
            $category=$DataRows["category"];
            $admin=$DataRows["author"];
            $image=$DataRows["image"];
            $post=$DataRows["post"];
       ?>
     <figure class="blogpost figure">
       <img src="upload/<?php echo $image; ?>" class="figure-img img-fluid rounded">
       <figcaption class="figure-caption">
         <h1 id="heading"><?php echo htmlentities($title); ?></h1>
         <p class="description">Category: <?php echo htmlentities($category);?> Published on: <?php echo htmlentities($date_time);?> </p>
         <p class="post">
          <?php echo $post; ?></p>
       </figcaption>
       </figure>
     </div>
   <?php } ?>
   <br><br>
   <br><br>
   <?php 
   $selected;
   $postidforcomment=$_GET['id'];
   $ExtractioncommentsQuery="SELECT * FROM comments WHERE admin_panel_id='$postidforcomment' AND status='ON'";
   $EXECUTE=mysqli_query($Connection,$ExtractioncommentsQuery);
        while ($DataRows=mysqli_fetch_array($EXECUTE)) {
            $commentdate_time=$DataRows["date_time"];
            $commentername=$DataRows["name"];
            $comments=$DataRows["comment"];
         ?>
<div class="commentblock">
  <img style="margin-left: 10px; margin-top: 10px;" class="pull-left" src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/12/User_icon_2.svg/220px-User_icon_2.svg.png" width=70px; height=70px;>
    <p style="margin-left: 90px;" class="comment-info"><?php echo $commentername;?></p>
    <p style="margin-left: 90px;" class="description"><?php echo $commentdate_time;?></p>
    <p style="margin-left: 90px;"class="comment"><?php echo $comments;?></p>
</div>
<hr>
<?php } ?>
   <br><br>
   <br>
    <span class="fieldinfo">Comments</span>
    <br>
   <span class="fieldinfo">Share your thoughts about this post</span>
   <br>
   <div>
      <form action="fullpost.php?id=<?php echo $postid; ?>" method="POST" enctype="multipart/form-data">
  <div class="form-group">
  <label for="name"><span class="fieldinfo">Name:</span></label>
  <input class="form-control" type="text" name="name" id="name" placeholder="Name">
</div>
  <div class="form-group">
  <label for="email"><span class="fieldinfo">E-mail:</span></label>
  <input class="form-control" type="email" name="email" id="email" placeholder="E-mail">
</div>
<div class="form-group">
  <label for="commentarea"><span class="fieldinfo">Comment:</span></label>
  <textarea class="form-control" name="comment" id="commentarea"></textarea>
</div>
  <br>
<input class="btn btn-primary" type="submit" name="Submit" value="Submit">
</form>
</div>
    </div>
  </div>
</div>
</body>
</html>
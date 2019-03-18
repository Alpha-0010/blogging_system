<?php require 'connection.php';?>
<?php require 'sessions.php';?>
<?php require 'functions.php';?>
<?php 
if(isset($_POST["Submit"])){
$title=$_POST["title"];
$category=$_POST["Category"];
$post=$_POST["Post"];
date_default_timezone_get("Asia/Kolkata");
$current_time=time();
$date_time=strftime('%B-%d-%Y %H:%M:%S',$current_time);
$date_time;
$admin= $_SESSION["username"];
$image=$_FILES["Image"]["name"];
$target='upload/'.basename($_FILES["Image"]["name"]);
if(empty($title)){
  $_SESSION["ErrorMessage"]="title of the post can't be empty";
  redirect_to("add_new_posts.php");
}elseif(strlen($title)<2) {
  $_SESSION["ErrorMessage"]="Try out bigger titles";
  redirect_to("add_new_posts.php");

}else{
  global $selected;
  $Query="INSERT INTO admin_panel(date_time,title,category,author,image,post)VALUES('$date_time','$title','$category','$admin','$image','$post')";
  $EXECUTE=mysqli_query($Connection,$Query);
  move_uploaded_file($_FILES["Image"]["tmp_name"],$target);
  if($EXECUTE){
    $_SESSION["SuccessMessage"]="Post added successfully";
  redirect_to("add_new_posts.php");
  }else{
    $_SESSION["ErrorMessage"]="Something went wrong try again!!!";
  redirect_to("add_new_posts.php");
  }
}
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Add new posts</title>
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
</style>
</head>
<body>
<div class="container-fluid">
<div class="row">
  <div class="col-3">
    <h3>Menu</h3>
   <ul id="side_menu" class="nav flex-column nav-pills">
  <li class="nav-item">
    <a class="nav-link" href="dashboard.php"><i class="fas fa-chalkboard-teacher"></i>&nbsp;Dashboard</a>
  </li>
   <li class="nav-item">
    <a class="nav-link active" href="add_new_posts.php"><i class="far fa-calendar-alt"></i>&nbsp;Add New Post</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="categories.php"><i class="fas fa-tags"></i>&nbsp;Categories</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="admins.php"><i class="fas fa-user-alt"></i>&nbsp;Manage Admins</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="comments.php"><i class="fas fa-comment-dots"></i>&nbsp;Comments</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="blog.php"><i class="fas fa-blog"></i>&nbsp;Live Blogs</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="logout.php"><i class="fas fa-power-off"></i>&nbsp;Logout</a>
  </li>
</ul>
  </div>
  <div class="col-9">
    <h1>Add new posts</h1>
    <div><?php echo message();
         echo successmessage();
     ?></div>
    <div>
      <form action="add_new_posts.php" method="POST" enctype="multipart/form-data">
<fieldset>
  <div class="form-group">
  <label for="title"><span class="fieldinfo">title:</span></label>
  <input class="form-control" type="text" name="title" id="title" placeholder="title">
</fieldset>
</div>
  <div class="form-group">
  <label for="categoryselect"><span class="fieldinfo">Category:</span></label>
  <select class="form-control" id="categoryselect" name="Category">
    <?php 
          global $selected;
          $view="SELECT * FROM category ORDER BY  date_time desc";
          $EXECUTE=mysqli_query($Connection,$view);
          while ($DataRows=mysqli_fetch_array($EXECUTE)) {
            $id=$DataRows["id"];
            $Categoryname=$DataRows["name"];
         ?>
          <option><?php 
            echo  $Categoryname;
           ?>
            <?php } ?>
          </option>
  </select>
  </div>
  <div class="form-group">
  <label for="imageselect"><span class="fieldinfo">Select Image:</span></label>
<input type="File" class="form-control" name="Image" id="imageselect">
</div>
<div class="form-group">
  <label for="postarea"><span class="fieldinfo">Post:</span></label>
  <textarea class="form-control" name="Post" id="postarea"></textarea>
  <br>
<input class="btn btn-primary btn-block" type="submit" name="Submit" value="Add New Post">
</form>
    </div>
  </div>
  </div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>
</html>
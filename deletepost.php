<?php require 'connection.php';?>
<?php require 'sessions.php';?>
<?php require 'functions.php';?>
<?php 
if(isset($_POST["Submit"])){
$Title=$_POST["Title"];
$category=$_POST["Category"];
$post=$_POST["Post"];
date_default_timezone_get("Asia/Kolkata");
$current_time=time();
$date_time=strftime('%B-%d-%Y %H:%M:%S',$current_time);
$date_time;
$admin="Shashwat Sinha";
$image=$_FILES["Image"]["name"];
$target='upload/'.basename($_FILES["Image"]["name"]);
  global $selected;
  $deletefromurl=$_GET['delete'];
  $Query="DELETE FROM admin_panel WHERE id='$deletefromurl'";
  $EXECUTE=mysqli_query($Connection,$Query);
  move_uploaded_file($_FILES["Image"]["tmp_name"],$target);
  if($EXECUTE){
    $_SESSION["SuccessMessage"]="Post Deleted successfully";
  redirect_to("dashboard.php");
  }else{
    $_SESSION["ErrorMessage"]="Something went wrong try again!!!";
  redirect_to("dashboard.php");
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Delete Post</title>
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
    <a class="nav-link" href="#"><i class="fas fa-user-alt"></i>&nbsp;Manage Admins</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#"><i class="fas fa-comment-dots"></i>&nbsp;Comments</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#"><i class="fas fa-blog"></i>&nbsp;Live Blogs</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#"><i class="fas fa-power-off"></i>&nbsp;Logout</a>
  </li>
</ul>
  </div>
  <div class="col-9">
    <h1>Delete post</h1>
    <div><?php echo message();
         echo successmessage();
     ?></div>
    <div>
      <?php 
      $searchQueryparameter=$_GET['delete'];
      $selected;
        $Query="SELECT * FROM admin_panel WHERE id='$searchQueryparameter'";
        $EXECUTE=mysqli_query($Connection,$Query);
        $sr_no=0;
        while ($DataRows=mysqli_fetch_array($EXECUTE)) {
            $titletobeupdated=$DataRows["title"];
            $categorytobeupdated=$DataRows["category"];
            $imagetobeupdated=$DataRows["image"];
            $posttobeupdated=$DataRows["post"];
         ?>
      <form action="deletepost.php?delete=<?php echo $searchQueryparameter; ?>" method="POST" enctype="multipart/form-data">
<fieldset>
  <div class="form-group">
  <label for="title"><span class="fieldinfo">Title:</span></label>
  <input disabled value="<?php echo $titletobeupdated; ?>" class="form-control" type="text" name="Title" id="title" placeholder="Title">
</fieldset>
</div>
  <div class="form-group">
  <span class="fieldinfo">Existing category: </span>
  <?php echo $categorytobeupdated; ?>
  <br>
  <label for="categoryselect"><span class="fieldinfo">Category:</span></label>
  <select disabled class="form-control" id="categoryselect" name="Category">
    <?php 
          global $selected;
          $view="SELECT * FROM category ORDER BY  date_time desc";
          $EXECUTE=mysqli_query($Connection,$view);
          while ($DataRows=mysqli_fetch_array($EXECUTE)) {
            $ID=$DataRows["id"];
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
  <span class="fieldinfo">Existing image: </span>
  <img src="upload/<?php echo $imagetobeupdated; ?>" width=170px; height=70px>
  <br>
  <label for="imageselect"><span class="fieldinfo">Select Image:</span></label>
<input disabled type="File" class="form-control" name="Image" id="imageselect">
</div>
<div class="form-group">
  <label for="postarea"><span class="fieldinfo">Post:</span></label>
  <textarea disabled class="form-control" name="Post" id="postarea">
    <?php echo $posttobeupdated; }?>
  </textarea>
  <br>
<input class="btn btn-danger btn-block" type="submit" name="Submit" value="Delete Post">
</form>
    </div>
  </div>
  </div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>
</html>
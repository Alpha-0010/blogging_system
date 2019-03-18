<?php require 'connection.php';?>
<?php require 'sessions.php';?>
<?php require 'functions.php';?>
<?php 
if(isset($_POST["Submit"])){
$category=$_POST["category"];
date_default_timezone_get("Asia/Kolkata");
$current_time=time();
$date_time=strftime('%B-%d-%Y %H:%M:%S',$current_time);
$date_time;
$admin= $_SESSION["username"];
if(empty($category)){
  $_SESSION["ErrorMessage"]="All fields must be filled out";
  redirect_to("categories.php");
}elseif(strlen($category)>99) {
  $_SESSION["ErrorMessage"]="Too long Name for category";
  redirect_to("categories.php");

}else{
  global $selected;
  $Query="INSERT INTO category(date_time,name,creatorname)VALUES('$date_time','$category','$admin')";
  $EXECUTE=mysqli_query($Connection,$Query);
  if($EXECUTE){
    $_SESSION["SuccessMessage"]="Category added successfully";
  redirect_to("categories.php");
  }else{
    $_SESSION["ErrorMessage"]="Category failed to add";
  redirect_to("categories.php");
  }
}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Category</title>
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
    <a class="nav-link" href="add_new_posts.php"><i class="far fa-calendar-alt"></i>&nbsp;Add New Post</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="categories.php"><i class="fas fa-tags"></i>&nbsp;Categories</a>
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
  	<h1>Manage categories</h1>
    <div><?php echo message();
         echo successmessage();
     ?></div>
  	<div>
  		<form action="categories.php" method="POST">
<fieldset>
	<div class="form-group">
	<label for="categoryname"><span class="fieldinfo">Name:</span></label>
	<input class="form-control" type="text" name="category" id="categoryname" placeholder="Name">
</fieldset>
</div>
<input class="btn btn-primary btn-block" type="submit" name="Submit" value="Add New Category">
</form>
    <div class="table-responsive">
      <table class="table table-bordered table-hover">
        <tr>
          <th>Id</th>
          <th>Date & time </th>
          <th>Category name </th>
          <th>Creator name </th>
          <th>Action</th>        
        </tr>
        <?php 
          global $selected;
          $view="SELECT * FROM category ORDER BY  date_time desc";
          $EXECUTE=mysqli_query($Connection,$view);
          $sr_no=0;
          while ($DataRows=mysqli_fetch_array($EXECUTE)) {
            $ID=$DataRows["id"];
            $date_time=$DataRows["date_time"];
            $Categoryname=$DataRows["name"];
            $creatorname=$DataRows["creatorname"];
            $sr_no++;
         ?>
         <tr>
           <td><?php echo $sr_no ?></td>
           <td><?php echo $date_time ?></td>
           <td><?php echo $Categoryname ?></td>
           <td><?php echo $creatorname ?></td>
           <td><a href="deletecategory.php?id=<?php echo $ID;?>">
             <span class="btn btn-danger">Delete</span> 
           </a></td>
         </tr>
       <?php } ?>
      </table>
    </div>
  </div>
  </div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>
</html>
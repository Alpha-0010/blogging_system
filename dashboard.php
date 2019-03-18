<?php require 'connection.php';?>
<?php require 'sessions.php';?>
<?php require 'functions.php';?>
<!DOCTYPE html>
<html>
<head>
  <title>Admin dashboard</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="adminstyles.css">
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
        <a class="nav-link" href="blog.php" data-target="blog.php" target="_blank">Blog</a>
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
<div class="container-fluid">
<div class="row">
  <div class="col-3">
    <br><br>
   <ul id="side_menu" class="nav flex-column nav-pills">
  <li class="nav-item">
    <a class="nav-link active" href="dashboard.php"><i class="fas fa-chalkboard-teacher"></i>&nbsp;Dashboard</a>
  </li>
   <li class="nav-item">
    <a class="nav-link" href="add_new_posts.php"><i class="far fa-calendar-alt"></i>&nbsp;Add New Post</a>
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
    <div><?php echo message();
         echo successmessage();
     ?></div>
    <h1>Admin Dashboard</h1>
    <div class="table-responsive">
      <table class="table table-bordered table-hover">
        <tr>
          <th>No</th>
          <th>Post title</th>
          <th>Date & time</th>
          <th>Author</th>
          <th>Category</th>
          <th>Banner</th>
          <th>Comments</th>
          <th>Action</th>
          <th>Details</th>
        </tr>
        <?php 
        $selected;
        $viewQuery="SELECT * FROM admin_panel ORDER BY date_time desc;";
        $EXECUTE=mysqli_query($Connection,$viewQuery);
        $sr_no=0;
        while ($DataRows=mysqli_fetch_array($EXECUTE)) {
            $id=$DataRows["id"];
            $date_time=$DataRows["date_time"];
            $title=$DataRows["title"];
            $admin="shashwat sinha";
            $category=$DataRows["category"];
            $image=$DataRows["image"];
            $post=$DataRows["post"];
            $sr_no++;
         ?>
        <tr>
           <td><?php echo $sr_no; ?></td>
           <td style="color: #5e5eff;"><?php
           if(strlen($title)>20){
            $title=substr($title,0,20).'..';
           } 
           echo $title;
           ?></td>
           <td><?php
           if(strlen($date_time)>11){
            $date_time=substr($date_time,0,11);
           } 
           echo $date_time;
           ?></td>
           <td><?php 
           if(strlen($admin)>6){
            $admin=substr($admin,0,6).'..';
           } 
           echo $admin; ?></td>
           <td><?php 
           if(strlen($category)>8){
            $category=substr($category,0,8).'..';
           } 
           echo $category; ?></td>
           <td><img src="upload/<?php echo $image; ?>" width="170px"; height="50px"></td>
           <td>processng</td>
           <td>
           <a href="editpost.php?edit=<?php echo $id; ?>"> 
          <span class="btn btn-warning">Edit</span> 
        </a>  
            <a href="deletepost.php?delete=<?php echo $id; ?>"> 
            <span class="btn btn-danger">Delete</span> 
          </a> 
          </td>
           <td>
            <a href="fullpost.php?id=<?php echo $id; ?>" target="_blank">
            <span class="btn btn-primary"> Live preview</span>
            </a>
          </td>
         </tr>
         <?php } ?>
      </table>
    </div>
  </div>
</div>

</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>
</html>
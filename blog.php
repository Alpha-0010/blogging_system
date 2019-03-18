<?php require 'connection.php';?>
<?php require 'sessions.php';?>
<?php require 'functions.php';?>
<!DOCTYPE html>
<html>
<head>
	<title>Blog page</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="publicstyles.css">
<style type="text/css">
  .col-3{
    background-color: green;
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
      <?php 
        global $selected;
        if(isset($_GET["searchbutton"])){
          $Search=$_GET["Search"];
          $viewQuery="SELECT * FROM admin_panel WHERE date_time LIKE '%$Search%' OR title LIKE '%$Search%' OR category LIKE '%$Search%' OR post LIKE '%$Search%'";
        }else{
          $viewQuery="SELECT * FROM admin_panel ORDER BY  date_time desc";}
          $EXECUTE=mysqli_query($Connection,$viewQuery);
          while ($DataRows=mysqli_fetch_array($EXECUTE)) {
            $postId=$DataRows["id"];
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
         <p class="description">Category: <?php echo htmlentities($category);?> Published on: <?php echo htmlentities($date_time);?></p>
         <p class="post">
          <?php 
            if(strlen($post)>150){
              $post=substr($post,0,150).'...';
            } echo $post;?></p>
       </figcaption>
       <a href="fullpost.php?id=<?php echo $postId; ?>"><span class="btn btn-info">
         Read more &rsaquo;&rsaquo;
       </span></a>
       </figure>
     </div>
   <?php } ?>
    </div>
  </div>
</div>
</body>
</html>
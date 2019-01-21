
<?php include 'dbconn.php'; ?>

<?php 

session_start();
if (!isset($_SESSION['user']) && !isset($_SESSION['password'])){
    header('location:index.php');
}else{

$file=$position=$company="";
$post_Err="";

 
      if (isset($_POST['add'])) {
        $filepath = "images/" .basename($_FILES['photo']['name']);
        extract($_POST);
        $image=$_FILES['photo']['name'];

        if (empty($_POST['photo']) && empty($_POST['position'])){
        $post_Err="Add something to post";

    }
    if(empty($post_Err)){
        //$user_id=$_SESSION['id'];
        // $title=$_POST['position'];
        // $content=$_POST['company'];
        move_uploaded_file($_FILES['photo']['tmp_name'], $filepath);

          $query="INSERT INTO posts VALUES ('$image','$filepath','$position','$company')";
        $result=mysqli_query($conn,$query);
        if ($result==true){
            header('location:view.php');
        }else{
            $post_Err="Error while  posting.Kindly try again later";
        }
        }
}
}
    //comments logics
   
   //header('location:view.php');

                             
                             

 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
    
	<link rel="stylesheet" href="bootstrap-4.1.3-dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="bootstrap-4.1.3-dist/css/bootstrap.css">
	<link rel="stylesheet" href="bootstrap-4.1.3-dist/js/bootstrap.bundle.js">
	<link rel="stylesheet" href="bootstrap-4.1.3-dist/css/bootstrap.-grid.css">
</head>
<body>

<div class="navbar bg-light navbar-expand-md navbar-light">
		<a href="#" class="navbar-brand">Zumbic</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar1">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbar1">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="view.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="dashboard.php">post</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">About</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Help</a>
      </li>
    </ul>
  </div>
  <form role="search" class="form-inline  form-text">
    <div class="form-group">
        <input type="text" class="form-control" placeholder="Search">
    </div>
    <button type="submit" class="btn btn-default">
        <span class="glyphicon glyphicon-search"></span>
    </button>
</form>
</div>
 <!-- content -->
        <div class="container">
     	<div class="jumbotron m-auto" ">
     		<h1 class="display-4">Zumbicans ,Your Website For Posting Anything!!!</h1>
     		<p class="lead">We are glad you're here! Feel free to post and View  listings at your convenience</p>
        
     		<hr class="my-4">
     		
     			<!-- card-->

     			<div class="card text-center">
     				
     				<div class="card-body">
     					<!-- form to add job goes here -->
     					<form action="dashboard.php" method="POST"enctype="multipart/form-data">
     						<div class="form-group">
     							
     							
									Select image :
									<input type="file" name="photo">
                                    <br/>
									  <!-- $imgContent = addslashes(file_get_contents($filepath)); ?> 
									 print "<img src=".$imgContent['image']." height=200 width=300 />"; -->
 										
									
     						</div>
     						<div class="form-group">
     							<input type="text" class="form-control col-5"  placeholder="What is on your mind" name="position" >
     							<small class="form-text text-muted">Please write a descriptive title.</small>
     						</div>
     						<div class="form-group">
     							<input type="text" class="form-control col-7"  style="height: 100px" placeholder="Description" name="company">
     						</div>
     						
     						<button type="submit" class="btn btn-primary" name="add">Publish</button>
     						<span style="color: rgb(100,243,255);"><?php echo $post_Err?></span>
     					</form>
     				</div>
     			</div>

                    
     		
 	</div>
     </div>

</body>
</html>

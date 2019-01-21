<?php 
session_start();
include 'dbconn.php';
 ?>



<!DOCTYPE html>
<html>
<head>
	<title>reset</title>
	<link rel="stylesheet" type="text/css" href="Bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="bootstrap-4.1.3-dist/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="styles/custom.css">
		<link href="https://fonts.googleapis.com/css?family=Acme" rel="stylesheet">
</head>
<body>
	     <div class="container" class="form">

     	<div class="card m-auto bg-light"  style="width: 50%;">
     		<div class="card-body m-auto">
     			<h5 class="card-title display-4">Sue to reset your password?</h5>
          
     			<hr class="my-4">
     			<form action="reset.php" method="post">
     	<div class="form-group">
		<input type="password" name="pass1" class="form-control"placeholder="Create new password">
		</div>
		<div class="form-group">
		<input type="password" name="pass2"class="form-control" placeholder="Confirm new password">
		</div>
		<div class="form-group">
		<input type="submit"  class="btn btn-danger" name="reset" value="Reset Password">
	     </div>
	</form>
     	</div>
     	</div>
     	</div>		




	
<?php 
// if (!isset($_SESSION['user']) && !isset($_SESSION['phone'])) {
// header('location:forgot.php');
// }
	


if (isset($_POST['reset'])) {
	// $user=$_SESSION['user'];
	//  $phone=$_SESSION['phone'];
	//  $id=$_SESSION['id'];
$password1=$_POST['pass1'];
$password2=$_POST['pass2'];
	

	if ($password1 == $password2) {

		$finalpassword = md5($password2);
		$query= "UPDATE users SET password = '$finalpassword' WHERE id = '$id'";
		$run = mysqli_query($conn,$query);
		if ($run) {
			header('Location:index.php');
			
		}
		
		
		
	}else{
		echo "Password Mismatch";
	}
	
}
 ?>
</body>
</html>
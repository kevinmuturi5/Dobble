<?php include("dbconn.php"); ?>
<?php ob_start(); ?>

<?php 
 if (isset($_POST['submit'])) {
  $user = $_POST['email'];
  $phone = $_POST['phone_number'];


  $query = "SELECT * FROM users";

  $result = mysqli_query($conn,$query);
  $row = mysqli_fetch_row($result);
   //var_dump($row['3']);
   // var_dump($row[4]);
   while ($user == $row[4] && $phone == $row[3] ) {
    header("Location:reset.php");
     $user = $_POST[''];
  $phone = $_POST[''];
   
    }
 }
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Forgot Password</title>
	<link rel="stylesheet" href="bootstrap-4.1.3-dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>
     <br class="my-4 ">

     <div class="container" class="form">

     	<div class="card m-auto bg-light"  style="width: 50%;">
     		<div class="card-body m-auto">
     			<h5 class="card-title display-4">forgot password?</h5>
          
     			<hr class="my-4">
                 
     			     <h6>Please Verify credentials to get  reset password</h6>
               <!--  -->
     					<form action="forgot.php" method="POST">
     						<div class="form-group">
     							<input class="form-control" type="text" placeholder="Enter Email"  name="email">
     						</div>
     						<div class="form-group">
     							<input type="text" class="form-control" placeholder="phone_number" name="phone_number">
     						</div>

     						<div>
     							<input type="submit" class="btn btn-danger" name="submit" value="Create new password">
     						</div>
     					</form>
     		</div>

         	
         </div> 
     	
     </div>
     <link rel="stylesheet" href="css/styles.css">

      <!-- footer -->
     <footer class="footer text-center">
      <small>Created with all the love by Mevin &copy;</small>
     </footer>

</body>
</html>


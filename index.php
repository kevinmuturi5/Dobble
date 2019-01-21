<?php require 'dbconn.php';?>
<?php ob_start(); ?>
<?php session_start();?>
<?php 
$user_first_Err=$user_last_Err=$user_phone_Err=$user_email_Err=$user_pass_Err=$user_pass1_Err=$log_in_Err=$user_feedback="";
$firstname= $secondname=$phone=$email=$gender=$pass=$pass1=$log_email=$log_pass="";
// register
include 'dbconn.php';
if (isset($_POST['submit'])) {
 if (empty($_POST['firstname'])){

    $user_first_Err='*Please fill out this field';
}else{

    $firstname=$_POST['firstname'];

    if (!preg_match("/^[a-zA-z0-9 \s]+$/", $firstname)){
        $user_first_Err='*Name can only contain letters or numbers';
    }
}
if (empty($_POST['secondname'])){
    $user_last_Err='*Please fill out this field';
}else{
    $secondname=$_POST['secondname'];
    if (!preg_match("/^[a-zA-z0-9 \s]+$/", $secondname)){
        $user_last_Err='*Name can only contain letters or numbers';
    }
}
if(empty($_POST['phone'])){
    $user_phone_Err='*Phone number required';
}
else{
    $phone=$_POST['phone'];
    if (!preg_match("/^\d{9,13}?[0-9]$/", $phone)){
        $user_phone_Err='*Enter a valid phone number';
    }
}
if(empty($_POST['email'])){
    $user_email_Err='*Email required';
}
else{
    $email=$_POST['email'];
    if (filter_var($email, FILTER_VALIDATE_EMAIL) == false){
        $user_email_Err='*Invalid email address';
    }
}
if(empty($_POST['password'])){
    $user_pass_Err='*Please create a password';
}
else{
    $pass=$_POST['password'];
}
if (empty($_POST['newpassword'])){
    $user_pass1_Err='*Please confirm your password';
}else{
    $pass1=$_POST['password'];
}
if ($pass == $pass1){
    $final_pass=md5($pass);
}else{
    $user_pass1_Err='*Password mismatch detected';
    $pass='';
    $pass1='';
}
if (empty($user_first_Err) && empty($user_last_Err) && empty($user_phone_Err) && empty($user_email_Err) && empty($user_pass1_Err)){
	  $query="INSERT INTO users VALUES ('','$firstname','$secondname','$phone','$email','$final_pass')";
	  $result = mysqli_query($conn, $query);
	  if ($result == true){
        $_SESSION["user"]=$email;
        $_SESSION["password"]=$final_pass;

        $firstname='';
        $secondname='';
        $phone='';
        $email='';
        $pass='';
        $pass1='';

        header("location:view.php");
}else{
echo "<kbd class='text-center bg-danger'>Your Details May Not Be UniQue <br>Try Again</kbd>";;
}
}
}

// login
if (isset($_POST['sign_log'])) { 	
	if (empty($_POST['log_user'])){
    $log_in_Err="Enter your email address and password to continue";

}else{
    $log_email=$_POST['log_user'];
}
if (empty($user_log_Err) && !empty($_POST['log_pass'])){
    $log_pass=$_POST['log_pass'];
    $ins_pass=md5($log_pass);
    $query="SELECT * FROM users WHERE emailaddress='$log_email' && password ='$ins_pass'";
     $result = mysqli_query($conn, $query);
    $row=mysqli_num_rows($result);
     if ($row==1){
        $rew=mysqli_fetch_array($result);
        $_SESSION["user"]=$log_email;
        $_SESSION["password"]=$ins_pass;
        $_SESSION["id"]=$rew['id'];

        header('location:view.php');
    }else{
        $log_in_Err="Wrong password/email combination";
    }	
}
}


?>
    <!DOCTYPE html>
    <html>
    <head>
    <title>my zumbic web</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="bootstrap-4.1.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap-4.1.3-dist/css/bootstrap.css">
    <link rel="stylesheet" href="bootstrap-4.1.3-dist/js/bootstrap.bundle.js">
    <link rel="stylesheet" href="bootstrap-4.1.3-dist/css/bootstrap.-grid.css">
    <link rel="stylesheet" href="css/styles.css">
    </head>
<body>
 

    <!-- Navbar-->
    <p> <span style="color: red" ><?php echo $log_in_Err;?> </span> </p>
     
    <nav class="navbar bg-light navbar-expand-md navbar-light">
        <div class="container-fluid">
    <a href="index.php" class="navbar-brand">Zumbic</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar1">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbar1">
    <ul class="dropdown-menu">
    <li class="nav-item active">
    <a class="nav-link" href="#">Home</a>
    </li>
    <li class="nav-item">
    <a class="nav-link" href="#">About</a>
    </li>
    <li class="nav-item">
    <a class="nav-link" href="#">Language</a>
    </li>
    <li class="nav-item">
    <a class="nav-link" href="#">Help</a>
    </li>
    </ul>
    </div>

           <!--  login form -->
    <form class="form-inline mr-sm-2" method="post" action="index.php">
    	<div class="form-group">
    		<label for="user_first_name">Email or phone:</label>	
            <input type="text" name="log_user" class="form-control" id="user_first_name" placeholder="Email or phone"/>
      </div>      
         <div class="form-group">
            <label for="user_last_name">Password:</label>
            <input type="password" name="log_pass" class="form-control" id="user_last_name" placeholder="password"/>
       </div>
       <br><br>
       <div class="form-group">
            <button type="submit" name="sign_log" class="btn btn-outline-success my-2 my-sm-0"><span class="glyphicon glyphicon-log-in"></span> Sign in</button>
        </div>
        <br/>

        
    </form>
    <div class="form-group">
        <a href="forgot.php">forgot password</a>
    </div>
    </div>
</nav>
         

    <!-- Register form -->

   
    <div class="container-fluid down">
    <div class="row">
    <div class="col-xm-12 col-sm-5 log" class="log">
    	<h1 class="well">WELLCOME TO ZUMBIC </h1>
    	<img src="images/download.png" class="logo">
    </div>
    <div class="col-sm-7 col-xm-12">
    	<form method="POST" action="index.php" class="style">
    		<legend>
    			<h1>Register now</h1>
    			<p>its free as always</p>
    		</legend>
    		<hr>
    		<div class="form-row">
    			<div  class="col-sm-6 form-group floating-label-form-group">
    				<label for="">Your first name</label>
    				<input type="text" name="firstname" placeholder="First name"class="col-3.5" >
    				<div class="col-sm-6">
    				 <span class="error" style="color: red"><?php echo $user_first_Err;?></span>
    				</div>
    			</div>
    			<div  class="col-sm-6 form-group">
    				<label for="">Your last name</label>
    				<input type="text" name="secondname" placeholder="Last name"class="col-3.5">
    				<div class="col-sm-6">
    				<span style="color: red"><?php echo $user_last_Err;?></span>
    				</div>
    			</div>
    			</div>
    			 
    			 	<div class="form-group">
                    <label for="user_last_name"class="col-sm-3 col-form-label">Your phone Number:</label>
                    <input type="text" name="phone" id="user_last_name" placeholder="phone Number" class="col-5" />
                    <span style="color: red"><?php echo $user_phone_Err;?></span>
               </div>

               <div class="form-group">
                    <label for="user_last_name" class="col-sm-3 col-form-label">Your Email Address:</label>
                    <input type="text" name="email" id="user_last_name" class="col-5" placeholder="Email Adress"/>
                 <span style="color: red"><?php echo $user_email_Err;?></span>
               </div>
               <div class="form-group">
                <div class="row">
                    <div class="col-sm-3 col-form-label">
                        <legend>Gender:</legend>
                        <hr>
                    </div>
                    <div class="col-sm-2 col-form-label radio radio-info">
                        <input type="radio" name="gender" value="Male"/> Male<br>
                        <input type="radio" name="gender" value="Female"/> Female
                    </div>
                </div>
            </div>
            <div class="form-group">
                    <label for="user_last_name"class="col-sm-3 col-form-label">Create Password:</label>
                    <input type="password" name="password" id="user_last_name" placeholder="New Password" class="col-5" />
                     <span style="color:red"><?php echo $user_pass_Err;?></span>
               </div>
               <div class="form-group">
                    <label for="user_last_name"class="col-sm-3 col-form-label">Cornfirm password:</label>
                    <input type="password" name="newpassword" id="user_last_name" placeholder="Cornfirm Password" class="col-5" />
                     <span style="color: red"><?php echo $user_pass1_Err;?></span>
               </div>
               <div class="form-group">
                By clicking <a href="#">Sign Up </a>, you agree to our <a href="#">Terms,
                Data Policy</a> and <a href="#">Cookie Policy.</a> <br />You may
                receive SMS notifications from us and can
                opt out at any time.
            </div>
            <div class="form-group">
                <input type="submit" name="submit" id="user_register" value="Sign up" class="btn btn-white btn-animated"/>
            </div>

    	</form>
    </div>
    </div>

    </div>
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" />
    <nav class="navbar fixed-top navbar-dark navbar-expand-sm">
</body>
    </html>



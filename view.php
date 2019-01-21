<?php include 'dbconn.php'; ?>
<?php 
$file=$position=$company="";
$post_Err="";
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
        $position=$_POST['position'];
        $company=$_POST['company'];
        move_uploaded_file($_FILES['photo']['tmp_name'], $filepath);

          $query="INSERT INTO post VALUES (null,'$image','$filepath','$position','$company')";
        $result=mysqli_query($conn,$query);
        if ($result==true){
            header('location:view.php');
        }else{
            $post_Err="Error while  posting.Kindly try again later";
        }
        }
}
}
   
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>view</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="bootstrap-4.1.3-dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="bootstrap-4.1.3-dist/css/bootstrap.css">
	<link rel="stylesheet" href="bootstrap-4.1.3-dist/css/bootstrap-grid.css">
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/icon-font.css">
  <link rel="stylesheet" href="css/customview.css">
    <link rel="stylesheet" href="bootstrap-4.1.3-dist/js/bootstrap.bundle.js">
		<link rel="stylesheet" href="bootstrap-4.1.3-dist/fonts/glyphicons-halflings-regular.svg">

	<link rel="stylesheet" href="bootstrap-4.1.3-dist/css/bootstrap.-grid.css">
</head>
<body class="body">
  <div class="content">
	<div class="navbar bg-light navbar-expand-md navbar-light  header" class="header">
		<a href="#" class="navbar-brand"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar1">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbar1">
    <ul class="navbar-nav mr-auto">
      <li class="hove nav-item active">
        <i class="box icon-basic-home"></i>
        <a class="nav-link" href="view.php">Home</a>

      </li>
      <li class=" hove nav-item">
        <i class="box icon-basic-postcard"></i>
        <a class="nav-link" href="#popup">post</a>
      </li>
      <li class=" hove nav-item">
        <i class="box icon-basic-smartphone"></i>
        <a class="nav-link" href="#">About</a>
      </li>
      <li class=" hove nav-item">
        <i class="box icon-basic-question"></i>

        <a class="nav-link" href="#">Help</a>
      </li>
      <li class="nav-item">

      	<form action="result.php" method="POSt" class="form-inline search" class="">
                     <div class="form-group">
                         <input type="search" class="form-control input"class="search__input" name="keyword" required autocomplete="off" autofocus placeholder="Search">  
                      </div>
               <div  class="">
                <button class="but icon-basic-magnifier" name="search"></button>
              </div>
                          
         </form> 
      </li>
    </ul>
    <ul class="icon">
      
       <i class="box icon-basic-bookmark"></i>
       <span class="note ">7</span>
       <i class="box icon-basic-message-multiple"></i>
       <span class="note">13</span>
         
    </ul>
    <ul>
      
          <img src="images/voky.jpg" class="profile" 'class='img-responsive' style="border-radius: 50%">
 
      
    </ul>

    <form class="nav justify-content-end"action="view.php" method="POST">
     		<h6> <kbd><?php echo $_SESSION['user']; ?></kbd></h6>
     			<a  class="btn btn-outline-primary text-white"name="Logout"type="Logout"href="logout.php">Logout</a>
     		
     	</form>

  </div>

</div>
<br>
<br>
<br>


<div class="container">
  <div class="row">
    <div class="col-lg-8">

            
                <?php 
                $dataTime = date('Y-m-d H:i:s');
                  $query = "SELECT * FROM post";
                  $result = mysqli_query($conn, $query);
                   while ($row = mysqli_fetch_row($result)) { 
             echo "<div class='card post'>";
                  echo" <div class='card-body'>";
                    echo"  <div class='row'>";
                      echo"  <div class='col-sm-2'>";
                     
                       echo" <a class='post-avatar thumbnail' href='profile.html'>";
                      print"<img src='images/".$row[1]."' style='width:100px;height:100px;border-radius:50%;'class='img-responsive'class='img-fluid'>";
                         echo" <div class='text-center'>";echo"$row[3]";echo"</div>";
                        echo"</a>";
                        echo"<div class='likes text-center'>7 Likes</div>";
                     echo" </div>";
                      echo" <div class='col-sm-10'>";
                        echo"<div class='bubble'>";
                          echo"<div class='pointer'>";
                           echo "$row[4]";
                         echo" </div>";
                         echo" <div class='pointer-border'></div>";
                       echo" </div>";
                        
                        echo"<p class='post-actions'>";
                         echo" <a href='#''>Comment</a> -";
                         echo" <a href='#'>Like</a> -";
                          echo"<a href='#'>Follow</a> -";
                          echo"<a href='#'>Share</a>";
                       echo" </p>";
                       if (isset($_POST['submit'])) {
                                  $drope = $_POST['comment'];
                                   $qury ="INSERT INTO comments VALUES (null,'$drope')";
                                  $rsult = mysqli_query($conn, $qury);
                                }
                       echo" <div class='comment-form'>";
                         echo" <form class='form-inline'method='post' action='view.php'>";
                            echo"<div class='form-group'>";
                              echo"<input type='text' class='form-control' id='postid' placeholder='Drope a Comment' name='comment'>";
                           echo" </div>";
                            echo"<button type='submit'  name='submit'class='btn btn-outline-secondary'>Add</button>";
                         echo" </form>";
                       echo" </div>";
                        
                        echo"<div class='clearfix'></div>";
      
                        echo"<div class='comments'>";
                         echo" <div class='comment'>";
                            echo"<a class='comment-avatar pull-left' href='#'>";
                             echo" <img src='img/user.png' class='img-fluid'>";
                           echo" </a>";
                            echo"<div class='comment-text'>";
                            $qery = "SELECT * FROM comments WHERE comment=0";
                             $esult = mysqli_query($conn, $qery);
                             
                              while ($ro = mysqli_fetch_row($esult)){
                             echo" <p>$ro[1]</p>";}
                           echo" </div>";
                          echo"</div>";
                        
                         echo" <div class='clearfix'></div>";
      
                         
                          echo"<div class='clearfix'></div>";
                        echo"</div>";
                     echo" </div>";

                     echo" </div>";
                  echo" </div>";


                echo"</div>"; 
               }
                 ?>
     
     					</div>
            
            <div class="col-lg-4 shard">
          <div class="card friends">
            <div class="card-heading">
              <h6 class="card-title">My Friends</h6>
            </div>
            <div class="card-body">
              <ul class="list-inline">
                <li class="list-inline-item">
                  <a class="thumbnail" href="profile.html">
                    <img src="images/nat-5.jpg" class="img-thumbnail">
                  </a>
                </li>
                <li class="list-inline-item">
                  <a class="thumbnail" href="profile.html">
                    <img src="images/river.jpg" class="img-thumbnail">
                  </a>
                </li>
                <li class="list-inline-item">
                  <a class="thumbnail" href="profile.html">
                    <img src="images/download.png" class="img-thumbnail">
                  </a>
                </li>
                <li class="list-inline-item">
                  <a class="thumbnail" href="profile.html">
                    <img src="images/nat-1-large.jpg" class="img-thumbnail">
                  </a>
                </li>
                <li class="list-inline-item">
                  <a class="thumbnail" href="profile.html">
                    <img src="images/nat-2-large.jpg" class="img-thumbnail">
                  </a>
                </li>
                <li class="list-inline-item">
                  <a class="thumbnail" href="profile.html">
                    <img src="images/nat-3-large.jpg" class="img-thumbnail">
                  </a>
                </li>
                <li class="list-inline-item">
                  <a class="thumbnail" href="profile.html">
                    <img src="images/nat-8.jpg" class="img-thumbnail">
                  </a>
                </li>
                <li class="list-inline-item">
                  <a class="thumbnail" href="profile.html">
                    <img src="images/nat-5.jpg" class="img-thumbnail">
                  </a>
                </li>
                <li class="list-inline-item">
                  <a class="thumbnail" href="profile.html">
                    <img src="images/nat-6.jpg" class="img-thumbnail">
                  </a>
                </li>
                <li class="list-inline-item">
                  <a class="thumbnail" href="profile.html">
                    <img src="images/nat-7.jpg" class="img-thumbnail">
                  </a>
                </li>
                <li class="list-inline-item">
                  <a class="thumbnail" href="profile.html">
                    <img src="images/nat-9.jpg" class="img-thumbnail">
                  </a>
                </li>
                <li class="list-inline-item">
                  <a class="thumbnail" href="profile.html">
                    <img src="images/nat-10.jpg" class="img-thumbnail">
                  </a>
                </li>
              </ul>
              <a class="btn btn-primary" href="#">View All Friends</a>
            </div>
          </div>

          <div class="card groups">
            <div class="card-heading">
              <h6 class="card-title">Latest Groups</h6>
            </div>
            <div class="card-body">
              <div class="group-item">
                <img src="img/group.png" class="img-fluid">
                <h5>
                  <a href="#">Sample Group One</a>
                </h5>
                <p>This is a Dobble social network sample group</p>
              </div>
              <div class="clearfix"></div>
              <div class="group-item">
                <img src="images/river.jpg" class="img-fluid">
                <h5>
                  <a href="#">Sample Group One</a>
                </h5>
                <p>This is a Dobble social network sample group</p>
              </div>
              <div class="group-item">
                <img src="img/group.png" class="img-fluid">
                <h5>
                  <a href="#">Sample Group One</a>
                </h5>
                <p>This is a Dobble social network sample group</p>
              </div>
              <div class="clearfix"></div>
              <a class="btn btn-primary" href="#">View All Groups</a>
            </div>
          </div>
        </div>
     		</div>

     	
</div>
</div>


   <div class="popup"id="popup">
    <div class="popup_content">
      <div class="popup_center">
        
        
        
          <!-- card-->

          <div class="card text-center">
            
            <div class="card-body">

              <!-- form to add job goes here -->
              <form action="view.php" method="POST"enctype="multipart/form-data">
                <a href="view.php" class="popup__close">&times;</a>
                
                <div class="form-group">
                  <input type="text" class="form-control col-5"  placeholder="What is on your mind" name="position" >
                  <small class="form-text text-muted">Please write a descriptive title.</small>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control col-7"  style="height: 100px" placeholder="Description" name="company">
                </div>
                <div class="form-group">
                  <input type="file" name="photo">
                                    <br/>
                    <!-- $imgContent = addslashes(file_get_contents($filepath)); ?> 
                   print "<img src=".$imgContent['image']." height=200 width=300 />"; -->
                    
                  
                </div>
                
                <button type="submit" class="btn btn-primary" name="add">Publish</button>
                <span style="color: rgb(100,243,255);"><?php echo $post_Err?></span>
              </form>
            </div>
          </div>

                    
        
  
      </div>
      
    </div>
      
     </div>


</body>
</html>

<?php

if (isset($_POST['Logout'])) {
 
  header('location:logout.php');
  
}else{echo "errrro";}

?>
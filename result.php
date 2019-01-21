
<?php include 'dbconn.php'; ?>
<?php


if (isset($_POST['search'])) {
    $keyword = $_POST['keyword'];

    $query = "SELECT title, description FROM jobs WHERE title LIKE '%{$keyword}%' OR description LIKE '%{$keyword}%'";

    $results = mysqli_query($conn, $query);


    if($row = mysqli_fetch_assoc($results)){
               
        }  else {
       

        echo '
           <kbd class = "bg-danger text-center"> No results Found! </kbd>
        ';
    }

}

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
	<div class="container">
        <div class="jumbotron m-auto" style="width: 80%;">
            <h1 class="display-4">Results from search</h1>
            <hr class="my-4"> 
            <p>Displaying search results for <kbd><?php echo $keyword ?></kbd></p>  

                     
        </div>

        <br class="my-4">

        <div class="card text-center m-auto my-4" style="width: 80%; padding: 20px 20px">
                   <?php echo "<a href='view.php'>$row[title] at $row[description] </a>"; ?>
                </div> 

        
     </div>

</body>
</html>
<?php 

   // connection code 
  $conn = mysqli_connect('localhost', 'root', '' , 'zumbic');

   // confirm connection
  if (!$conn) {
  	die('Could not connect. Run diagnostics ' . mysqli_connect_error());
  }

 


 ?>
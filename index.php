<?php
session_start();

$conn=mysqli_connect('localhost','root','','crudfunction');

if(isset($_SESSION['email'])){
  //echo $_SESSION['email'];
  $email_id=$_SESSION['email'];
  $select="SELECT *from data where user_email='$email_id'";
  $run= mysqli_query($conn,$select);

    $row_user= mysqli_fetch_array($run);
    $user_id= $row_user['user_id'];
    $user_name= $row_user['user_name'];
    $user_email= $row_user['user_email'];
    $user_password= $row_user['user_password'];
    $user_image= $row_user['user_image'];
    $user_details= $row_user['user_details'];

    echo $user_name;
    echo sprintf( '<img src="%s">',$user_image );
  // echo"<sript>window.open('login.php','_self');</script>";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Home page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<br><br>
<div class="container">
  <h2>Home Page</h2>
  <a class="btn btn-danger" href="logout.php" >Logout</a>
  


</body>
</html>

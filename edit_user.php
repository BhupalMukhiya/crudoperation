<!DOCTYPE html>
<html lang="en">
<head>
  <title>Edit User</title>
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
  <h2>Edit User</h2>
  
  <?php
  $conn=mysqli_connect('localhost','root','','crudfunction');
  if(isset($_GET['edit'])){
      $edit_id= $_GET['edit'];

      $select="SELECT *from data where user_id='$edit_id'" ;
      $run= mysqli_query($conn,$select);
  
        $row_user= mysqli_fetch_array($run);
        $user_id= $row_user['user_id'];
        $user_name= $row_user['user_name'];
        $user_email= $row_user['user_email'];
        $user_password= $row_user['user_password'];
        $user_image= $row_user['user_image'];
        $user_details= $row_user['user_details'];
   

  }
  ?>    
 
<form action="" method="post" enctype="multipart/form-data">
  <div class="form-group">
      <label for="email">Name:</label>
      <input type="text" class="form-control" value="<?php echo $user_name;?>" placeholder="Name" name="user_name">
    </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control"  value="<?php echo $user_email;?>" placeholder=" email" name="user_email">
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control"  value="<?php echo $user_password;?>" placeholder="Enter password" name="user_password">
    </div>
    <div class="form-group">
      <label>Image:</label>
      <input type="file" class="form-control"  placeholder="Name" name="image">
    </div>
    <div class="form-group">
      <label for="email">Details:</label>
      <textarea class="form-control" name="user_details"><?php echo $user_details;?></textarea>
    </div>
    <input type="submit" name="edit" class="btn btn-primary" />
  </form>

  <?php

session_start();

$errors="";
//connect to database
$conn=mysqli_connect('localhost','root','','crudfunction');

  // code to edit user's data
if(isset($_POST['edit'])){
  if (!empty($_POST['user_name']) or !empty($_POST['user_password']) or !empty($_POST['user_email'])or !empty($_POST['user_details'])){
    $euser_name=$_POST['user_name'];
    $euser_email=$_POST['user_email'];
    $euser_password=$_POST['user_password'];
    $eimage=$_FILES['image']['name'];
    $etmp_name=$_FILES['image']['tmp_name'];
    $euser_details=$_POST['user_details'];

    $target_dir = "upload/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


    if(empty($eimage)){
      $eimage= $user_image;
    }
    
    $update= "UPDATE data SET user_name='$euser_name',user_email='$euser_email',user_password='$euser_password',user_image='$target_file',user_details='$euser_details' where user_id=' $edit_id'";
       
    $run_update=mysqli_query($conn,$update);
    if($run_update===true){
      echo "Data has been updated";
     // move_uploaded_file($eimage_tmp,"upload/$eimage");
      move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

 } else{
      echo "Failed,try again";
    }
  }
}
 ?>

 <a class="btn btn-primary" href="view_user.php">View User</a>
</div>

</body>
</html>

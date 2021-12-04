<!DOCTYPE html>
<html lang="en">
<head>
  <title>Add New User</title>
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
  <h2>Add New User</h2>
  <form action="" method="post" enctype="multipart/form-data">
  <div class="form-group">
      <label for="email">Name:</label>
      <input type="text" class="form-control" placeholder="Name" name="user_name">
    </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" placeholder=" email" name="user_email">
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" placeholder="Enter password" name="user_password">
    </div>
    <div class="form-group">
      <label>Image:</label>
      <input type="file" class="form-control"  placeholder="Name" name="image">
    </div>
    <div class="form-group">
      <label for="email">Details:</label>
      <textarea class="form-control" name="user_details"></textarea>
    </div>
    <input type="submit" name="insert-btn" class="btn btn-primary" />
  </form>

  <?php

session_start();

$errors="";
//connect to database
$conn=mysqli_connect('localhost','root','','crudfunction');

  // code to save user's data
if(isset($_POST['insert-btn'])){
  if (!empty($_POST['user_name']) or !empty($_POST['user_email']) or !empty($_POST['user_password']) or !empty($_POST['user_details'])){
    $user_name=$_POST['user_name'];
    $user_email=$_POST['user_email'];
    $user_password=$_POST['user_password'];
    $image=$_FILES['image']['name'];
    $tmp_name=$_FILES['image']['tmp_name'];
    $user_details=$_POST['user_details'];

    $target_dir = "upload/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

   $insert="INSERT INTO data(user_name,user_email,user_password,user_image,user_details)
     values ('$user_name','$user_email','$user_password','$target_file','$user_details')";
        


       
        $stmt= $conn->prepare($insert);
        $stmt->bind_param("sssss", $user_name,$user_email,$user_password,$target_file,$user_details);
        if($stmt->execute()){
            $_SESSION['msg']="New record is successfully inserted.";
            $_SESSION['alert']="alert alert-success";
             // move_uploaded_file($eimage_tmp,"upload/$eimage");
          move_uploaded_file($tmp_name,$target_file);
    
        }
        $stmt->close();
        $conn->close();
    
    }else{
        $_SESSION['msg']="Data should not be empty.";
        $_SESSION['alert']="alert alert-warning";
    }
    header("location:view_user.php");
}   
       
 ?>
</div>

</body>
</html>

<?php
$login = 0;
$invalid = 0;
if($_SERVER['REQUEST_METHOD']=='POST'){
  include 'connect.php';
  $email = $_POST['email'];
  $password = $_POST['password'];

  $sql = "select * from `login` where email = '$email' and password = '$password'";
  $result = mysqli_query($con,$sql);
  $row = mysqli_fetch_array($result);
  
  if ($result) {
    $num=mysqli_num_rows($result);
    if($num>0){
      $login = 1;
      if($row["user_type"]=="user") {
        session_start();
        $_SESSION['user_type']='user';
        header('location:../../users/civilian.php');
      }
      else if($row["user_type"]== "admin") {
      session_start();
      $_SESSION['user_type']='admin';
      header('location:../../users/admin.php');
    }
    else {
      session_start();
      $_SESSION['user_type']='police';
      header('location:../../users/police.php');
    }
  }
    else{
     $invalid = 1;
    }
  }
}

?>




<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-dpuaG1suU0eT09tx5plTaGMLBsfDLzUCCUXOY2j/LSvXYuG6Bqs43ALlhIqAJVRb" crossorigin="anonymous">

    <title>Log In</title>
  </head>

  <body class="bg-secondary">

  <?php
  if($login) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong></strong> Login Successful.
    
  </div>';
  }
  if ($invalid) {
    echo '<div class="alert alert-danger" role="alert">
    <h6 class="alert-heading">Sorry login failed</h6>
    <p>Invalid Details.</p>
    <hr>
  </div>
  ';
  }
  ?>

  <div style="margin-left: 350px;  background-color:ash; width: 700px;" class="container-sm mt-5  p-5 ml-auto" >
    
  <form action="login.php" method="post" style=" margin-top:100px; padding-left: 140px;">
  <div class="form-group">
    <label for="email">Email address</label>
    <input type="email" class="form-control" style=" width: 280px; " name="email" placeholder="Enter email">
  </div>
  <div class="form-group mt-3">
    <label for="password">Password</label>
    <input type="password" class="form-control" style=" width: 280px;" name="password" placeholder="Password">
  </div>
  <button type="submit" class="btn btn-primary mt-3" style=" width: 280px;">Login</button>
 <a href="sign.php"  class="btn bg-success mt-3" style=" width: 280px;">
 Sign Up
 </a>
</form>
    </div>
  </body>
</html>
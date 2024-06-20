<?php
$login = 0;
$invalid = 0;
if($_SERVER['REQUEST_METHOD']=='POST'){
  include 'connect.php';
  $email = $_POST['email'];
  $password = $_POST['password'];
  $user_type = $_POST['user_type'];


  $sql = "select * from `login` where email = '$email' and password = '$password'";
  $result = mysqli_query($con,$sql);
  if ($result) {
    $num=mysqli_num_rows($result);
    if($num>0){
      $login = 1;
      if ($user_type==='admin'){
        echo'user';
      }else {
      echo 'admin';
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

  <body class="">

  <?php
  if($login) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong></strong> Login Successful.
    
  </div>';
  }
  if ($invalid) {
    echo '<div class="alert alert-danger" role="alert">
    <h4 class="alert-heading">Sorry login failed</h4>
    <p>Invalid Details.</p>
    <hr>
  </div>
  ';
  }
  ?>

  <div class="container-md px-4 mt-5">
    
  <form action="login.php" method="post">
  <div class="form-group">
    <label for="email">Email address</label>
    <input type="email" class="form-control" name="email" placeholder="Enter email">
  </div>
  <div class="form-group mt-3">
    <label for="password">Password</label>
    <input type="password" class="form-control" name="password" placeholder="Password">
  </div>
  <button type="submit" class="btn btn-primary mt-3">Login</button>
</form>
    </div>
  </body>
</html>
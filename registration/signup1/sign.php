<?php
$user=0;
$success=0;
$empty = 0;
if($_SERVER['REQUEST_METHOD']=='POST'){
  include 'connect.php';
  $f_name = $_POST['f_name'];
  $l_name = $_POST['l_name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $nic_no = $_POST['nic_no'];
  $license_no = $_POST['license_no'];
  $contact_no = $_POST['contact_no'];

  if ($f_name == '' ||$l_name == ''||$email == ''||$password == ''||$nic_no == ''||$license_no== ''||$contact_no== '') {
    $empty = 1; 
  }
  else {
  $sql = "select * from `login` where email = '$email' or nic_no = '$nic_no'";
  $result = mysqli_query($con,$sql);
  if ($result) {
    $num=mysqli_num_rows($result);
    if($num>0){
      $user =1;
    }
    else {
      $sql = "insert into `login` (f_name,l_name,email,password,nic_no,license_no,contact_no) Values ('$f_name','$l_name','$email','$password','$nic_no','$license_no','$contact_no')";
      $result = mysqli_query($con,$sql);

      if($result) {
        $success=1;
      }
      else {
        die(mysqli_error( $con));
      }
    }
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

    <title>Sign Up</title>
  </head>
  <body class="bg-secondary">

  <?php
  if($user) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>You cannot signup!</strong> User already exists.
  </div>';
  }
  if($empty) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Enter all details to Sign up</strong>
    
  </div>';
  }
  if ($success) {
    echo '<div class="alert alert-success" role="alert">
    <h4 class="alert-heading">Successfull!</h4>
    <p>Your account has been created.</p>
    <hr>
  </div>
  ';
  }


  ?>
    <div class="container-md px-4 mt-5 ">
    
  <form class="row g-3" action="sign.php" method="post">
  
  <div class="col-5 ">
    <label for="name" class="form-label">First Name</label>
    <input type="text" class="form-control w-50" placeholder="Enter Your First Name" name="f_name">
  </div>

  <div class="col-5">
    <label for="name" class="form-label">Last Name</label>
    <input type="name" class="form-control w-50" placeholder="Enter Your Last Name" name="l_name">
  </div>


  
  <div class="col-md-5">
    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control w-50" placeholder="Enter Your Email" name="email">
  </div>

  <div class=" col-md-5">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control w-50" placeholder="Enter Your Password" name="password">
  </div>

  <div class="col-md-5">
    <label for="name" class="form-label">NIC Number</label>
    <input type="name" class="form-control w-50" placeholder="Enter Your NIC Number" name="nic_no">
  </div>

  <div class="col-md-5">
    <label for="number" class="form-label">License Number</label>
    <input type="number" class="form-control w-50" placeholder="Enter Your License Number" name="license_no">
  </div>

  <div class="col-md-5">
    <label for="number" class="form-label">Contact Number</label>
    <input type="number" class="form-control w-50" placeholder="Enter Your Contact Number" name="contact_no">
  </div>



<div class="col-md-20 mb-3">  
  <button type="submit" class="btn btn-primary ">Sign Up</button>
  
  <a href="login.php" class="btn bg-success ms-5">
   Go Back
   </a> 
</div>
</form>
    </div>
  </body>
</html>
<?php 
$success = 0;
$fail = 0;
$empty = 0;
if($_SERVER['REQUEST_METHOD']=='POST'){
  include '../../registration/signup1/connect.php';
  $email = $_POST['email'];
  $password = $_POST['password'];
  $badge_no = $_POST['badge_no'];
  $user_type = $_POST['user_type'];


  $sql = "select * from `login` where email = '$email' or badge_no = '$badge_no'";
  $result = mysqli_query($con,$sql);
  if($email == '' || $password == '' || $badge_no == ''){
    $empty = 1;
  }else{
   if ($result) {
    $num=mysqli_num_rows($result);
    if($num>0){
      $fail =1;
    }
    else {
      $sql = "insert into `login` (email,password,user_type,badge_no) Values ('$email','$password','$user_type',$badge_no)";
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



<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TTS ADMIN</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-dpuaG1suU0eT09tx5plTaGMLBsfDLzUCCUXOY2j/LSvXYuG6Bqs43ALlhIqAJVRb" crossorigin="anonymous">

  <link rel="stylesheet" href="../style/admin.css">

</head>
<body class="bg-secondary">

<header class="admin-header">
  <a href="" class="mt-3">Admin Dashboard</a>
  
  <div class="logout">
    <a href="../../registration/signup1/login.php"  class="btn btn-secondary mt-3"> Logout </a>
  </div>
</header>

<aside>

    <ul>
      <li>
        <a  href="./add_admin.php">Add Admin</a>
      </li>
      <li>
        <a style="color: white;" href="">Add Police</a>
      </li>
      <li>
        <a href="./paid_fines.php">Fines</a>
      </li>
      
      

    </ul>

</aside>

<div class="main">
<h3>Enter the details of the new Officer</h3>
<?php
  if($success) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong></strong> Successfully Added New Officer.
    
  </div>';
  }
  if($empty) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Enter all details to Sign up</strong>
    
  </div>';
  }

  if ($fail) {
    echo '<div class="alert alert-danger" role="alert">
    <h4 class="alert-heading">Officer already exists</h4>
    <hr>
  </div>
  ';
  }
  ?>

  <div class="container-sm mt-5 p-5 ml-auto">
    
  <form action="add_police.php" method="post" class="ml-auto">
  <div class="form-group">
    <label for="email">Email address</label>
    <input type="email" class="form-control w-50" name="email" placeholder="Enter email">
  </div>
  <div class="form-group mt-3">
    <label for="password">Password</label>
    <input type="password" class="form-control w-50" name="password" placeholder="Password">
  </div>
  <div class="form-group mt-3" hidden>
    <label for="user_type">User Type</label>
    <input type="text" class="form-control w-50" name="user_type" value="police" readonly>
  </div>
  <div class="form-group mt-3">
    <label for="badge_no">Badge Number</label>
    <input type="text" class="form-control w-50" name="badge_no" placeholder="Enter badge number">
  </div>

 <button type="submit" class="btn bg-success mt-3 w-50">Sign Up</button>
 
</form>
    </div>


</div>

</body>
</html>
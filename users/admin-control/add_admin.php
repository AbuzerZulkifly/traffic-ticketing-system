<?php 
$success = 0;
$fail = 0;
if($_SERVER['REQUEST_METHOD']=='POST'){
  include '../../registration/signup1/connect.php';
  $email = $_POST['email'];
  $password = $_POST['password'];
  $user_type = $_POST['user_type'];


  $sql = "select * from `login` where email = '$email'";
  $result = mysqli_query($con,$sql);
  if ($result) {
    $num=mysqli_num_rows($result);
    if($num>0){
      $fail =1;
    }
    else {
      $sql = "insert into `login` (email,password,user_type) Values ('$email','$password','$user_type')";
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
include "admin-header.php";

?>


<div class="main">
<h3>Enter the details of the new Admin</h3>
<?php
  if($success) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong></strong> Successfully Added New Admin.
    
  </div>';
  }
  if ($fail) {
    echo '<div class="alert alert-danger" role="alert">
    <h4 class="alert-heading">Admin already exists</h4>
    <hr>
  </div>
  ';
  }
  ?>

  <div class="container-sm mt-5 p-5 ml-auto">
    
  <form action="add_admin.php" method="post" class="ml-auto">
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
    <input type="text" class="form-control w-50" name="user_type" value="admin" readonly>
  </div>

 <button type="submit" class="btn bg-success mt-3 w-50">Sign Up</button>
 
</form>
    </div>


</div>

</body>
</html>
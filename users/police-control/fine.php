<?php
$user=0;
$success=0;
$empty = 0;
if($_SERVER['REQUEST_METHOD']=='POST'){
  include 'connect.php';
  $f_name = $_POST['rule'];
  $l_name = $_POST['start_date'];
  $email = $_POST['end_date'];
  $password = $_POST['amount'];
  $nic_no = $_POST['nic_no'];
  $license_no = $_POST['license_no'];
  $contact_no = $_POST['contact_no'];

  if ($f_name == '' ||$l_name == ''||$email == ''||$password == ''||$nic_no == ''||$license_no== ''||$contact_no== '') {
    $empty = 1; 
  }
  else {
  $sql = "select * from `fine` where email = '$email'";
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





<aside>

    <ul>
      <li>
        <a style="color: white;" href="">Issue Fine</a>
      </li>
      <li>
        <a  href="fine.php">Check Civilian</a>
      </li>
      <li>
        <a href="fine.php">Rules</a>
      </li>
      <li>
        <a href="fine.php">Unpaid Fines</a>
      </li>
      
      

    </ul>

</aside>

<div class="main">




</div>

</body>
</html>
<?php
$nic_no = $_REQUEST['$nic_no'];
$con=mysqli_connect('localhost','root','','signup');
if($nic_no!==""){
  $sql= mysqli_query($con, "SELECT * FROM `login` WHERE nic_no = $nic_no");
  $row = mysqli_fetch_array($sql);
  $c_name = $row["c_name"];
  $license_no = $row["license_no"];
  $contact_no = $row["contact_no"];
}
$result = array("c_name","license_no","contact_no");
$myJson = json_encode($result);
echo $myJson;
?>
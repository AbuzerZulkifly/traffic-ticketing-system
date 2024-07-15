<?php include "civilian-header.php";
?>

<div class="main mt-5">
 <div class="container"> 
   <form method="post" class="mb-5">
    <input type="text" name="search">
    <button class="btn btn-primary btn-sm" name="submit">Search</button>
   </form>
<table class="table">
<?php 
if(isset($_POST["submit"])){
$search=$_POST['search'];
$sql = "SELECT * FROM fine LEFT JOIN fine_sub ON fine.id = fine_sub.fine_no where fine.id = '$search' and payment = 'pending'";
$result = mysqli_query($con,$sql);


if($result){
  if(mysqli_num_rows($result)> 0){
    echo '
    <thread>
    <tr>
    <th>Fine ID</th>
    <th>Name</th>
    <th>NIC NO</th>
    <th>Vehicle NO</th>
    <th>License NO</th>
    <th>Rule</th>
    <th>Amount</th>
    <th></th>
    ';
    while($row = mysqli_fetch_assoc($result)){
    echo '<tbody>
    <tr>
    <td>'.$row['id'].'</td>
    <td>'.$row['name'].'</td>
    <td>'.$row['nic_no'].'</td>
    <td>'.$row['vehicle_no'].'</td>
    <td>'.$row['license_no'].'</td>
    <td>'.$row['rule'].'</td>
    <td>'.$row['amount'].'</td>
    </tr>
    </tbody>';
    }}

    else{
      echo "<h3>Invalid Fine ID or Fine Has Been Paid</h3>";
    }
}
}
?>

</table>
<form method="post" action="success.php">
<a href="success.php" target="_blank"> <button class="btn btn-primary" name="action" value="update">Pay</button> </a>
</form>
</div>
</div>

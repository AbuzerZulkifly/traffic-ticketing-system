<?php
include "police-header.php";

?>

<div class="main">
<div class="container my-5">
    <form method="post" class="mt-4">
       
         <h2>Search for already existing fine:</h2>
                 
                 <input type="text" class="form-control w-50" name="search"  placeholder="Enter NIC NO">
                 <button class="btn btn-primary mt-4" name="submit">Filter</button>
                 
       
    </form>
    
    <div class="container my-5">
        <table class="table">
          <?php
          include '../../registration/signup1/connect.php';
          
          if(isset($_POST['submit'])){
          $search = $_POST['search'];
          $sql = "SELECT * FROM fine LEFT JOIN fine_sub on fine.id = fine_sub.fine_no where nic_no = '$search'";
          $result = mysqli_query($con,$sql);

          if($result){
            if(mysqli_num_rows($result)> 0){
              echo '
              <thread>
              <tr>
              <th>Name</th>
              <th>NIC NO</th>
              <th>Vehicle NO</th>
              <th>License NO</th>
              <th>Rule</th>
              <th>Amount</th>
              ';
              $row = mysqli_fetch_assoc($result);
              echo '<tbody>
              <tr>
              <td>'.$row['name'].'</td>
              <td>'.$row['nic_no'].'</td>
              <td>'.$row['vehicle_no'].'</td>
              <td>'.$row['license_no'].'</td>
              <td>'.$row['rule'].'</td>
              <td>'.$row['amount'].'</td>
              </tr>
              </tbody>';
            }
            else{
              echo '<h2>This Civilian has no pending fines</h2>';
            }


        }
      }
          
          ?>

          
        </table>

    </div>
</body>
</html>
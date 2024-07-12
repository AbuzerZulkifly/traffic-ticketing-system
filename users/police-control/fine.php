<?php
include "police-header.php";

  
?>

<div class="main">
  <?php 
  $user = 0;
include '../../registration/signup1/connect.php';
if(isset($_POST["submit"])){

  $c_name=mysqli_real_escape_string($con,$_POST["c_name"]);
  $nic_no=mysqli_real_escape_string($con,$_POST["nic_no"]);
  $license_no=mysqli_real_escape_string($con,$_POST["license_no"]);
  $contact_no=mysqli_real_escape_string($con,$_POST["contact_no"]);
  $vehicle_no=mysqli_real_escape_string($con,$_POST["vehicle_no"]);
  $police_no=mysqli_real_escape_string($con,$_POST["police"]);
  $issue_date=date("Y-m-d",strtotime($_POST["s_date"]));
  $end_date=date("Y-m-d",strtotime($_POST["d_date"]));
  $grand_total=mysqli_real_escape_string($con,$_POST["grand_total"]);
  
  

  $sql = "select * from `login` where nic_no = '$nic_no' or license_no = '$license_no'";
  $result = mysqli_query($con,$sql);
  if ($result) {
    $num=mysqli_num_rows($result);
    if($num<1){
     $user = 1;
    }

  else{
  $sql="insert into fine (name,nic_no,license_no,contact_no,vehicle_no,police_id,start_date,end_date,total) values ('{$c_name}','{$nic_no}','{$license_no}','{$contact_no}','{$vehicle_no}','{$police_no}','{$issue_date}','{$end_date}','{$grand_total}') ";
  if($con->query($sql)){
    $id=$con->insert_id;
    
    $sql2="insert into fine_sub (fine_no,rule,amount) values ";
    $rows=[];
    for($i=0;$i<count($_POST["pname"]);$i++)
    {
      $pname=mysqli_real_escape_string($con,$_POST["pname"][$i]);
      $price=mysqli_real_escape_string($con,$_POST["price"][$i]);
      $rows[]="('{$id}','{$pname}','{$price}')";
    }
    $sql2.=implode(",",$rows);
    if($con->query($sql2)){
      echo "<div class='alert alert-success'>Fine Issued Successfully. <a href='print.php?id={$id}' target='_BLANK'>Click </a> here to Print Fine </div> ";
    }else{
      echo "<div class='alert alert-danger'>Fine Added Failed.</div>";
    }
  }else{
    echo "<div class='alert alert-danger'>Fine Added Failed.</div>";
  }
}
  }
}


$now = date('Y-m-d');
$start_date = strtotime($now);
$end_date = strtotime("+7 day", $start_date);
if($user) {
  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>You cannot signup!</strong> User already exists.
</div>';
}
  ?>
<div class="container-md px-4 mt-5 ">
    
    <form class="row g-3" action="fine.php" method="post">


    <div class="col-5 ">
      <label for="name" class="form-label">Civilian Name</label>
      <input type="text" class="form-control w-50" placeholder="Enter Civilian Name" name="c_name" id="c_name">
    </div>
  
    
    <div class="col-md-5">
      <label for="name" class="form-label">NIC Number</label>
      <input type="text" class="form-control w-50" placeholder="Enter Civilian NIC Number" name="nic_no" id="nic_no" 
      onkeyup="GetDetails(this.value)" >
    </div>
  
    <div class="col-md-5">
      <label for="number" class="form-label">License Number</label>
      <input type="text" class="form-control w-50" placeholder="Enter Civilian License Number" name="license_no" id="license_no">
    </div>
  
    <div class="col-md-5">
      <label for="number" class="form-label">Contact Number</label>
      <input type="number" class="form-control w-50" placeholder="Enter Civilian Contact Number" name="contact_no" id="contact_no">
    </div>

    <div class="col-md-5">
      <label for="number" class="form-label">Vehicle Number</label>
      <input type="text" class="form-control w-50" placeholder="Enter Vehicle Number" name="vehicle_no">
    </div>

    <div class="col-md-5">
      <label for="number" class="form-label">Police ID</label>
      <input type="text" class="form-control w-50" placeholder="Enter Police ID" name="police">
    </div>


    <div class="col-md-5">
      <label for="s_date" class="form-label">Issued Date</label>
      <input type="date" class="form-control w-50"  name="s_date" value="<?php echo $now; ?>" readonly>
    </div>
  
    <div class="col-md-5">
      <label for="d_date" class="form-label">Deadline Date</label>
      <input type="date" class="form-control w-50" name="d_date">
    </div>

  <div class='row'>
          <div class='col-md-10'>
            <h5 class=''>Fine Details</h5>
            <table class='table table-bordered'>
              <thead>
                <tr>
                  <th>Rule</th>
                  <th>Amount</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id='product_tbody'>
                <tr>
                  <td><input type='text' required name='pname[]' class='form-control'></td>
                  <td><input type='text' required name='price[]' class='form-control price'></td>
                  <td><input type='button' value='Remove' class='btn btn-danger btn-sm btn-row-remove'>

                </tr>
              </tbody>
              <tfoot>
                <tr>
                <td colspan='1' class='text-left'></td>
                  <td>Total:<input type='text' name='grand_total' id='grand_total' class='form-control' required></td>
                  <td><input type='button' value='+ Add Row' class='btn btn-primary mt-4' id='btn-add-row'> </td>
                  </td>
                </tr>
              </tfoot>
            </table>
            <input type='submit' name='submit' value='Issue Fine' class='btn btn-success float-right'>
          </div>
        </div>
  </form>
      </div>
      <script>
      $(document).ready(function(){
        $("#date").datepicker({
          dateFormat:"dd-mm-yy"
        });
        
        $("#btn-add-row").click(function(){
          var row="<tr> <td><input type='text' required name='pname[]' class='form-control'></td> <td><input type='text' required name='price[]' class='form-control price'></td>  <td><input type='button' value='Remove' class='btn btn-danger btn-sm btn-row-remove'> </tr>";
          $("#product_tbody").append(row);
        });
        
        $("body").on("click",".btn-row-remove",function(){
          if(confirm("Are You Sure?")){
            $(this).closest("tr").remove();
            grand_total();
          }
        });

        $("body").on("keyup",".price",function(){
          var price=Number($(this).val());
          var qty=Number($(this).closest("tr").find(".qty").val());
          $(this).closest("tr").find(".total").val(price*qty);
          grand_total();
        });
        
        function grand_total(){
          var tot=0;
          $(".total").each(function(){
            tot+=Number($(this).val());
          });
          $("#grand_total").val(tot);
        }});

        function GetDetails(str) {
        if(str.length == 0) {
          document.getElementById("c_name").value = "";
          document.getElementById("contact_no").value = "";
          document.getElementById("license_no").value = "";
         return;
        }
        else { 
  
  // Creates a new XMLHttpRequest object 
  var xmlhttp = new XMLHttpRequest(); 
  xmlhttp.onreadystatechange = function () { 

      // Defines a function to be called when 
      // the readyState property changes 
      if (this.readyState == 4 &&  
              this.status == 200) { 
            
          // Typical action to be performed 
          // when the document is ready 
          var myObj = JSON.parse(this.responseText); 

          // Returns the response data as a 
          // string and store this array in 
          // a variable assign the value  
          // received to first name input field 
            
          document.getElementById 
              ("c_name").value = myObj[0]; 
            
          // Assign the value received to 
          // last name input field 
          document.getElementById( 
              "license_no").value = myObj[1];
              document.getElementById( 
              "contact_no").value = myObj[2]; 
      } 
  }; 

  // xhttp.open("GET", "filename", true); 
  xmlhttp.open("GET", "fine.php?nic_no=" + str, true); 
    
  xmlhttp.send(); 
} 


        }
///////////////

    </script>
    </body>
  </html>
</div>


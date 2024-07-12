<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "signup";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
include "admin-header.php";
?>



<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TTS ADMIN</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-dpuaG1suU0eT09tx5plTaGMLBsfDLzUCCUXOY2j/LSvXYuG6Bqs43ALlhIqAJVRb" crossorigin="anonymous">

  <link rel="stylesheet" href="../style/admin.css">

</head>
<div class="main" style="padding-left:160px">

<div class="container">
    
    <form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="mb-4">
        <div class="form-row">
       <div>

         <h2>Filter Fine By:</h2>
                 <div class="col-1 mb-3">
                <select name="status" id="status" class="form-control">
                    <option value="">All</option>
                    <option value="pending" <?php if(isset($_GET['status']) && $_GET['status'] == 'pending') echo 'selected'; ?>>Pending</option>

                    <option value="paid" <?php if(isset($_GET['status']) && $_GET['status'] == 'paid') echo 'selected'; ?>>Paid</option>
                </select>
                
          </div>
       </div>
        

          <div class="row-1">
          <button type="submit" class="btn btn-primary">Filter</button>
          </div>
            
        </div>
    </form>
    
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Rule</th>
                    <th>Name</th>
                    <th>license No</th>
                    <th>Nic No</th>
                    <th>Contact No</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // PHP code for database connection and data retrieval
                // Assume $conn is your database connection object
                
                // Your database connection code goes here
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "signup";

                try {
                    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                } catch(PDOException $e) {
                    echo "Connection failed: " . $e->getMessage();
                    exit;
                }
                
                // SQL query based on filter
                $sql = "SELECT * FROM fine LEFT JOIN fine_sub on fine.id = fine_sub.fine_no";
                
                // Check if filter is set
                if(isset($_GET['status']) && !empty($_GET['status'])) {
                    $category = $_GET['status'];
                    $sql .= " WHERE payment = :category_id";
                }
                
                // Prepare statement
                $stmt = $conn->prepare($sql);
                
                // Bind parameter if category filter is set
                if(isset($category)) {
                    $stmt->bindParam(':category_id', $category);
                }
                
                // Execute statement
                $stmt->execute();
                
                // Fetch and display data
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['rule'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['license_no'] . "</td>";
                    echo "<td>" . $row['nic_no'] . "</td>";
                    echo "<td>" . $row['contact_no'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
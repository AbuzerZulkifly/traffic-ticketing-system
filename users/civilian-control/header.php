<?php 
session_start();

?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-dpuaG1suU0eT09tx5plTaGMLBsfDLzUCCUXOY2j/LSvXYuG6Bqs43ALlhIqAJVRb" crossorigin="anonymous">

  <link rel="stylesheet" href="../style/admin.css">
</head>
<body class="bg-secondary">
<header class="admin-header">
  <div>
    <a href="" class="mt-3">Civilian Dashboard</a>
  </div>
  
  <div class="usertype">
      <?php if (isset($_SESSION['user_type'])) ?>
      <?= $_SESSION['user_type'] ?>
  </div>

  
  <div class="logout">
    <a href="../../registration/signup1/login.php"  class="btn btn-secondary mt-3"> Logout </a>
  </div>
</header>

<aside>

    <ul>
      <li>
        <a href="./add_vehicle.php">Add/Remove Vehicle</a>
      </li>
      <li>
        <a href="./fine.php">Fines</a>
      </li>
      
      

    </ul>

</aside>
<div class="main"></div>
</body>
</html>
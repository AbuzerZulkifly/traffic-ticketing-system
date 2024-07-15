<?php 
session_start()
?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-dpuaG1suU0eT09tx5plTaGMLBsfDLzUCCUXOY2j/LSvXYuG6Bqs43ALlhIqAJVRb" crossorigin="anonymous">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="../style/admin.css?v=<?php echo time(); ?>">
</head>
<body class="bg-secondary">

<div class="menu-bar">
<ul>
  <div>
    <li><a href="#">ADMIN</a></li>
  </div>  
</ul>

<ul>
  <div>
    <li><a class="btn btn-secondary ms-5" href="../../registration/signup1/login.php">Logout</a></li>
  </div>
</ul>

<ul style="margin-left:40px">
  <div class="user-menu  me-1">
    <li>
      <a href="" class="btn btn-success">User</a>
    </li>
  
 <div class="dropdown">
    <ul>
      <li><a href=""><?php echo $_SESSION['email'];  ?></a></li>
    </ul>
  </div>
</div>
    </li>
  </div>
</ul>



<div class="side-bar">
<div>    
  <ul>
    <li>
      <a href="add_admin.php">Add Admin</a>
    </li>
  </ul>
</div>

<div>    
  <ul>
    <li>
      <a href="add_police.php">Add Police</a>
    </li>
  </ul>
</div>
     
<div>    
  <ul>
    <li>
      <a href="paid_fines.php">Fines</a>
    </li>
  </ul>
</div>
</div>

<div class="main">
  asd
</div>
</body>
</html>
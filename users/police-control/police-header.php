<?php 
session_start()
?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-dpuaG1suU0eT09tx5plTaGMLBsfDLzUCCUXOY2j/LSvXYuG6Bqs43ALlhIqAJVRb" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    <link rel='stylesheet' href='https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css'>
    <script src="https://code.jquery.com/ui/1.13.0-rc.3/jquery-ui.min.js" integrity="sha256-R6eRO29lbCyPGfninb/kjIXeRjMOqY3VWPVk6gMhREk=" crossorigin="anonymous"></script>

    

  <link rel="stylesheet" href="../style/admin.css?v=<?php echo time(); ?>">
</head>
<body class="bg-secondary">

<div class="menu-bar">
<ul>
  <div>
    <li><a href="#">POLICE DASHBOARD</a></li>
  </div>  
</ul>

<ul>
  <div>
    <li><a class="btn btn-secondary ms-5" href="../../registration/signup1/login.php">Logout</a></li>
  </div>
</ul>

<ul>
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
    <a href="./check_civilian.php">Check Civilian</a>
    </li>
  </ul>
</div>

<div>    
  <ul>
    <li>
    <a href="./fine.php">Issue Fine</a>
    </li>
  </ul>
</div>
     
<div>    
  <ul>
    <li>
    <a href="./rules.php">Rules</a>
    </li>
  </ul>
</div>
</div>

<div class="main">
  
</div>
</body>
</html>
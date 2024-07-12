<?php
include "police-header.php";

if (!isset($_SESSION["email"])){
  header('location:./../../registration/signup1/login.php');
}
?>

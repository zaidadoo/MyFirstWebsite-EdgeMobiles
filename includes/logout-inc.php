<?php

session_start();

if(isset($_SESSION['s_id'])){
  
  session_start();
  session_unset();
  session_destroy();
  header("Location: ../login.php?login=logout");
  exit();
  
} else {
  
  header("Location: ../login.php");
  exit();
  
}
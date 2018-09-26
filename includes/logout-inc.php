<?php

session_start();

include 'dbh-inc.php';

if(isset($_SESSION['s_id'])){
 
  $username = $_SESSION['s_user'];

if($username == 'admin'){
  
  $sql = "DELETE * FROM admin_session";
  $result = mysqli_query($conn, $sql);
  session_start();
  session_unset();
  session_destroy();
  header("Location: ../login.php?login=logout");
  exit();
  
} else {
   
  session_start();
  session_unset();
  session_destroy();
  header("Location: ../login.php?login=logout");
  exit();
}
  
} else {
  
  header("Location: ../login.php");
  exit();
  
}
<?php

session_start();

include 'dbh-inc.php';

if(isset($_SESSION['s_id'])){
    
  if(($_SESSION['s_user']) == 'admin'){
            
            $sql = "DELETE FROM admin_session";
            $result = mysqli_query($conn, $sql);
            
          }
  
  session_start();
  session_unset();
  session_destroy();
  header("Location: ../login.php?login=logout");
  exit();

  
} else {
  
  header("Location: ../login.php");
  exit();
  
}
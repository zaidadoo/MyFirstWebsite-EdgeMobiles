<?php

include 'includes/dbh-inc.php';

$username = "none";

if(isset($_SESSION['s_user'])){
  
  $username = $_SESSION['s_user'];

}

if($username == "admin"){
  
  include_once 'footer-admin.php';
  
} else {
  
  include_once 'footer-user.php';
  
}
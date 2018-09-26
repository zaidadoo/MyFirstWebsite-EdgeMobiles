<?php 

session_start();

$username = 'gayboi';

if(isset($_SESSION['s_user'])){
  
  $username = $_SESSION['s_user'];
  
}

if($username == 'admin'){
  
  echo "is admin<br>";
  
}

echo $username;
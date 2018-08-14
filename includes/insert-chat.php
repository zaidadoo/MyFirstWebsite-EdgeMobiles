<?php

session_start();

include 'dbh-inc.php';

$account_id = $_SESSION['s_id'];
$c_user = $_SESSION['s_user'];
$message = mysqli_real_escape_string($conn, $_POST['message']);

if(!isset($_POST['submit'])){
  
  header("Location: ../chat.php");
  exit();
  
} else {
  
  $sql = "SELECT * FROM chat_session";
  $result = mysqli_query($conn, $sql);
  $resultcheck = mysqli_num_rows($result);
  
  if($resultcheck > 0){
    
    while($row = mysqli_fetch_array($result)){
      
      $check_id = $row['account_id'];
      
    }
    
  }
  
  if(($resultcheck < 1) && $c_user != 'admin'){
    
  $sql = "INSERT INTO chat_session (session, account_id) VALUES ('1', '$account_id')";
  $result = mysqli_query($conn, $sql);
    
    $sql = "INSERT INTO chat (message, account_id) VALUES ('$message', '$account_id')";
    $result = mysqli_query($conn, $sql);
    header("Location: ../chat.php");
    exit();
    
   } elseif(($account_id == $check_id) || $c_user == 'admin') {
    
    $sql = "INSERT INTO chat (message, account_id) VALUES ('$message', '$account_id')";
    $result = mysqli_query($conn, $sql);
    header("Location: ../chat.php");
    exit();
    
  } else {
    
    header("Location: ../chat.php");
    exit();
    
  }
}


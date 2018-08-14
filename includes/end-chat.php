<?php

session_start();

$account_id = $_SESSION['s_id'];
$c_user = $_SESSION['s_user'];

include 'dbh-inc.php';

$sql = "SELECT * FROM chat_session";
  $result = mysqli_query($conn, $sql);
  $resultcheck = mysqli_num_rows($result);

if($resultcheck > 0){
    
    while($row = mysqli_fetch_array($result)){
      
      $check_id = $row['account_id'];
      
    }
    
  }


if(!isset($_POST['end'])){
  
  header("Location: ../chat.php");
  exit();
  
} elseif(($account_id == $check_id) || $c_user == 'admin') {
  
  $sql = "DELETE FROM `chat`";
  $result = mysqli_query($conn, $sql);
  $sql = "DELETE FROM `chat_session`";
  $result = mysqli_query($conn, $sql);
  header("Location: ../chat.php");
  exit();
  
} else {
  
  header("Location: ../chat.php");
  exit();
  
}
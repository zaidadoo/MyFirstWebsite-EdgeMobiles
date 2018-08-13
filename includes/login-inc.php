<?php

session_start();

if(isset($_POST['submit'])){
  
  include 'dbh-inc.php';
  
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  
  //Error Handlers
  
  //Check if empty
  
  if(empty($username) || empty($password)){
    
    header("Location: ../login.php?login=empty");
    exit();
    
  } else {
    
    $sql = "SELECT * FROM accounts WHERE username='$username' OR email='$username'";
    $result = mysqli_query($conn, $sql);
    $resultcheck = mysqli_num_rows($result);
    
    if($resultcheck < 1){
      
      header("Location: ../login.php?login=error");
      exit();
      
    } else {
      
      if($row = mysqli_fetch_assoc($result)){
        
        //Dehash password
        
        $hashedpwdcheck = password_verify($password, $row['password']);
        if($hashedpwdcheck == false){
          
          header("Location: ../login.php?login=error");
          exit();
          
        } elseif($hashedpwdcheck == true){
          
          //Access granted
          
          $_SESSION['s_id'] = $row['account_id']; 
          $_SESSION['s_user'] = $row['username']; 
          $_SESSION['s_pass'] = $row['password']; 
          $_SESSION['s_name'] = $row['name']; 
          $_SESSION['s_email'] = $row['email']; 
          
          $id = $_SESSION['s_id'];
          
          $sql = "SELECT * FROM address WHERE account_id = '$id'";
          $result = mysqli_query($conn, $sql);
          $resultcheck = mysqli_num_rows($result);
          
          if($resultcheck < 1){
          
            $_SESSION['s_phone'] = NULL; 
            $_SESSION['s_street'] = NULL; 
            $_SESSION['s_building'] = NULL; 
            $_SESSION['s_floor'] = NULL; 
            $_SESSION['s_apartment'] = NULL; 
            $_SESSION['s_notes'] = NULL; 
            header("Location: ../login.php?login=success");
            exit();
            
          } elseif($row = mysqli_fetch_assoc($result)){
          
            $_SESSION['s_phone'] = $row['phone']; 
            $_SESSION['s_street'] = $row['street']; 
            $_SESSION['s_building'] = $row['building']; 
            $_SESSION['s_floor'] = $row['floor']; 
            $_SESSION['s_apartment'] = $row['apartment']; 
            $_SESSION['s_notes'] = $row['notes']; 
            
            header("Location: ../login.php?login=success");
            exit();
            
          } 
          
        }
        
      }
      
    }
    
  }
  
} else {
  
  header("Location: ../login.php");
  exit();
  
}
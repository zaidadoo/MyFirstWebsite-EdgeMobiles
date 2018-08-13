<?php

if(isset($_POST['submit'])) {
  
  include_once 'dbh-inc.php';
  
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  
  //Error Handlers
  
  //Empty Fields Checker
  if(empty($username) || empty($password) || empty($name) || empty($email)){
    
    header("Location: ../signup.php?signup=empty");
    exit();
    
  } else {
    
    //Check if input char are valid
    
    if(!preg_match("/^[a-zA-Z ]*$/", $name)){
      
      header("Location: ../signup.php?signup=invalid");
      exit();
      
    } else {
      
      //Email validity
      
      if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        
        header("Location: ../signup.php?signup=email");
        exit();
        
      } else {
        
        $sql = "SELECT * FROM accounts WHERE username='$username' OR email='$email'";
        $result = mysqli_query($conn, $sql);
        $result_check = mysqli_num_rows($result);
        
        if($result_check > 0){
          
          header("Location: ../signup.php?signup=usertaken");
          exit();
          
        } else {
          
          //Hashing password
          
          $hashedpwd = password_hash($password, PASSWORD_DEFAULT);
          
          //Inserting account in db
          
          $sql = "INSERT INTO accounts (username, password, email, name) VALUES ('$username', '$hashedpwd', '$email', '$name');";
          mysqli_query($conn, $sql);
          header("Location: ../signup.php?signup=success");
          exit();
          
        }
        
      }
      
    }
    
  }
  
  
} else {
  
  header("Location: ../signup.php");
  exit();
    
}
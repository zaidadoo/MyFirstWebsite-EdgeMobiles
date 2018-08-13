<?php

session_start();

if(isset($_POST['submit'])) {
  
  include_once 'dbh-inc.php';
  
  $id = $_SESSION['s_id'];
  $username = $_SESSION['s_user'];
  $password = $_SESSION['s_pass'];
  $name = $_SESSION['s_name'];
  $email = $_SESSION['s_email'];
    
  $newpassword = mysqli_real_escape_string($conn, $_POST['new-password']);
  $verifypassword = mysqli_real_escape_string($conn, $_POST['verify-password']);
  $newname = mysqli_real_escape_string($conn, $_POST['name']);
  $newemail = mysqli_real_escape_string($conn, $_POST['email']);
  
  //Error Handlers
  
  //Empty Fields Checker
  if(empty($newpassword) && empty($verifypassword) && empty($newname) && empty($newemail)){
    
    header("Location: ../account.php?account=empty");
    exit();
    
  } elseif($newpassword != $verifypassword){
    
    header("Location: ../account.php?account=password");
    exit();
    
  } elseif(empty($newpassword) && empty($verifypassword) && empty($newname)){
      
      //Verify Email
    
      if(!filter_var($newemail, FILTER_VALIDATE_EMAIL)){
        
        header("Location: ../account.php?account=email");
        exit();
      
    } else {
        
         //Check if taken
         $sql = "SELECT * FROM accounts WHERE email='$newemail'";
         $result = mysqli_query($conn, $sql);
         $result_check = mysqli_num_rows($result);
          
          if($result_check > 0){
           
           header("Location: ../account.php?account=emailtaken");
           exit();
        
          } else {
            
            $sql = "UPDATE accounts SET email = '$newemail' WHERE account_id = '$id';";
            mysqli_query($conn, $sql);
            $_SESSION['s_email'] = $newemail;
            header("Location: ../account.php?account=emailsuccess");
            exit();
            
          }
        
      }
    
  } elseif(empty($newpassword) && empty($verifypassword) && empty($newemail)){
    
    //Name check
    if(!preg_match("/^[a-zA-Z ]*$/", $newname)){
      
      header("Location: ../account.php?account=name");
      exit();
      
    } else {
      
      $sql = "UPDATE accounts SET name = '$newname' WHERE account_id = '$id';";
      mysqli_query($conn, $sql);
      $_SESSION['s_name'] = $newname;
      header("Location: ../account.php?account=namesuccess");
      exit();
      
    }
    
  } elseif(empty($newpassword) && empty($verifypassword)){
    
    if(!preg_match("/^[a-zA-Z ]*$/", $newname)){
      
      header("Location: ../account.php?account=name");
      exit();
      
    } elseif(!filter_var($newemail, FILTER_VALIDATE_EMAIL)){
      
      header("Location: ../account.php?account=email");
      exit();
      
    } else {
      
      $sql = "UPDATE accounts SET name = '$newname', email = '$newemail' WHERE account_id = '$id';";
      mysqli_query($conn, $sql);
      $_SESSION['s_name'] = $newname;
      $_SESSION['s_email'] = $newemail;
      header("Location: ../account.php?account=emailnamesuccess");
      exit();
      
    }
    
  } elseif(empty($newemail) && empty($newname)){
    
    $hash = password_hash($newpassword, PASSWORD_DEFAULT);
    $sql = "UPDATE accounts SET password = '$hash' WHERE account_id = '$id';";
    mysqli_query($conn, $sql);
    $_SESSION['s_pass'] = $hash;
    header("Location: ../account.php?account=passwordsuccess");
    exit();
    
  } elseif(empty($newemail)){
    
    if(!preg_match("/^[a-zA-Z ]*$/", $newname)){
      
      header("Location: ../account.php?account=name");
      exit();
      
    } else {
      
      $hash = password_hash($newpassword, PASSWORD_DEFAULT);
      $sql = "UPDATE accounts SET name = '$newname', password = '$hash' WHERE account_id = '$id';";
      mysqli_query($conn, $sql);
      $_SESSION['s_name'] = $newname;
      $_SESSION['s_pass'] = $hash;
      header("Location: ../account.php?account=passwordnamesuccess");
      exit();
      
    }
    
  } elseif(empty($newname)){
    
    if(!filter_var($newemail, FILTER_VALIDATE_EMAIL)){
      
      header("Location: ../account.php?account=email");
      exit();
      
    } else{
      
      $sql = "SELECT * FROM accounts WHERE email='$newemail'";
      $result = mysqli_query($conn, $sql);
      $result_check = mysqli_num_rows($result);
          
          if($result_check > 0){
            
            header("Location: ../account.php?account=emailtaken");
            exit();
            
          } else {
      
      $hash = password_hash($newpassword, PASSWORD_DEFAULT);
      $sql = "UPDATE accounts SET password = '$hash', email = '$newemail' WHERE account_id = '$id';";
      mysqli_query($conn, $sql);
      $_SESSION['s_email'] = $newemail;
      $_SESSION['s_pass'] = $hash;
      header("Location: ../account.php?account=passwordemailsuccess");
      exit();
      
    }
    }
  } elseif(!preg_match("/^[a-zA-Z ]*$/", $newname)){
      
      header("Location: ../account.php?account=name");
      exit();
      
    } elseif(!filter_var($newemail, FILTER_VALIDATE_EMAIL)){
    
      header("Location: ../account.php?account=email");
      exit();
    
  } else {
      
      $sql = "SELECT * FROM accounts WHERE email='$newemail'";
      $result = mysqli_query($conn, $sql);
      $result_check = mysqli_num_rows($result);
      
      if($result_check > 0){
        
        header("Location: ../account.php?account=emailtaken");
        exit();
        
      } else {
        
    $hash = password_hash($newpassword, PASSWORD_DEFAULT);
    $sql = "UPDATE accounts SET password = '$hash', email = '$newemail', name = '$newname' WHERE account_id = '$id';";
    mysqli_query($conn, $sql);
    $_SESSION['s_email'] = $newemail;
    $_SESSION['s_name'] = $newname;
    $_SESSION['s_pass'] = $hash;
    header("Location: ../account.php?account=allsuccess");
    exit();
        
      }
  }
  
} else {
  
  header("Location: ../login.php");
  exit();
    
}
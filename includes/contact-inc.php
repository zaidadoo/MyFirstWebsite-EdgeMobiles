<?php 

session_start();

include 'dbh-inc.php';

if(!isset($_POST['submit'])){
  
  header("Location: ../contact.php");
  exit();
  
} else {
  
  if(isset($_SESSION['s_user'])){ 
    $username = $_SESSION['s_user']; 
  } else {
    
    $username = "";
    
  }
  
  $name = mysqli_real_escape_string($_POST['name']);
  $email = mysqli_real_escape_string($_POST['email']);
  $phone = mysqli_real_escape_string($_POST['phone']);
  $message = mysqli_real_escape_string($_POST['message']);
  
  if(empty($name) || empty($message)){
    
    header("Location: ../contact.php?contact=empty");
    exit();
    
  } elseif(empty($email) && empty($phone)){
    
    header("Location: ../contact.php?contact=empty_contact");
    exit();
    
  } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        
        header("Location: ../contact.php?contact=email");
        exit();
        
      } elseif(!preg_match("/^[a-zA-Z ]*$/", $name)){
      
      header("Location: ../contact.php?contact=invalid");
      exit();
    
     } else {
    
    $mailTo = "zaidadoo@gmail.com";
    $headers = "From: ".$email;
    $subject = "Contact Notification";
    $txt = "Message received from ".$name."\n".$email."\n".$phone."\n".$username."\nMessage:\n".$message.""
    mail($mailTo, $subject, $txt, $headers);
    header("Location: ../contact.php?contact=sent");
    
  }
}
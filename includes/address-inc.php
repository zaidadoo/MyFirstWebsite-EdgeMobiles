<?php

session_start();

if(isset($_POST['submit'])) {
  
  include_once 'dbh-inc.php';
  
  $id = $_SESSION['s_id'];
  $username = $_SESSION['s_user'];
  $password = $_SESSION['s_pass'];
  $name = $_SESSION['s_name'];
  $email = $_SESSION['s_email'];
    
  $phone = mysqli_real_escape_string($conn, $_POST['phone']);
  $phone = htmlspecialchars($phone);
  $city = mysqli_real_escape_string($conn, $_POST['city']);
  $city = htmlspecialchars($city);
  $street = mysqli_real_escape_string($conn, $_POST['street']);
  $street = htmlspecialchars($street);
  $building = mysqli_real_escape_string($conn, $_POST['building']);
  $building = htmlspecialchars($building);
  $floor = mysqli_real_escape_string($conn, $_POST['floor']);
  $floor = htmlspecialchars($floor);
  $apartment = mysqli_real_escape_string($conn, $_POST['apartment']);
  $apartment = htmlspecialchars($apartment);
  $notes = mysqli_real_escape_string($conn, $_POST['notes']);
  $notes = htmlspecialchars($notes);
  
  //Error Handlers
  //Empty Fields Checker
  if(empty($phone) || empty($city) || empty($street) || empty($building)){
    
    header("Location: ../account.php?account=addressempty");
    exit();
    
  } else {
    
    //Check if already address there
    $sql = "SELECT * FROM address WHERE account_id = '$id'";
    $result = mysqli_query($conn, $sql);
    $result_check = mysqli_num_rows($result);
    
    if($result_check > 0){
      
      $sql = "UPDATE address SET phone = '$phone', street = '$street', building = '$building', floor = '$floor', apartment = '$apartment', notes = '$notes' WHERE account_id = '$id';";
      mysqli_query($conn, $sql);
      $_SESSION['s_phone'] = $phone;
      $_SESSION['s_street'] = $street;
      $_SESSION['s_building'] = $building;
      $_SESSION['s_floor'] = $floor;
      $_SESSION['s_apartment'] = $apartment;
      $_SESSION['s_notes'] = $notes;
      header("Location: ../account.php?account=successaddress");
      exit();
      
    } else {
      
      $sql = "INSERT INTO address (account_id, phone, city, street, building, floor, apartment, notes) VALUES ('$id', '$phone', '$city', '$street', '$building', '$floor', '$apartment', '$notes');";
      mysqli_query($conn, $sql);
      $_SESSION['s_phone'] = $phone;
      $_SESSION['s_street'] = $street;
      $_SESSION['s_building'] = $building;
      $_SESSION['s_floor'] = $floor;
      $_SESSION['s_apartment'] = $apartment;
      $_SESSION['s_notes'] = $notes;
      header("Location: ../account.php?account=successaddress");
      exit();
      
    }
    
  }
  
} else {
  
  header("Location: ../login.php");
  exit();
  
}
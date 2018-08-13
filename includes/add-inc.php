<?php

session_start();

include 'dbh-inc.php';

// Parse the form data and add inventory item to the system
if (isset($_POST['button'])) {
	
  $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
	$price = mysqli_real_escape_string($conn, $_POST['price']);
	$category = mysqli_real_escape_string($conn, $_POST['category']);
	$subcategory = mysqli_real_escape_string($conn, $_POST['subcategory']);
	$details = mysqli_real_escape_string($conn, $_POST['details']);
  
  if(empty($product_name) || empty($price) || empty($category) || empty($subcategory) || empty($details)){
    
    $_SESSION['product_name'] = $product_name;
    $_SESSION['price'] = $price;
    $_SESSION['details'] = $details;
    
    header("Location: ../inventory_list.php?inventory_list=empty");
		exit();
    
           } else {
           
	// See if that product name is an identical match to another product in the system
	$sql = "SELECT id FROM products WHERE product_name = '$product_name' LIMIT 1";
  $result = mysqli_query($conn, $sql);  
	$productMatch = mysqli_num_rows($result); // count the output amount
    
    if ($productMatch > 0) {
      
      $_SESSION['product_name'] = $product_name;
      $_SESSION['price'] = $price;
      $_SESSION['details'] = $details;
        
      
		echo 'Duplicate product name found in system, please go back and re-enter using a different name: <a href="../inventory_list.php">click here</a>';
		exit();
      
	} else {
      
      if(isset($_SESSION['product_name'])){
        
      unset($_SESSION['product_name']);
      unset($_SESSION['price']);
      unset($_SESSION['details']);
        
      }
      
	// Add this product into the database now
	$sql = "INSERT INTO products (product_name, price, details, category, subcategory, date_added) VALUES('$product_name','$price','$details','$category','$subcategory',now())";
  mysqli_query($conn, $sql);
  $pid = mysqli_insert_id($conn);
      
      echo "$product_name";
      
	// Place image in the folder 
	$newname = "$pid.jpg";
	move_uploaded_file( $_FILES['fileField']['tmp_name'], "../inventory_images/$newname");
	header("location: ../inventory_list.php?inventory_list=added"); 
  exit();
      
      }
    }
}
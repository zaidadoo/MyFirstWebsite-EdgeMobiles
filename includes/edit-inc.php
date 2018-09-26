<?php

session_start();

include 'dbh-inc.php';

// Parse the form data and add inventory item to the system
if (isset($_POST['button'])) {
	
  $id = mysqli_real_escape_string($conn, $_POST['edit_id']);
  $id = htmlspecialchars($id);
  $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
  $product_name = htmlspecialchars($product_name);
	$price = mysqli_real_escape_string($conn, $_POST['price']);
  $price = htmlspecialchars($price);
	$category = mysqli_real_escape_string($conn, $_POST['category']);
  $category = htmlspecialchars($category);
	$subcategory = mysqli_real_escape_string($conn, $_POST['subcategory']);
  $subcategory = htmlspecialchars($subcategory);
	$details = mysqli_real_escape_string($conn, $_POST['details']);
  $details = htmlspecialchars($details);
  $_SESSION['p_id'] = $id;
  
  if(empty($product_name) || empty($price) || empty($category) || empty($subcategory) || empty($details)){
    
    header("Location: ../inventory_edit.php?inventory_edit=empty");
		exit();
    
           } else {
           
	// See if that product name is an identical match to another product in the system
	$sql = "";
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
	$sql = "UPDATE products SET product_name='$product_name', price='$price', details='$details', category='$category', subcategory='$subcategory' WHERE id='$id'";
  mysqli_query($conn, $sql);
  $pid = mysqli_insert_id($conn);
      
  
  if($_FILES['fileField']['tmp_name'] != ""){
	// Place image in the folder 
	$newname = "$id.jpg";
	move_uploaded_file( $_FILES['fileField']['tmp_name'], "../inventory_images/$newname");
	
      }
       header("location: ../inventory_edit.php?inventory_edit=edited"); 
       exit();
      }
   }
}
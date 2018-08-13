<?php

session_start();

//deleting item
if(isset($_POST['submit'])){
  
  $get = $_POST['submit'];
  $id = str_replace("delete ","","$get");  
  $_SESSION['d_id'] = $id;
  echo "<center>Are you sure you want to delete item with ID $id? </br> <a href='inventory_list.php?inventory_list=delete' style='text-decoration: none;'>Yes</a> &bull; <a href='inventory_list.php' style='text-decoration: none;'>No</a></center>";
  
} else {
  
  header("Location: inventory_list.php");
  
}

echo "<head>
  <title>Confirm: Delete Item $id</title>
</head>";


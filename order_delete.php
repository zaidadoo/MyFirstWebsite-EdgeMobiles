<?php

session_start();

//deleting item
if(isset($_POST['submit'])){
  
  $get = $_POST['submit'];
  $id = str_replace("delete ","","$get");  
  $_SESSION['d_id'] = $id;
  echo "<center>Are you sure you want to delete order with ID $id? </br> <a href='admin_order_list.php?admin_order_list=delete' style='text-decoration: none;'>Yes</a> &bull; <a href='admin_order_list.php' style='text-decoration: none;'>No</a></center>";
  
} else {
  
  header("Location: admin_order_list.php");
  
}

echo "<head>
  <title>Confirm: Delete Order $id</title>
</head>";


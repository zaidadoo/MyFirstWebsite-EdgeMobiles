<?php

  include 'includes/dbh-inc.php';
  include_once 'header.php';

  $product_list = "";

  if(($_SESSION['s_user']) != 'admin') {
    header ("Location: login.php");
    exit();
    
  } elseif(isset($_GET['search'])){
    
    $search_value = mysqli_real_escape_string($conn, $_GET['search']);
    $sql = "SELECT * FROM orders WHERE account_id LIKE '%$search_value%'  OR items LIKE '%$search_value%' OR price LIKE '%$search_value%' OR order_id LIKE '%$search_value%' OR date_added LIKE '%$search_value%'";
    $result = mysqli_query($conn, $sql);
    $resultcheck = mysqli_num_rows($result);
    
    if($resultcheck > 0){
       
        //grab list
        while($row = mysqli_fetch_array($result)){
        $d_id = $row["account_id"];
        $d_product_name = $row['items'];
	      $d_price = $row['price'];
        $d_date = $row['date_added'];
        $d_order = $row['order_id'];
        $product_list .= "
    <tr>
      <td>$d_id&nbsp&nbsp&nbsp&nbsp</td>
      <td><textarea readonly>$d_product_name&nbsp&nbsp&nbsp&nbsp</textarea></td>
      <td>$d_price&nbsp&nbsp&nbsp&nbsp</td>
      <td>$d_order&nbsp&nbsp&nbsp&nbsp</td>
      <td>$d_date&nbsp&nbsp&nbsp&nbsp</td>
    </tr>";
        
      }
      
    }
    
  } else {
    
    //grab products
    $sql = "SELECT * FROM orders";
    $result = mysqli_query($conn, $sql);
    $resultcheck = mysqli_num_rows($result);
    
    if($resultcheck > 0){
       
        //grab list
        while($row = mysqli_fetch_array($result)){
        $d_id = $row["account_id"];
        $d_product_name = $row['items'];
	      $d_price = $row['price'];
        $d_date = $row['date_added'];
        $d_order = $row['order_id'];
        $product_list .= "
    <tr>
      <td>$d_id&nbsp&nbsp&nbsp&nbsp</td>
      <td><textarea readonly>$d_product_name&nbsp&nbsp&nbsp&nbsp</textarea></td>
      <td>$d_price&nbsp&nbsp&nbsp&nbsp</td>
      <td>$d_order&nbsp&nbsp&nbsp&nbsp</td>
      <td>$d_date&nbsp&nbsp&nbsp&nbsp</td>
    </tr>";
        
      }
      
    } else {
      
      $product_list = "No products listed yet";
      
    }
  }

?>

<head>
  <title>Manage Orders</title>
</head>

<div class="admin-page">
  <div class="adminform2">
    
    &nbsp
    <a href="admin.php" class="additem"><div align="right" style="margin-right:32px;">
      + Back
    </div></a>
    
    <h1>
      Order List
    </h1>
    <center>
    <div class="search2" >
  <form action="admin_order_list.php?search" method="GET">
      <input style="float:left; width:72.9%" type="text" placeholder="Search.." name="search">
      <button class="search-button2" type="submit"><i class="fa fa-search"></i></button>
  </form>
  </div>
      </center>
    </br>
    <center>
    <table class="rtable">
  <thead>
    <tr>
      <th>Account ID&nbsp&nbsp&nbsp&nbsp</th>
      <th>Products&nbsp&nbsp&nbsp&nbsp</th>
      <th>Value&nbsp&nbsp&nbsp&nbsp</th>
      <th>Order ID&nbsp&nbsp&nbsp&nbsp</th>
      <th>Date Added</th>
    </tr>
  </thead>
  <tbody>
    <?php echo "$product_list"; ?>
  </tbody>
</table>
    </center>
  </div>
</div>

<?php
  
  include_once 'footer.php'
  
?>
<?php

  include 'includes/dbh-inc.php';
  include_once 'header.php';

  $product_list = "";

  if(($_SESSION['s_user']) != 'admin') {
    header ("Location: login.php");
    exit();
    
  } elseif(isset($_GET['search'])){
    
    $search_value = mysqli_real_escape_string($conn, $_GET['search']);
    $sql = "SELECT * FROM transactions WHERE id LIKE '%$search_value%'  OR product_id_array LIKE '%$search_value%' OR first_name LIKE '%$search_value%' OR last_name LIKE '%$search_value%' OR mc_gross LIKE '%$search_value%' OR payment_date LIKE '%$search_value%' OR payer_email LIKE '%$search_value%' OR address LIKE '%$search_value%' OR payment_status LIKE '%$search_value%'";
    $result = mysqli_query($conn, $sql);
    $resultcheck = mysqli_num_rows($result);
    
    if($resultcheck > 0){
       
        //grab list
        while($row = mysqli_fetch_array($result)){
        $d_id = $row["id"];
        $d_product_name = $row['product_id_array'];
	      $d_first_name = $row['first_name'];
        $d_last_name = $row['last_name'];
        $d_price = $row['mc_gross'];
        $d_date = $row['payment_date'];
        $d_email = $row['payer_email'];
        $d_address = $row['address'];
        $d_status = $row['payment_status'];
        $product_list .= "
    <tr>
      <td>$d_id&nbsp&nbsp&nbsp&nbsp</td>
      <td><textarea readonly>$d_product_name&nbsp&nbsp&nbsp&nbsp</textarea></td>
      <td>$d_first_name&nbsp&nbsp&nbsp&nbsp</td>
      <td>$d_last_name&nbsp&nbsp&nbsp&nbsp</td>
      <td>$d_date&nbsp&nbsp&nbsp&nbsp</td>
      <td>$d_email&nbsp&nbsp&nbsp&nbsp</td>
      <td><textarea readonly>$d_address&nbsp&nbsp&nbsp&nbsp</textarea></td>
      <td>$d_status&nbsp&nbsp&nbsp&nbsp</td>
    </tr>";
        
      }
      
    }
    
  } else {
    
    //grab products
    $sql = "SELECT * FROM transactions";
    $result = mysqli_query($conn, $sql);
    $resultcheck = mysqli_num_rows($result);
    
    if($resultcheck > 0){
       
        //grab list
        while($row = mysqli_fetch_array($result)){
        $d_id = $row["id"];
        $d_product_name = $row['product_id_array'];
	      $d_first_name = $row['first_name'];
        $d_last_name = $row['last_name'];
        $d_price = $row['mc_gross'];
        $d_date = $row['payment_date'];
        $d_email = $row['payer_email'];
        $d_address = $row['address'];
        $d_status = $row['payment_status'];
        $product_list .= "
    <tr>
      <td>$d_id&nbsp&nbsp&nbsp&nbsp</td>
      <td><textarea readonly>$d_product_name&nbsp&nbsp&nbsp&nbsp</textarea></td>
      <td>$d_first_name&nbsp&nbsp&nbsp&nbsp</td>
      <td>$d_last_name&nbsp&nbsp&nbsp&nbsp</td>
      <td>$d_price&nbsp&nbsp&nbsp&nbsp</td>
      <td>$d_date&nbsp&nbsp&nbsp&nbsp</td>
      <td>$d_email&nbsp&nbsp&nbsp&nbsp</td>
      <td><textarea readonly>$d_address&nbsp&nbsp&nbsp&nbsp</textarea></td>
      <td>$d_status&nbsp&nbsp&nbsp&nbsp</td>
    </tr>";
        
      }
      
    } else {
      
      $product_list = "No orders listed yet";
      
    }
  }

?>

<head>
  <title>Manage Transactions</title>
</head>

<div class="admin-page">
  <div class="adminform2">
    
    &nbsp
    <a href="admin.php" class="additem"><div align="right" style="margin-right:32px;">
      + Back
    </div></a>
    
    <h1>
      Transaction List
    </h1>
    <center>
    <div class="search2" >
  <form action="admin_transaction_list.php?search" method="GET">
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
      <th>Order ID&nbsp&nbsp&nbsp&nbsp</th>
      <th>Products&nbsp&nbsp&nbsp&nbsp</th>
      <th>First Name&nbsp&nbsp&nbsp&nbsp</th>
      <th>Last Name&nbsp&nbsp&nbsp&nbsp</th>
      <th>Value&nbsp&nbsp&nbsp&nbsp</th>
      <th>Date Added</th>
      <th>Payer Email&nbsp&nbsp&nbsp&nbsp</th>
      <th>Payer Address&nbsp&nbsp&nbsp&nbsp</th>
      <th>Payment Status</th>
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
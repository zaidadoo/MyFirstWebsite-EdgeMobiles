<?php

  include 'includes/dbh-inc.php';
  include_once 'header.php';

  $product_list = "";
  $online_list = "";
  $id = $_SESSION['s_id'];
  $email = $_SESSION['s_email'];
  
 if(!isset($_SESSION['s_id'])){
  
  header("Location: login.php");
  exit();
    
  } else {
    
    //grab products
    $sql = "SELECT * FROM orders WHERE account_id='$id'";
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
      <td><textarea style='resize:none;' class='lfield' readonly>$d_product_name&nbsp&nbsp&nbsp&nbsp</textarea></td>
      <td>$d_price&nbsp&nbsp&nbsp&nbsp</td>
      <td>$d_order&nbsp&nbsp&nbsp&nbsp</td>
      <td>$d_date&nbsp&nbsp&nbsp&nbsp</td>
    </tr>";
        
      }
      
    } else {
      
      $product_list = "No orders listed yet";
      
    }
   
   //grab products
    $sql = "SELECT * FROM transactions WHERE payer_email='$email'";
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
        $online_list .= "
    <tr>
      <td>$d_id&nbsp&nbsp&nbsp&nbsp</td>
      <td><textarea style='resize:none;' class='lfield' readonly>$d_product_name&nbsp&nbsp&nbsp&nbsp</textarea></td>
      <td>$d_first_name&nbsp&nbsp&nbsp&nbsp</td>
      <td>$d_last_name&nbsp&nbsp&nbsp&nbsp</td>
      <td>$d_price&nbsp&nbsp&nbsp&nbsp</td>
      <td>$d_date&nbsp&nbsp&nbsp&nbsp</td>
      <td>$d_email&nbsp&nbsp&nbsp&nbsp</td>
      <td><textarea style='resize:none;' class='lfield' readonly>$d_address&nbsp&nbsp&nbsp&nbsp</textarea></td>
      <td>$d_status&nbsp&nbsp&nbsp&nbsp</td>
    </tr>";
        
      }
      
    } else {
      
      $online_list = "No orders listed yet";
      
    }
   
  }

?>

<head>
  <title>View Orders</title>
</head>

<div class="admin-page">
  <div class="adminform2">
    
    &nbsp
    <a href="account-menu.php" class="additem"><div align="right" style="margin-right:32px;">
      + Back
    </div></a>
    
    
    <h1>
      Order List
    </h1>
    <center>
    Local Reservations
      </center>
    </br>
    <center>
    <table class="rtable">
  <thead>
    <tr>
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
  </br>
<center>
  Online Transactions</br>
  This only shows if email connected to EDGE account
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
      <th>Payment Status&nbsp&nbsp&nbsp&nbsp</th>
    </tr>
  </thead>
  <tbody>
    <?php echo "$online_list"; ?>
  </tbody>
</table>
    </center>
  </div>
</div>

<?php
  
  include_once 'footer.php'
  
?>
<?php

  include 'includes/dbh-inc.php';
  include_once 'header.php';

  $product_list = "";
  $address_list = "";

  if(($_SESSION['s_user']) != 'admin') {
    header ("Location: login.php");
    exit();
    
  } else { 
    
    if(isset($_GET['search1'])){
    
    $search_value = mysqli_real_escape_string($conn, $_GET['search1']);
    $sql = "SELECT * FROM accounts WHERE account_id LIKE '%$search_value%'  OR username LIKE '%$search_value%' OR email LIKE '%$search_value%' OR name LIKE '%$search_value%'";
    $result = mysqli_query($conn, $sql);
    $resultcheck = mysqli_num_rows($result);
    
    if($resultcheck > 0){
       
        //grab list
        while($row = mysqli_fetch_array($result)){
        $d_id = $row["account_id"];
        $d_name = $row['name'];
        $d_username = $row['username'];
	      $d_email = $row['email'];
        $product_list .= "
    <tr>
      <td>$d_id&nbsp&nbsp&nbsp&nbsp</td>
      <td>$d_name&nbsp&nbsp&nbsp&nbsp</td>
      <td>$d_username&nbsp&nbsp&nbsp&nbsp</td>
      <td>$d_email&nbsp&nbsp&nbsp&nbsp</td>
    </tr>";
        
      }
      
    }
  }
    
    if(isset($_GET['search2'])){ 
  
  
    $search_value = mysqli_real_escape_string($conn, $_GET['search2']);
    $sql = "SELECT * FROM address WHERE account_id LIKE '%$search_value%'  OR phone LIKE '%$search_value%' OR city LIKE '%$search_value%' OR street LIKE '%$search_value%' OR building LIKE '%$search_value%' OR floor LIKE '%$search_value%' OR apartment LIKE '%$search_value%' OR notes LIKE '%$search_value%'";
    $result = mysqli_query($conn, $sql);
    $resultcheck = mysqli_num_rows($result);
    
    if($resultcheck > 0){
       
        //grab list
        while($row = mysqli_fetch_array($result)){
        $d_id = $row["account_id"];
        $d_phone = $row['phone'];
        $d_city = $row['city'];
	      $d_street = $row['street'];
	      $d_building = $row['building'];
	      $d_floor = $row['floor'];
	      $d_apartment = $row['apartment'];
	      $d_notes = $row['notes'];
        $address_list .= "
    <tr>
      <td>$d_id&nbsp&nbsp&nbsp&nbsp</td>
      <td>$d_phone&nbsp&nbsp&nbsp&nbsp</td>
      <td>$d_city&nbsp&nbsp&nbsp&nbsp</td>
      <td>$d_street&nbsp&nbsp&nbsp&nbsp</td>
      <td>$d_building&nbsp&nbsp&nbsp&nbsp</td>
      <td>$d_floor&nbsp&nbsp&nbsp&nbsp</td>
      <td>$d_apartment&nbsp&nbsp&nbsp&nbsp</td>
      <td><textarea readonly>$d_notes&nbsp&nbsp&nbsp&nbsp</textarea></td>
    </tr>";
        
      }
      
    }
    
  } 
      }
      
    if(!isset($_GET['search1'])){
    
    //grab products
    $sql = "SELECT * FROM accounts";
    $result = mysqli_query($conn, $sql);
    $resultcheck = mysqli_num_rows($result);
    
    if($resultcheck > 0){
       
        //grab list
        while($row = mysqli_fetch_array($result)){
        $d_id = $row["account_id"];
        $d_name = $row['name'];
        $d_username = $row['username'];
	      $d_email = $row['email'];
        $product_list .= "
    <tr>
      <td>$d_id&nbsp&nbsp&nbsp&nbsp</td>
      <td>$d_name&nbsp&nbsp&nbsp&nbsp</td>
      <td>$d_username&nbsp&nbsp&nbsp&nbsp</td>
      <td>$d_email&nbsp&nbsp&nbsp&nbsp</td>
    </tr>";
        
      }
      
    } else {
      
      $product_list = "No accounts listed yet";
      
    }
    }
      
    if(!isset($_GET['search2'])){
    $sql = "SELECT * FROM address";
    $result = mysqli_query($conn, $sql);
    $resultcheck = mysqli_num_rows($result);
    
    if($resultcheck > 0){
       
        //grab list
        while($row = mysqli_fetch_array($result)){
        $d_id = $row["account_id"];
        $d_phone = $row['phone'];
        $d_city = $row['city'];
	      $d_street = $row['street'];
	      $d_building = $row['building'];
	      $d_floor = $row['floor'];
	      $d_apartment = $row['apartment'];
	      $d_notes = $row['notes'];
        $address_list .= "
    <tr>
      <td>$d_id&nbsp&nbsp&nbsp&nbsp</td>
      <td>$d_phone&nbsp&nbsp&nbsp&nbsp</td>
      <td>$d_city&nbsp&nbsp&nbsp&nbsp</td>
      <td>$d_street&nbsp&nbsp&nbsp&nbsp</td>
      <td>$d_building&nbsp&nbsp&nbsp&nbsp</td>
      <td>$d_floor&nbsp&nbsp&nbsp&nbsp</td>
      <td>$d_apartment&nbsp&nbsp&nbsp&nbsp</td>
      <td><textarea readonly>$d_notes&nbsp&nbsp&nbsp&nbsp</textarea></td>
    </tr>";
        
      }
    } else {
      
      $product_list = "No addresses listed yet";
      
    }
    
    }
?>

<head>
  <title>View Accounts</title>
</head>

<div class="admin-page">
  <div class="adminform2">
    
    &nbsp
    <a href="admin.php" class="additem"><div align="right" style="margin-right:32px;">
      + Back
    </div></a>
    
    
    <h1>
      Account List
    </h1>
    <center>
    <div class="search2" >
  <form action="admin_account_list.php?search1" method="GET">
      <input style="float:left; width:72.9%" type="text" placeholder="Search.." name="search1">
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
      <th>Name&nbsp&nbsp&nbsp&nbsp</th>
      <th>Username&nbsp&nbsp&nbsp&nbsp</th>
      <th>Email</th>
    </tr>
  </thead>
  <tbody>
    <?php echo "$product_list"; ?>
  </tbody>
</table>
    </center>
  </br>
 <h1>
      Address List
    </h1>
    <center>
    <div class="search2" >
  <form action="admin_account_list.php?search2" method="GET">
      <input style="float:left; width:72.9%" type="text" placeholder="Search.." name="search2">
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
      <th>Phone&nbsp&nbsp&nbsp&nbsp</th>
      <th>City&nbsp&nbsp&nbsp&nbsp</th>
      <th>Street&nbsp&nbsp&nbsp&nbsp</th>
      <th>Building&nbsp&nbsp&nbsp&nbsp</th>
      <th>Floor&nbsp&nbsp&nbsp&nbsp</th>
      <th>Apartment&nbsp&nbsp&nbsp&nbsp</th>
      <th>Notes</th>
    </tr>
  </thead>
  <tbody>
    <?php echo "$address_list"; ?>
  </tbody>
</table>
    </center>
  </div>
</div>



<?php
  
  include_once 'footer.php'
  
?>
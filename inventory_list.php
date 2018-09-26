<?php

  include 'includes/dbh-inc.php';
  include_once 'header.php';

  $product_list = "";

  if(($_SESSION['s_user']) != 'admin') {
    header ("Location: login.php");
    exit();
    
  } elseif(isset($_GET['search'])){
    
    $search_value = mysqli_real_escape_string($conn, $_GET['search']);
    $sql = "SELECT * FROM products WHERE product_name LIKE '%$search_value%'  OR id LIKE '%$search_value%' OR price LIKE '%$search_value%' OR category LIKE '%$search_value%' OR subcategory LIKE '%$search_value%' OR date_added LIKE '%$search_value%' ";
    $result = mysqli_query($conn, $sql);
    $resultcheck = mysqli_num_rows($result);
    
    if($resultcheck > 0){
       
        //grab list
        while($row = mysqli_fetch_array($result)){
        $d_id = $row["id"];
        $d_product_name = $row['product_name'];
	      $d_price = $row['price'];
	      $d_category = $row['category'];
	      $d_subcategory = $row['subcategory'];
	      $d_details = $row['details'];
        $d_date = $row['date_added'];
        $product_list .= "
    <tr>
      <td>$d_id&nbsp&nbsp&nbsp&nbsp</td>
      <td>$d_product_name&nbsp&nbsp&nbsp&nbsp</td>
      <td>$d_price&nbsp&nbsp&nbsp&nbsp</td>
      <td>$d_category&nbsp&nbsp&nbsp&nbsp</td>
      <td>$d_subcategory&nbsp&nbsp&nbsp&nbsp</td>
      <td><textarea style='border: 0px; resize: vertical;' readonly>$d_details&nbsp&nbsp&nbsp&nbsp</textarea></td>
      <td>&nbsp$d_date&nbsp&nbsp&nbsp&nbsp</td>
      <td><form action='inventory_edit.php?editid=$d_id' method='POST'><input style='border: none;' type='submit' name='submit' value='edit $d_id'></form><form action='inventory_delete.php?deleteid=$d_id' method='POST'><input style='border: none;' type='submit' name='submit' value='delete $d_id'></form>&nbsp&nbsp&nbsp&nbsp</td>
    </tr>";
        
      }
      
    }
    
  } else {
    
    //grab products
    $sql = "SELECT * FROM products";
    $result = mysqli_query($conn, $sql);
    $resultcheck = mysqli_num_rows($result);
    
    if(isset($_SESSION['product_name'])){
    $product_name = $_SESSION['product_name'];
    $price = $_SESSION['price'];
    $details = $_SESSION['details'];
    }
    
    if($resultcheck > 0){
       
        //grab list
        while($row = mysqli_fetch_array($result)){
        $d_id = $row["id"];
        $d_product_name = $row['product_name'];
	      $d_price = $row['price'];
	      $d_category = $row['category'];
	      $d_subcategory = $row['subcategory'];
	      $d_details = $row['details'];
        $d_date = $row['date_added'];
        $product_list .= "
    <tr>
      <td>$d_id&nbsp&nbsp&nbsp&nbsp</td>
      <td>$d_product_name&nbsp&nbsp&nbsp&nbsp</td>
      <td>$d_price&nbsp&nbsp&nbsp&nbsp</td>
      <td>$d_category&nbsp&nbsp&nbsp&nbsp</td>
      <td>$d_subcategory&nbsp&nbsp&nbsp&nbsp</td>
      <td><textarea style='border: 0px; resize: vertical;' readonly>$d_details&nbsp&nbsp&nbsp&nbsp</textarea></td>
      <td>&nbsp$d_date&nbsp&nbsp&nbsp&nbsp</td>
      <td><form action='inventory_edit.php?editid=$d_id' method='POST'><input style='border: none;' type='submit' name='submit' value='edit $d_id'></form><form action='inventory_delete.php?deleteid=$d_id' method='POST'><input style='border: none;' type='submit' name='submit' value='delete $d_id'></form>&nbsp&nbsp&nbsp&nbsp</td>
    </tr>";
        
      }
      
    } else {
      
      $product_list = "No products listed yet";
      
    }
  }

//removing item
$host = $_SERVER['REQUEST_URI'];
if($host == '/inventory_list.php?inventory_list=delete'){
  
	$id_delete = $_SESSION['d_id'];
	$sql = "DELETE FROM products WHERE id='$id_delete' LIMIT 1";
  $result = mysqli_query($conn, $sql);
  $pictodelete_jpg = ("inventory_images/$id_delete.jpg");
  
    if (file_exists($pictodelete_jpg)) {
       		    unlink($pictodelete_jpg);
    }
  
  unset($_SESSION['d_id']);
  
	header("location: inventory_list.php?inventory_list=deletesuccess"); 
  exit();
        
} 
?>

<head>
  <title>Manage Products</title>
</head>

<div class="admin-page">
  <div class="adminform2">
    
    &nbsp
    <a href="admin.php" class="additem"><div align="right" style="margin-right:32px;">
      + Back
    </div></a>
    <a href="#additem" class="additem"><div align="right" style="margin-right:32px;">
      + Add a new item
    </div></a>
    
    
    <span class="error">
      <?php 
      
      $host = $_SERVER['REQUEST_URI'];
      if($host == '/inventory_list.php?inventory_list=empty'){
        
        echo "<p>Error: all fields must be filled</p></br>";
        
      } elseif($host == '/inventory_list.php?inventory_list=deletesuccess'){
        
        echo "<p>Deleted item successfully</p></br>";
        
      } elseif ($host == '/inventory_list.php?inventory_list=added'){
        
        echo "<p>Added item successfully</p></br>";
        
      }
      ?>
    </span>
    
    <h1>
      Product List
    </h1>
    <center>
    <div class="search2" >
  <form action="inventory_list.php?search" method="GET">
      <input style="float:left; width:72.9%" type="text" placeholder="Search.." name="search">
      <button class="search-button2" style="height: 27.5px" type="submit"><i class="fa fa-search"></i></button>
  </form>
  </div>
      </center>
  </br>
    <center>
    <table class="rtable">
  <thead>
    <tr>
      <th>ID&nbsp&nbsp&nbsp&nbsp</th>
      <th>Name&nbsp&nbsp&nbsp&nbsp</th>
      <th>Price&nbsp&nbsp&nbsp&nbsp</th>
      <th>Category&nbsp&nbsp&nbsp&nbsp</th>
      <th>Sub-category&nbsp&nbsp&nbsp&nbsp</th>
      <th>Details&nbsp&nbsp&nbsp&nbsp</th>
      <th>Date Added</th>
      <th>Modification</th>
    </tr>
  </thead>
  <tbody>
    <?php echo "$product_list"; ?>
  </tbody>
</table>
    </center>
    
    
    <a name="additem" id="additem"></a>
    <h2>Add Item</h2>
    <form action="includes/add-inc.php" method="POST" enctype="multipart/form-data" name="form" id="form">
      <div class="addingfields">
        <input class="lfield" style="text-align:center; width:50%;" type="text" placeholder="product name" <?php if(isset($_SESSION['product_name'])) { echo "value='$product_name'"; } ?> id="product_name" name="product_name"/>
        </br>
        <input class="lfield" style="text-align:center; width:25%;" type="text" placeholder="price in JD" <?php if(isset($_SESSION['product_name'])) { echo "value='$price'"; } ?> id="price" name="price"/>
        </br>
        <select style="padding:10px;" name="category" id="category">
          <option value="">Select an item</option>
          <option value="main">Main Store</option>
          <option value="accessories">Accessories</option>
        </select>
        </br></br>
        <select style="padding:10px;" name="subcategory" id="subcategory">
          <option value="">Select an item</option>
          <option value="">Main Store :</option>
          <option value="apple">Apple</option>
          <option value="samsung">Samsung</option>
          <option value="huawei">Huawei</option>
          <option value="nokia">Nokia</option>
          <option value="lg">LG</option>
          <option value="">-----</option>
          <option value="accessories">Accessories :</option>
          <option value="cables">Cables</option>
          <option value="chargers">Chargers</option>
          <option value="docks">Docks</option>
          <option value="others">Other</option>
        </select>
        </br></br>
        <textarea style="resize:none; background-color:#f2f2f2; text-align:center; width: 50%; height: 250px;" placeholder="add details" name="details" id="details" ><?php if(isset($_SESSION['product_name'])) { echo "$details"; } ?></textarea>
        </br></br>
        <p style="text-align:center;">Image for item:</p>
        <input type="file" name="fileField" id="fileField" />
        </br></br>
        <input class="lbutton" type="submit" value="add item" id="button" name="button">
        </br></br>
      </div>
    </form>
    
  </div>
</div>

<?php
  
  include_once 'footer.php'
  
?>
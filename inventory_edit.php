<?php

  include_once 'header.php';

  if(($_SESSION['s_user']) != 'admin') {
    header ("Location: login.php");
    exit();
    
  } else {
    
    if(isset($_SESSION['p_id'])){
      
      $editid = $_SESSION['p_id'];
      
    } else {
    $editid = preg_replace('#[^0-9]#i','',$_GET['editid']);
    }
    
    include 'includes/dbh-inc.php';
    
    //grab item
    $sql = "SELECT * FROM products WHERE id='$editid'";
    $result = mysqli_query($conn, $sql);
    
    while($row = mysqli_fetch_array($result)){
        $d_id = $row["id"];
        $d_product_name = $row['product_name'];
	      $d_price = $row['price'];
	      $d_category = $row['category'];
	      $d_subcategory = $row['subcategory'];
	      $d_details = $row['details'];
        $d_date = $row['date_added'];
    }
  }

echo "<head>
  <title>Edit $d_id</title>
</head>";
?>


<div class="admin-page">
  <div class="adminform2">
    &nbsp
    <a href="inventory_list.php" class="additem"><div align="right" style="margin-right:32px;">
      + Back
    </div></a>
    <span class="error">
      <?php 
      
      $host = $_SERVER['REQUEST_URI'];
      if($host == '/inventory_edit.php?inventory_edit=empty'){
        
        echo "<p>Error: all fields must be filled</p></br>";
        
      } elseif($host == '/inventory_edit.php?inventory_edit=edited'){
        
        echo "<p>Edited item successfully</p></br>";
        
      }
      ?>
    </span>
    
    <h2>Edit Item</h2>
    <form action="includes/edit-inc.php" method="POST" enctype="multipart/form-data" name="form" id="form">
      <div class="addingfields">
        <input class="lfield" style="text-align:center; width:50%;" type="text" placeholder="product name" <?php echo "value='$d_product_name'"; ?> id="product_name" name="product_name"/>
        </br>
        <input class="lfield" style="text-align:center; width:25%;" type="text" placeholder="price in JD" <?php echo "value='$d_price'"; ?> id="price" name="price"/>
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
        <textarea style="resize:none; background-color:#f2f2f2; text-align:center; width: 50%; height: 250px;" placeholder="add details" name="details" id="details" > <?php echo "$d_details"; ?> </textarea>
        </br></br>
        <p style="text-align:center;">Image for item:</p>
        <input type="file" name="fileField" id="fileField" />
        </br></br>
        <input name="edit_id" type="hidden" value="<?php echo "$d_id"; ?>">
        <input class="lbutton" type="submit" value="update item" id="button" name="button">
        </br></br>
      </div>
    </form>
    
  </div>
</div>

<?php

unset($_SESSION['p_id']);

  include_once 'footer.php'
  
?>
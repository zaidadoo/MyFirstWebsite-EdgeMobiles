<?php

include 'includes/dbh-inc.php';
    
 //check if ID exists
if(isset($_GET['id'])){
  
  $id = preg_replace('#[^0-9]#i','',$_GET['id']);
  
} else {

  header("Location: store.php");
  exit();
    
}

    //grab product
    $dynamic_list = "";
    $sql = "SELECT * FROM products WHERE id='$id' LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $resultcheck = mysqli_num_rows($result);
    
    if($resultcheck > 0){
       
        //grab product details
        while($row = mysqli_fetch_array($result)){
        $p_name = $row['product_name'];
	      $p_price = $row['price'];
	      $p_details = $row['details'];
      }
      
    } else{
      
      $d_product_name = "no item found";
      $d_price = "no item found";
      $d_details = "no item found";
      
    }

mysqli_close($conn);  

?>

<?php

include_once 'header.php';

  //select products
?>
  
<head>
  <title><?php echo "$p_name"; ?></title>
</head>

<?php

include_once 'store-side.php';

?>

</br>
</br>
</br>
</br>
</br>
</br>
<div class="product-page">
  <div class="productform">
    <div class="product-details">
      <img class="product-image"  <?php echo 'src="inventory_images/'.$id.'.jpg"'; ?>>
      </br>
      </br>
    <div class="product-text">
      <a href="store.php" class="goback"><div align="right" style="float: right;">
      go back?
    </div></a>
      <h1 class="p-h1"><?php echo "$p_name"; ?></h1>
      
      <h2 class="p-h2">Price: <?php echo "$p_price"; ?> JD</h2>
      </br>
      </br>
     <textarea class="product-text-details" readonly><?php echo "$p_details"; ?></textarea></br>
    <form id="product" name="product" method="post" action="referral.php">
        <input type="hidden" name="price" id="price" value="<?php echo $p_price; ?>" />
        <input type="hidden" name="name" id="name" value="<?php echo $p_name; ?>" />
        <input type="hidden" name="id" id="id" value="<?php echo $id; ?>" />
        <input type="submit" style="border: none; padding: 10px; background: lightgrey;" name="submit" id="submit" value="Add to cart" />
      </form>
    </div>
    </div>
  </div>
</div>
    
<?php

include_once 'footer.php';

?>
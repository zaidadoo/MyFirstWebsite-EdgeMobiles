<?php

include 'includes/dbh-inc.php';
    
if(isset($_GET['search'])){
  
  $dynamic_list = "";
  $search_value = mysqli_real_escape_string($conn, $_GET['search']);
  $sql = "SELECT * FROM products WHERE product_name LIKE '%$search_value%'";
  $result = mysqli_query($conn, $sql);
    $resultcheck = mysqli_num_rows($result);
    
    if($resultcheck > 0){
       
        //grab list
        while($row = mysqli_fetch_array($result)){
        $d_id = $row["id"];
        $d_product_name = $row['product_name'];
	      $d_price = $row['price'];
        $dynamic_list .= '<a href="product.php?id='. $d_id .'">
  <li class="product">
    <div class="container-prod">
      <img class="image" src="inventory_images/'. $d_id .'.jpg">
      <div class="container-information">
        <div class="title">
          '. $d_product_name .' <ins style="float:right;">'. $d_price .'JD</ins>
        </div>
      </div>
  </li>
 </a>';
      }
 
  
} else {
      
      $dynamic_list = "No such item(s) exist in store, <a href='store.php'>go back?</a>";
      
    }
 
  
} elseif(isset($_GET['category'])){
  
  if(preg_match("/^[a-zA-Z ]*$/", ($_GET['category']))){
  $category = $_GET['category'];
  }
  
  //grab products depending on category
    $dynamic_list = "";
    $sql = "SELECT * FROM products WHERE category = '$category'";
    $result = mysqli_query($conn, $sql);
    $resultcheck = mysqli_num_rows($result);
    
    if($resultcheck > 0){
       
        //grab list
        while($row = mysqli_fetch_array($result)){
        $d_id = $row["id"];
        $d_product_name = $row['product_name'];
	      $d_price = $row['price'];
        $dynamic_list .= '<a href="product.php?id='. $d_id .'">
  <li class="product">
    <div class="container-prod">
      <img class="image" src="inventory_images/'. $d_id .'.jpg">
      <div class="container-information">
        <div class="title">
          '. $d_product_name .' <ins style="float:right;">'. $d_price .'JD</ins>
        </div>
      </div>
  </li>
 </a>';
      }
 
  
} else {
      
      $dynamic_list = "No items within this category in store, <a href='store.php'>go back?</a>";
      
    }
  
} elseif(isset($_GET['subcategory'])){
   
   if(preg_match("/^[a-zA-Z ]*$/", ($_GET['subcategory']))){
   $subCategory = $_GET['subcategory'];
   }
  
  //grab products depending on category
    $dynamic_list = "";
    $sql = "SELECT * FROM products WHERE subcategory = '$subCategory'";
    $result = mysqli_query($conn, $sql);
    $resultcheck = mysqli_num_rows($result);
    
    if($resultcheck > 0){
       
        //grab list
        while($row = mysqli_fetch_array($result)){
        $d_id = $row["id"];
        $d_product_name = $row['product_name'];
	      $d_price = $row['price'];
        $dynamic_list .= '<a href="product.php?id='. $d_id .'">
  <li class="product">
    <div class="container-prod">
      <img class="image" src="inventory_images/'. $d_id .'.jpg">
      <div class="container-information">
        <div class="title">
          '. $d_product_name .' <ins style="float:right;">'. $d_price .'JD</ins>
        </div>
      </div>
  </li>
 </a>';
      }
      
    } else {
      
      $dynamic_list = "No items within this sub-category in store, <a href='store.php'>go back?</a>";
      
    }
  
} else {
    //grab all products
    $dynamic_list = "";
    $sql = "SELECT * FROM products";
    $result = mysqli_query($conn, $sql);
    $resultcheck = mysqli_num_rows($result);
    
    if($resultcheck > 0){
       
        //grab list
        while($row = mysqli_fetch_array($result)){
        $d_id = $row["id"];
        $d_product_name = $row['product_name'];
	      $d_price = $row['price'];
        $dynamic_list .= '<a href="product.php?id='. $d_id .'">
  <li class="product">
    <div class="container-prod">
      <img class="image" src="inventory_images/'. $d_id .'.jpg">
      <div class="container-information">
        <div class="title">
          '. $d_product_name .' <ins style="float:right;">'. $d_price .'JD</ins>
        </div>
      </div>
  </li>
 </a>';
      }
      
    } else {
      
      $dynamic_list = "No products listed yet in store";
      
    }
}

mysqli_close($conn);  

?>

<head>
  <title>Store</title>
</head>

<?php

include_once 'header.php';

?>
  
<?php

include_once 'store-side.php';

?>

</br>
</br>
</br>
<ul class="wrapper2">
  <?php echo "$dynamic_list"; ?>
</ul>

<?php

include_once 'footer.php';

?>
<?php

include_once 'header.php';

include 'includes/dbh-inc.php';


if (isset($_POST['submit'])) {
    
    $dynamic_list = "";
    $id = $_POST['id'];
    $p_name = $_POST['name'];
    $p_price = $_POST['price'];
	  $found = false;
	  $i = 0;
	
  //if item not already exist
	if (!isset($_SESSION["cart_array"]) || count($_SESSION["cart_array"]) < 1) { 
	 
		$_SESSION["cart_array"] = array(0 => array("item_id" => $id, "quantity" => 1, "item_name" => $p_name, "item_price" => $p_price));
    $dynamic_list = "Item added to cart, <a href='store.php'>go back?</a> or <a href='cart.php'>go to cart?</a>";
    
	} else {
		
    //if item exists add +1 quantity
		foreach ($_SESSION["cart_array"] as $item) { 
		      $i++;
		      while (list($key, $value) = each($item)) {
				  if ($key == "item_id" && $value == $id) {
					  
					  array_splice($_SESSION["cart_array"], $i-1, 1, array(array("item_id" => $id, "quantity" => $item['quantity'] + 1, "item_name" => $p_name, "item_price" => $p_price)));
					  $found = true;
            $dynamic_list = "Item quantity modified in cart, <a href='store.php'>go back?</a> or <a href='cart.php'>go to cart?</a>";
				    } 
		      } 
	      } 
    
		   if ($found == false) {
			   array_push($_SESSION["cart_array"], array("item_id" => $id, "quantity" => 1, "item_name" => $p_name, "item_price" => $p_price));
         $dynamic_list = "Item added to cart, <a href='store.php'>go back?</a> or <a href='cart.php'>go to cart?</a>";
		   }
	}
}

?>

<head>
  <title>Item Added</title>
</head>


  
<?php

include_once 'store-side.php';

?>

</br>
<ul class="wrapper2">
  <?php echo "$dynamic_list"; ?>
</ul>

<?php

include_once 'footer.php';

?>
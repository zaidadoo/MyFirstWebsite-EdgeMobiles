<?php

include_once "header.php";
include "includes/dbh-inc.php";

$errorOutput = "";

if(isset($_GET['cart']) && $_GET['cart'] == "success"){
  
  $cartOutput = "Payment Successful";
  
} elseif(isset($_GET['cart']) && $_GET['cart'] == "error") {
  
  $errorOutput = "There was an error in transaction";
  
}

$outputName = "";
$cartTotal = 5;
 $x = "";
$paypal_checkout = "";
$reserve_checkout = "";

//empty array 
if(isset($_GET['cart']) && $_GET['cart'] == "empty") {
    unset($_SESSION["cart_array"]);

} elseif(isset($_GET['delete'])){
  
  $id = preg_replace('#[^0-9]#i','',$_GET['delete']);
	if (count($_SESSION["cart_array"]) <= 1) {
		unset($_SESSION["cart_array"]);
	} else {
		unset($_SESSION["cart_array"]["$id"]);
		sort($_SESSION["cart_array"]);
	}
}
  
//change quantity of item
if (isset($_POST['item']) && $_POST['item'] != "") {
   
	$item_to_adjust = mysqli_real_escape_string($conn, $_POST['item']);
  $item_to_adjust = htmlspecialchars($item_to_adjust);
  $item_price = mysqli_real_escape_string($conn, $_POST['price']);
  $item_price = htmlspecialchars($item_price);
  $item_name = mysqli_real_escape_string($conn, $_POST['name']);
  $item_name = htmlspecialchars($item_name);
  $item_quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
  $item_quantity = htmlspecialchars($item_quantity);
	if ($quantity >= 100) { $quantity = 99; }
	if (($quantity < 1) || ($quantity = 1)) { $quantity = 1; }
	if ($quantity == "") { $quantity = 1; }
	$i = 0;
	foreach ($_SESSION["cart_array"] as $item) { 
		      $i++;
		      while (list($key, $value) = each($item)) {
				  if ($key == "item_id" && $value == $item_to_adjust) {
					  array_splice($_SESSION["cart_array"], $i-1, 1, array(array("item_id" => $item_to_adjust, "quantity" => $item_quantity, "item_name" => $item_name, "item_price" => $item_price)));
				  }
		      }
	}
  header("Location: cart.php");
  exit();
}

//output array
$cartOutput = "";
$paypal_checkout .= "";
if(!isset($_SESSION['cart_array']) || count($_SESSION['cart_array']) < 1){
  
  $_SESSION["cart_array"] = array();
  $cartOutput = "Your shopping cart is empty, <a href='store.php'>go to store?</a>";
  
} else {
  
  $paypal_checkout .= '<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
    <input type="hidden" name="cmd" value="_cart">
    <input type="hidden" name="upload" value="1">
    <input type="hidden" name="business" value="samer.alqaissi@gmail.com">';
  
  $reserve_checkout .= '<form action="cart-referral.php" method="post">';
  
  $i = 0;
 
  foreach($_SESSION['cart_array'] as $item){
    
    $paypalTotal = $item['item_price'] * 1.41;
    $final = round($paypalTotal, 2);
      
    $itemTotal = $item['quantity'] * $item['item_price'];
    
    $cartTotal = $itemTotal + $cartTotal;
    
    $outputName .= '' . $item['item_name'] . ' : ' . $item['quantity'] . '\n';
    
    $x = $i + 1;
    //paypal checkout output
    $paypal_checkout .= '<input type="hidden" name="item_name_' . $x . '" value="' . $item['item_name'] . '">
        <input type="hidden" name="amount_' . $x . '" value="' . $final . '">
        <input type="hidden" name="quantity_' . $x . '" value="' . $item['quantity'] . '">  
        <input type="hidden" name="custom" value="' . $outputName . '">';
    
    $reserve_checkout .= '<input type="hidden" name="products" value="' . $outputName . '">';
    
    //cart output
      $cartOutput.= '<tr>
<td class="text-left">'.$item['item_name'].'</td>
<td class="text-left">'.$item['item_price'].' JD</td>
<td class="text-left"><a href="cart.php?delete='.$i.'" style="text-decoration: none; color: #666B85;">Remove</a> </br> <form action="cart.php" method="post">
		<input name="quantity" type="text" value="' . $item['quantity'] . '" size="1" maxlength="2" />
		<input style="border: none; padding: 2.5px; background: lightgrey;" name="button" type="submit" value="change" />
    <input name="item" type="hidden" value="'.$item['item_id'].'" />
		<input name="name" type="hidden" value="'.$item['item_name'].'" />
    <input name="price" type="hidden" value="'.$item['item_price'].'" />
		</form></td>
<td class="text-left">'.$itemTotal.' JD</td>
</tr>';
    $i++;
  }
}

$z = $x + 1;

$paypal_checkout .= '<input type="hidden" name="item_name_' . $z . '" value="Shipping & Handling">
        <input type="hidden" name="amount_' . $z . '" value="7">
        <input type="hidden" name="quantity_' . $z . '" value="1">  
  <input type="hidden" name="notify_url" value="https://edge-zaidadoo272427.codeanyapp.com/ipn.php">
	<input type="hidden" name="return" value="https://edge-zaidadoo272427.codeanyapp.com/ipn.php">
	<input type="hidden" name="rm" value="2">
	<input type="hidden" name="cbt" value="Return to The Store">
	<input type="hidden" name="cancel_return" value="https://edge-zaidadoo272427.codeanyapp.com/cart.php">
	<input type="hidden" name="lc" value="US">
	<input type="hidden" name="currency_code" value="USD">
	<input type="image" class="paypal" src="images/PP.jpg" name="submit">
	</form>';

$reserve_checkout .= '<input type="hidden" name="total_price" value="' . $cartTotal . '">
	<input type="submit" name="submit" value="Reserve Items" class="reserve-btn" style="padding: 4px; padding-left: 35px; padding-right: 35px; margin-top: 50px; border-radius: 2px; background-color: lightblue; color: white; border: 0;"/>
	</form>';
?>

<head>
  <title>Cart</title>
</head>


<center>
<div class="cart-page">
</br>
</br>
</br>
</br>
</br>
<table class="table-fill">
<thead>
<tr>
<th class="text-left">Product</th>
<th class="text-left">Price</th>
<th class="text-left">Modify</th>
<th class="text-left">Total</th>
</tr>
</thead>
<tbody class="table-hover">
  <tr>
  <td class="text-left">Shipping and Handling</td>
  <td class="text-left">5 JD</td>
  <td class="text-left">Unavailable</td>
  <td class="text-left">5 JD</td>
</tr>
<?php echo "$errorOutput"; ?>
<?php echo "$cartOutput"; ?>
</tbody>
</table>
 <p style="float: right;">
   Total Price: <?php echo "$cartTotal"; ?> JD
</p>
<a href="cart.php?cart=empty" style="border: none; background: lightgrey;"><p style="float: left;">
   Empty Cart
</p></a>

<center>
<div style="float: right;">
  <?php echo "$reserve_checkout"; ?>
</div>
<div style="float: left; margin-top: 50px;">
  <?php echo "$paypal_checkout"; ?>
</div>
</div>
</center>

<?php

include_once "footer.php";

?>
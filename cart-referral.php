<?php

include_once 'header.php';

include 'includes/dbh-inc.php';

if(!isset($_POST['submit'])){
  
  header("Location: cart.php");
  exit();
  
} elseif(!isset($_SESSION['s_id'])){
  
  $dynamic_list = "You must be logged in to reserve items, <a href='login.php'>login?</a>";
  
} elseif(($_SESSION['s_phone'] == null) || empty($_SESSION['s_phone'])){
  
  $dynamic_list = "It seems you have not added your address yet, <a href='account.php'>go to account settings?</a>";
  
} else {
  
  $id = $_SESSION['s_id'];
  $items = $_POST['products'];
  $price = $_POST['total_price'];
  $sql = "INSERT INTO orders (account_id, items, price, date_added) VALUES ('$id', '$items', '$price',now());";
  $result = mysqli_query($conn, $sql);
  unset($_SESSION["cart_array"]);
  $dynamic_list = "Thank you for your order, you will be contacted soon for confirmation, go to  <a href='store.php'>store?</a> or <a href='store.php'>cart?</a>";
  
}

?>

<head>
  <title>Confirmation</title>
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
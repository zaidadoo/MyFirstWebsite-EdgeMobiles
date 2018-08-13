<?php

include "includes/dbh-inc.php";

if (!isset($_POST['payment_status'])){
  
  header("Location: cart.php");
  exit();
  
} elseif($_POST['payment_status'] != "Completed") {

  header("Location: cart.php?cart=error");
  exit();
  
} else {
  
$custom = $_POST['custom'];
$payer_email = $_POST['payer_email'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$payment_date = $_POST['payment_date'];
$mc_gross = $_POST['mc_gross'];
$payment_currency = $_POST['payment_currency'];
$txn_id = $_POST['txn_id'];
$receiver_email = $_POST['receiver_email'];
$payment_type = $_POST['payment_type'];
$payment_status = $_POST['payment_status'];
$txn_type = $_POST['txn_type'];
$payer_status = $_POST['payer_status'];
$address_street = $_POST['address_street'];
$address_city = $_POST['address_city'];
$address_state = $_POST['address_state'];
$address_zip = $_POST['address_zip'];
$address_country = $_POST['address_country'];
$address_status = $_POST['address_status'];
$notify_version = $_POST['notify_version'];
$verify_sign = $_POST['verify_sign'];
$payer_id = $_POST['payer_id'];
$mc_currency = $_POST['mc_currency'];
$mc_fee = $_POST['mc_fee'];

  $address = "$address_street\n$address_city\n$address_state\n$address_zip\n$address_country\n$address_status";
  
// Place the transaction into the database
$sql = "INSERT INTO transactions (product_id_array, payer_email, first_name, last_name, payment_date, mc_gross, address, payment_currency, txn_id, receiver_email, payment_type, payment_status, txn_type, payer_status, notify_version, verify_sign, payer_id, mc_currency, mc_fee) 
   VALUES('$custom','$payer_email','$first_name','$last_name','$payment_date','$mc_gross','$address','$payment_currency','$txn_id','$receiver_email','$payment_type','$payment_status','$txn_type','$payer_status','$notify_version','$verify_sign','$payer_id','$mc_currency','$mc_fee');";

$result = mysqli_query($conn, $sql);
  
unset($_SESSION["cart_array"]);
  
mysqli_close();
  
  header("Location: cart.php?cart=success");
  exit();
  
}
?>
<?php

session_start();

?>

<div class="ajax">

<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
    <link rel="shortcut icon" href="https://png.icons8.com/ios/1600/circled-e-filled.png"/>
    <link rel="stylesheet" href="css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css">
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>
</head>

<body>

  <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">

<!-- Desktop Navbar -->

<header>

	<a href="home.php">
		<img id="logo2" class="logo" src="images/Group-3.png" alt="logo">
    </a>
	
	<div class="toggle">  
		<i class="fas fa-bars"></i>
    </div>
	
	<div class="container">
    
    <a href="home.php">
		<img id="logo" class="logo" src="images/Group-11.png" alt="logo">
    </a>
    
    <nav>
      <ul>
        <li><a href="store.php">PRODUCTS</a></li>
        <li><a href="cart.php">CART</a></li>
        <?php
        if(!isset($_SESSION['s_id'])){
          
          echo '<li><a href="login.php">LOGIN</a></li>';
          
        } elseif(($_SESSION['s_user']) == 'admin') {
          
          echo '<li><a href="admin.php">ADMIN</a></li>
                <li><a href="account-menu.php">ACCOUNT</a></li>
                <li><a href="includes/logout-inc.php">LOGOUT</a></li>';
          
        } else {
          
          echo '<li><a href="account-menu.php">ACCOUNT</a></li>
                <li><a href="includes/logout-inc.php">LOGOUT</a></li>';
          
        }
        ?>
        <li><a href="contact.php">CONTACT US</a></li>
      </ul>
    </nav>
  </div>
</header>

  <script  src="js/index.js"></script>
  
</div>
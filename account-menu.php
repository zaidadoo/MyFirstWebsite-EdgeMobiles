<?php

  include_once 'header.php';

  if(!isset($_SESSION['s_id'])){
  
  header("Location: login.php");
  exit();
  }

?>

<head>
  <title>Menu</title>
</head>

<div class="form-page">
  <div class="adminform1">
    </br>
    <a href="account.php"><button class="refer">
      Manage Account
    </button></a>
    </br>
    </br>
     <a href="user_order_list.php"><button class="refer">
      Manage Orders
    </button></a>
    </br>
    </br>
  </div>
</div>

<?php
  
  include_once 'footer.php'
  
?>
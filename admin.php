<?php

  include_once 'header.php';

  if(($_SESSION['s_user']) != 'admin') {
    header ("Location: login.php");
    exit();
  }

?>

<head>
  <title>Admin</title>
</head>

<div class="form-page">
  <div class="adminform1">
    </br>
    <a href="inventory_list.php"><button class="refer">
      Manage products
    </button></a>
    </br>
    </br>
     <a href="admin_order_list.php"><button class="refer">
      Manage Local Orders
    </button></a>
    </br>
    </br>
    <a href="admin_transaction_list.php"><button class="refer">
      Manage Online Transactions
    </button></a>
    </br>
    </br>
    <a href="admin_account_list.php"><button class="refer">
      View Account List
    </button></a>
    </br>
    </br>
  </div>
</div>

<?php
  
  include_once 'footer.php'
  
?>
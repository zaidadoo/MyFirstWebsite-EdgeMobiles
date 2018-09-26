<?php

include 'dbh-inc.php';

$online = 0;

//check user
$sql = "SELECT * FROM chat_session";
$result = mysqli_query($conn, $sql);
$resultcheck2 = mysqli_num_rows($result);

if($resultcheck2 > 0){
  
  $online = 1;
  
}

?>

<a href="chat.php">
    <?php if($online == 1){
  
  echo '
<div class="footer">
  <div style="background: crimson" class="legality">
        Message Received
      </div>
</div>';
  
}else{
  
echo '
<div class="footer">
  <div class="legality">
        + Live Support
      </div>
</div>';
  
}
    ?>
    </a>
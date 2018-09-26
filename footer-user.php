<?php

$online = 0;

//check user
$sql = "SELECT * FROM chat_session";
$result = mysqli_query($conn, $sql);
$resultcheck2 = mysqli_num_rows($result);

if($resultcheck2 > 0){
  
  $online = 1;
  
}

?>

<center>
  <a href="chat.php">
<div class="footer">
  <div class="legality">
        + Live Support
      </div>
</div>
    </a>
</center>
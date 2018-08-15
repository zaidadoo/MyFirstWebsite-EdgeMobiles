<?php 

include_once 'header.php';
include 'includes/dbh-inc.php';

$offline = "";
$check_id = "";
$messages = "";
$c_user = $_SESSION['s_user'];
$verify_id = $_SESSION['s_id'];

$sql = "SELECT * FROM chat_session";
$result = mysqli_query($conn, $sql);
$resultcheck = mysqli_num_rows($result);

if($resultcheck > 0){
  
  while($row = mysqli_fetch_array($result)){
    
    $check_id = $row['account_id'];
    
  }
}

if(!isset($_SESSION['s_id'])){
  
  header("Location: login.php?login=must");
  exit();
  
}

//check admin
$sql = "SELECT * FROM admin_session";
$result = mysqli_query($conn, $sql);
$resultcheck = mysqli_num_rows($result);

//check user
$sql = "SELECT * FROM chat_session";
$result = mysqli_query($conn, $sql);
$resultcheck2 = mysqli_num_rows($result);
  
  if($resultcheck < 1){
    
    $offline = 1;
    $messages = "technical support currently offline <a href='contact.php'>contact us through email?</a>";
    
  } elseif(($resultcheck2 > 0) && ($c_user != 'admin') && ($check_id != $verify_id)) {
    
  $offline = 1;
  $messages = "technical support currently busy with another customer, please wait</a>";
  
} else { 
    
    $sql = "SELECT chat.message, chat.message_id, accounts.name, accounts.account_id
FROM chat
LEFT JOIN accounts ON chat.account_id = accounts.account_id
ORDER BY chat.message_id
ASC";

$result = mysqli_query($conn, $sql);
$resultcheck = mysqli_num_rows($result);

if($resultcheck > 0){
       
        //grab msgs
        while($row = mysqli_fetch_array($result)){
          
          $message = $row['message'];
          $name = $row['name'];
          $messages .= '<a href="#">' . $name . ':</br></br></a></br>
              <p>' . $message . '</p></br>';
          
        }
}
    
  }


?>

<head>
  <title>Live Support</title>
</head>


<div class="login-page">
  <div class="lform">
    <?php if($offline == 1){ echo $messages; } else { echo '
    <h3>Live Support</h3>
      </br>
        <div class="chat">
          
          <div class="messages">
            
           
            
          </div>
          
        </div>
      </br>
      <form action="includes/insert-chat.php" method="POST">
      <textarea id="message" style="resize:none;"class="lfield" placeholder="input message here" name="message" cols="30"></textarea>
      <input type="submit" name="submit" class="lbutton" value="Send Message"/>  
      </form>
    
</br>
    <form action="includes/end-chat.php" method="POST">
      <input type="submit" style="border: none; padding: 10px; background: lightgrey;" name="end" value="End the chat" />
    </form>
    ';}?>
  </div>
</div>

<script  src="js/chat.js"></script>
</div>
  
</div>
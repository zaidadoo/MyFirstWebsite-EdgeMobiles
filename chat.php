<?php 

include_once 'header.php';
include 'includes/dbh-inc.php';

$offline = "";
$message = "";

if(!isset($_SESSION['s_id'])){
  
  header("Location: login.php?login=must");
  exit();
  
}

$sql = "SELECT * FROM admin_session";
$result = mysqli_query($conn, $sql);
$resultcheck = mysqli_num_rows($result);
  
  if($resultcheck < 1){
    
    $offline = 1;
    $messages = "technical support currently offline <a href='contact.php'>contact us through email?</a>";
    
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
            
            <div class="message">
              
              '. $messages .'
            
            </div>
            
          </div>
          
        </div>
      </br>
      <form action="includes/insert-chat.php" method="POST">
      <textarea id="message" style="resize:none;"class="lfield" placeholder="input message here" name="message" cols="30"></textarea>
      <input type="submit" name="submit" class="lbutton" value="Send Message"/>  
      </form>
    
</br>
    <a href="includes/end-chat.php" class="additem"><div align="left" style="margin-right:32px;">
      + End Chat
    </div></a>
    ';}?>
  </div>
</div>
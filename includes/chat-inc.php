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

<?php 

session_start();

include 'dbh-inc.php';

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
  
  header("Location: ../login.php?login=must");
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

            
<div class="message">
              
<?php echo $messages; ?>
            
</div>
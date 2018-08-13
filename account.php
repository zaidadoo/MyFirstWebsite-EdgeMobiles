<?php

include_once 'header.php';

if(!isset($_SESSION['s_id'])){
  
  header("Location: login.php");
  exit();
  
} else {
  
  $name = $_SESSION['s_name'];
  $email = $_SESSION['s_email'];
  $phone = $_SESSION['s_phone'];
  $street = $_SESSION['s_street'];
  $building = $_SESSION['s_building'];
  $floor = $_SESSION['s_floor'];
  $apartment = $_SESSION['s_apartment'];
  $notes = $_SESSION['s_notes'];
  
}

?>

<head>
  <title>Account</title>
</head>

 <!-- Update Form -->

<div class="form-page">
  <div class="aform">
    </br>
    </br>
    <a href="account-menu.php" class="additem"><div align="right" style="margin-right:32px;">
      + Back
    </div></a>
    <form action="includes/account-inc.php" method="POST">
      <span class="error">
        <?php
      $host = $_SERVER['REQUEST_URI'];
      if($host == '/account.php?account=empty'){
        
        echo "<p>Error: fields empty</p></br>";
        
      } elseif($host == '/account.php?account=password'){
        
        echo "<p>Error: password does not match</p></br>";
        
      } elseif($host == '/account.php?account=email'){
        
        echo "<p>Error: email invalid</p></br>";
        
      } elseif($host == '/account.php?account=emailtaken'){
        
        echo "<p>Error: email already in use</p></br>";
        
      } elseif($host == '/account.php?account=emailsuccess'){
        
        echo "<p>Email successfully changed</p></br>";
        
      } elseif($host == '/account.php?account=name'){
        
        echo "<p>Error: name invalid</p></br>";
        
      } elseif($host == '/account.php?account=namesuccess'){
        
        echo "<p>Username successfully changed</p></br>";
        
      } elseif($host == '/account.php?account=emailnamesuccess'){
        
        echo "<p>Email and Name successfully changed</p></br>";
        
      } elseif($host == '/account.php?account=passwordsuccess'){
        
        echo "<p>Password successfully changed</p></br>";
        
      } elseif($host == '/account.php?account=passwordnamesuccess'){
        
        echo "<p>Password and Name successfully changed</p></br>";
        
      } elseif($host == '/account.php?account=passwordemailsuccess'){
        
        echo "<p>Password and Email successfully changed</p></br>";
        
      } elseif($host == '/account.php?account=allsuccess'){
        
        echo "<p>Password, Email, and Name successfully changed</p></br>";
        
      } elseif($host == '/account.php?account=addressempty'){
        
        echo "<p>Error: phone, street, and building # must be filled</p></br>";
        
      } elseif($host == '/account.php?account=successaddress'){
        
        echo "<p>Address updated successfully</p></br>";
        
      }
      ?>
      </span>
      <div class="account-left">
        <p style="text-align: left;">Please fill in only the options you desire changing </p>
        <p style="text-align: left;">Change password:</p>
        <input class="lfield" type="text" placeholder="new password" name="new-password"/>
        <input class="lfield" type="text" placeholder="re-type new password" name="verify-password"/>
        <p style="text-align: left;">Change email or name:</p>
        <input class="lfield" type="text" <?php echo "placeholder='$name'" ?> name="name"/>
        <input class="lfield" type="text" <?php echo "placeholder='$email'" ?> name="email"/>
        <input class="lbutton" type="submit" value="update account" name="submit">
      </div>
    </form>
    <form action="includes/address-inc.php" method="POST">
      <div class="account-right">
        <p style="text-align: left;">Please fill in phone, street, and building # at least</p>
        <input class="lfield" type="text" placeholder="phone" name="phone" <?php echo "value='$phone'" ?>/>
       <input class="lfield" type="text" placeholder="city" name="city" value="Amman" readonly/>
       <input class="lfield" type="text" placeholder="street" name="street" <?php echo "value='$street'" ?>/>
       <input class="lfield" type="text" placeholder="building #" name="building" maxlength="2" <?php echo "value='$building'" ?>/>
       <input class="lfield" type="text" placeholder="floor #" name="floor" maxlength="2" <?php echo "value='$floor'" ?>/>
       <input class="lfield" type="text" placeholder="apartment #" name="apartment" maxlength="2" <?php echo "value='$apartment'" ?>/>
       <input class="lfield" type="text" placeholder="notes" name="notes" <?php echo "value='$notes'" ?>/>
       <input class="lbutton" type="submit" value="update address" name="submit">
       </br></br>
      </div>
    </form>
  </div>
</div>

<?php

include_once 'footer.php';

?>
<?php 

include_once 'header.php';

if(isset($_SESSION['s_id'])){
  
  header("Location: account-menu.php");
  exit();
  
}

?>

<head>
  <title>Login</title>
</head>

  <!-- Login Form -->
  
  <div class="login-page">
  <div class="lform">
    <form action="includes/login-inc.php" method="POST">
      <span class="error">
      <?php
      $host = $_SERVER['REQUEST_URI'];
      if($host == '/login.php?login=empty'){
        
        echo "<p>Error: fields empty</p></br>";
        
      } elseif($host == '/login.php?login=error'){
        
        echo "<p>Error: password or username invalid</p></br>";
        
      } elseif($host == '/login.php?login=logout'){
        
        echo "<p>Logout successful</p></br>";
        
      } elseif($host == '/login.php?login=must'){
        
        echo "<p>Please login first</p></br>";
        
      }
      ?>
      </span>
      <input class="lfield" type="text" placeholder="username or email" name="username"/>
      <input class="lfield" type="password" placeholder="password" name="password"/>
      <input class="lbutton" type="submit" value="submit" name="submit">
      <p class="lmessage">Not registered? <a href="signup.php">Create an account</a></p>
    </form>
  </div>
</div>

  <!-- footer -->

<?php 

include_once 'footer.php';

?>

</body>
</html>
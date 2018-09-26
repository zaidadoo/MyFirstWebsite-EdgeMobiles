<?php 

include_once 'header.php';

?>

<head>
  <title>Sign Up</title>
</head>

  <!-- Signup Form -->
  
  <div class="login-page">
  <div class="lform">
    <form action="includes/signup-inc.php" method="POST">
     <span class="error">
     <?php
      $host = $_SERVER['REQUEST_URI'];
      if($host == '/signup.php?signup=empty'){
        
        echo "<p>Error: field empty</p></br>";
        
      } elseif($host == '/signup.php?signup=invalid'){
        
          echo "<p>Error: name invalid</p></br>";
        
      } elseif($host == '/signup.php?signup=email'){
        
        echo "<p>Error: email invalid</p></br>";
        
      } elseif($host == '/signup.php?signup=usertaken'){
        
        echo "<p>Error: email or username already taken</p></br>";
        
      }
      ?>
      </span>
      <input class="lfield" type="text" placeholder="username" name="username"/>
      <input class="lfield" type="password" placeholder="password" name="password"/>
      <input class="lfield" type="text" placeholder="name" name="name"/>
      <input class="lfield" type="text" placeholder="email address" name="email"/>
      <input class="lbutton" type="submit" value="submit" name="submit">
      <p class="lmessage">Already registered? <a href="login.php">Sign In</a></p>
    </form>
  </div>
</div>

  <!-- footer -->

<?php 

include_once 'footer.php';

?>

</body>

</html>
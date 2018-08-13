<?php 

include_once 'header.php';

?>

<head>
  <title>Messaging</title>
</head>

<div class="login-page">
  <div class="lform">
    <h3>
      Chat Message
      </br></br>
      <form>
        <textarea style="resize:none;"class="lfield" placeholder="input message here" name="message" rows="10" cols="30"></textarea>
        <input class="lbutton" type="submit" value="Send Message" name="submit">
      </form>
    </h3>
  </div>
</div>

<script>
  
  $(function(){
    
    var socket = io.connect();
    
  });
  
</script>
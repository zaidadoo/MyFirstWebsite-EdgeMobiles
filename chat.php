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
      <textarea style="resize:none; border: solid 1px grey;"class="lfield" placeholder="chat is here" rows="10" name="message" cols="30" readonly></textarea>
      <form>
        <textarea style="resize:none;"class="lfield" placeholder="input message here" name="message" cols="30"></textarea>
        <input class="lbutton" type="submit" value="Send Message" name="submit">
      </form>
    </h3>
  </div>
</div>
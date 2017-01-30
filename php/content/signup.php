<form id="formSignup" action="php/auth_functions.php?fun=signup" method="POST">
  <fieldset>
    <span>Registrati</span>
    <input class="loginTextInput" type="text" name="username" placeholder="Username">
    <br />
    <input class="loginTextInput" type="password" name="password" placeholder="Password">
    <br />
    <input class="loginTextInput" type="password" name="verifica" placeholder="Verifica Password">
    <input class="loginSendInput" type="submit" value="INVIA" >
    <br />
    <div class="gotoRegistrati"><a href="index.php?content=login">Clicca qua per loggarti</a></div>
  </fieldset>
</form>
<?php
if (session_status() == PHP_SESSION_NONE)
  session_start();

if (!empty($_SESSION['messaggio'])) {
  echo $_SESSION['messaggio'];
}
?>

<form id="formSignup" action="php/auth_functions.php?fun=signup" method="POST">
  <fieldset>
    <div>Registrati</div>
    <input type="text" name="username" placeholder="Username">
    <br />
    <input type="password" name="password" placeholder="Password">
    <br />
    <input type="password" name="verifica" placeholder="Verifica Password">
    <input type="submit" value="INVIA" >
    <br />
    <a href="index.php?content=login">clicca qua per loggarti</a>
  </fieldset>
</form>
<?php
session_start();

if (!empty($_SESSION['messaggio'])) {
  echo $_SESSION['messaggio'];
}
?>

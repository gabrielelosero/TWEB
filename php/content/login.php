<form id="formLogin" action="php/auth_functions.php?fun=login" method="POST">
  <fieldset>
    <div>Log-in</div>
    <input type="text" name="username" placeholder="Username">
    <br />
    <input type="password" name="password" placeholder="Password">
    <input type="submit" value="INVIA" >
    <br />
    <a href="">clicca qua per registrati</a>
  </fieldset>
</form>
<?php
session_start();

if (!empty($_SESSION['username'])) {
  echo $_SESSION['username']." ha effettuato il logout.";
  echo "<br />";
}

if (!empty($_SESSION['loginMessage'])) {
  echo $_SESSION['loginMessage'];
}
session_destroy();

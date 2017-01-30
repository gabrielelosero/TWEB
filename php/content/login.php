<form id="formLogin" action="php/auth_functions.php?fun=login" method="POST">
  <fieldset>
    <span>LOG-IN</span>
    <input class="loginTextInput" type="text" name="username" placeholder="Username">
    <br />
    <input class="loginTextInput" type="password" name="password" placeholder="Password">
    <br />
    <input class="loginSendInput" type="submit" value="INVIA" >
    <br />
    <div class="gotoRegistrati"><a href="index.php?content=signup">Clicca qua per registrarti.</a></div>
  
<?php
if (session_status() == PHP_SESSION_NONE)
  session_start();

if (!empty($_SESSION['username'])) {
  echo "<div class='messageDiv'>";
  echo $_SESSION['username']." ha effettuato il logout.";
  echo "</div>";
  echo "<br />";
}

if (!empty($_SESSION['loginMessage'])) {
  echo "<div class='messageDiv'>";
  echo $_SESSION['loginMessage'];
  echo "</div>";
}

if (!empty($_SESSION['messaggio'])) {
  echo "<div class='messageDiv'>";
  echo $_SESSION['messaggio'];
  echo "</div>";
}

if (!empty($_GET['messaggio'])) {
  if ($_GET['messaggio'] == 'needLogin')
    echo "<div class='messageDiv'>";
    echo "Devi loggarti per poter vedere la pagina.";
    echo "</div>";
}
session_destroy();
?>
  </fieldset>
</form>

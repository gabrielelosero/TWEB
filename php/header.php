<div id="header">
  <h1><a href="index.php">Fantacalcio TWEB</a></h1>
<?php

if (session_status() == PHP_SESSION_NONE) {
  session_start();
  if (!empty($_SESSION['id'])) {
    echo "<div id='userBox'>";
    echo "<span>".$_SESSION['username']." | ";
    echo "<a class='link' href='php/auth_functions.php?fun=logout'> LOGOUT</a></span>";
    echo "</div>";
  }
}

?>
</div>

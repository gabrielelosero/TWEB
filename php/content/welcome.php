<?php
session_start();

include_once("php/content/homepage.php");
if (!empty($_SESSION['id'])) {
  
  echo "<h3>Benvenuto ".$_SESSION['username']."!</h3>";
}

?>

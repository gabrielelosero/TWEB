<?php


function getPlayers() {

  require("setting.php");
  $query = "SELECT * FROM giocatori";
  $result = mysql_query($query, $conn) or die(mysql_error());
  return $result;
}

?>

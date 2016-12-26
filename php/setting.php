<?php
/* parametri database */
$mysql_servername = "localhost";
$mysql_user = "root";
$mysql_password = "mysql";
$mysql_db = "TWEB";

// connesione al db
$conn = mysql_connect($mysql_servername, $mysql_user, $mysql_password) or die(mysql_error());
mysql_select_db($mysql_db, $conn) or die(mysql_error());

?>

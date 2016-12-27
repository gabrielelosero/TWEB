<html>

<head>
  <title>Fantacalcio TWEB</title>
  <link href="css/stile.css" type="text/css" rel="stylesheet" />
</head>

<body>

<?php

// carico i file con le funzioni di php
include_once("php/auth_functions.php");

// e l'header della pagina
include_once("php/header.php");

if (empty($_GET['content'])) {
  include_once("php/content/homepage.php");
} 

else {
  
  switch ($_GET['content']) {

  case 'login':
    include_once("php/content/login.php");
    break;

  default:
    include_once("php/content/homepage.php");
    break;
  }

}

?>


  
</body>

</html>

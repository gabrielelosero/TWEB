<html>

<head>
  <title>Fantacalcio TWEB</title>
  <link href="css/stile.css" type="text/css" rel="stylesheet" />
  <!--<script src="js/scriptaculous/lib/prototype.js" type="text/javascript"></script>
  <script src="js/scriptaculous/src/scriptaculous.js" type="text/javascript"></script>
  <script src="js/jquery/jquery.js" type="text/javascript"></script>
  <script src="js/functionsDB.js" type="text/javascript"></script>-->
</head>

<body>
<?php

/*
 *
 * Includo l'header e i file con le funzioni in php
 *
 */
include_once("php/ajax_functions.php");
include_once("php/auth_functions.php");
include_once("php/header.php");

/*
 *
 * Includo il menu sulla sinistra
 *
 */
include_once("php/menu.php");

/* 
 *
 * Includo il div centrale
 * dentro al div centrale viene caricata la pagina
 * corrispondente alla variabile $_GET['content']
 *
 */
include_once("php/main_content.php");

?>
</body>

</html>

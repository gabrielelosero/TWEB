<div id="main" class="stdHeight">
<?php
include_once("php/header.php");
// include_once("php/menu.php");
echo "<div id='main_content'>";
if (empty($_GET['content'])) {
  include_once("php/content/homepage.php");
}

else {
  
  switch ($_GET['content']) {

  case 'login':
    include_once("php/content/login.php");
    break;

  case 'signup':
    include_once("php/content/signup.php");
    break;

  case 'giocatori':
    include_once("php/content/giocatori.php");
    break;

  case 'team':
    include_once("php/content/team.php");
    break;
  
  case 'squadra':
    include_once("php/content/squadre.php");
    break;

  case 'schedaGiocatore':
    include_once("php/content/schedaGiocatore.php");
    break;
  
  case 'schedaTeam':
    include_once("php/content/schedaTeam.php");
    break;
  
  case 'compraGiocatore':
    include_once("php/content/compraGiocatore.php");
    break;
  
  case 'test':
    include_once("php/content/test.php");
    break;
  
  default:
    include_once("php/content/homepage.php");
    break;
  }
}
echo "</div>";
echo "</div>";
include_once("php/footer.php");
?>

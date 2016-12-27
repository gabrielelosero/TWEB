<div id="main" class="stdWidth stdHeight">
<?php
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

  default:
    include_once("php/content/homepage.php");
    break;
  }
}
?>
</div>

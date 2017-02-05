<h2 class="titoloDue">Tutti i Team</h2>

<?php

if (session_status() == PHP_SESSION_NONE)
  session_start();

if (empty($_SESSION['id'])) {
  header('Location: index.php?content=login&messaggio=needLogin');
}

if (!empty($_GET['mode'])) {
  if ($_GET['mode'] == 'list') {

    if (!empty($_SESSION['message'])) {
      echo "<p>".$_SESSION['message']."</p>";
      unset($_SESSION['message']);
    }

    $teams = getAllTeam();
    echo "<table class='tableTeam'>";
    echo $teams;
    echo "<tr><td colspan='4'><a href='index.php?content=team&mode=create'><button>Crea un nuovo Team</button></a></td></tr>";
    echo "</table>";
    echo "<br /><br />";
  }
  
  elseif ($_GET['mode'] == 'create') {
?>

<h4>Crea un nuovo Team</h4>
<form id="formCreaTeam" action="php/team_functions.php?fun=create" method="POST">
  <fieldset>
    <input type="text" name="nome" placeholder="Nome Team">
    <input type="submit" value="INVIA" >
    <br />
  </fieldset>
</form>

<?php
      
    if (!empty($_SESSION['error'])) {
      echo "<div class='divError'>";
      echo "<p>".$_SESSION['error']."</p>";
      echo "</div>";
    }
  }
}
?>

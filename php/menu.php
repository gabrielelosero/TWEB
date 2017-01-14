<div id="menu" class="stdWidth" ><!-- class="stdHeight">-->
  <div id="mainMenu">
    <span>MENU</span>
    <ul>
      <li><a href="index.php">Home Page</a></li>
      <li><a href="index.php?content=giocatori">Tutti i Giocatori</a></li>
      <li><a href="index.php?content=team&mode=list">Team</a></li>
      <li><a href="index.php?content=compraGiocatore">Mercato</a></li>
      <li><a href="#">Pagina Quattro</a></li>
      <li><a href="index.php?content=test">Pagina Cinque</a></li>
    </ul>
  </div>
<?php

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
if (!empty($_SESSION['id'])) {
  echo "<div id='teamMenu'>";
  echo "<span>I MIEI TEAM</span>";
  echo "<ul><li></li>";
  $teams = getAllUserTeam($_SESSION['id']);
  foreach ($teams as $t) 
    echo "<li><a href='index.php?content=schedaTeam&teamid=$t[0]'>".$t[1]."</a></li>";
  echo "</ul></div>";
}
?>
</div>

<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
?>

<ul class="nav site-nav">
  
  <li><a href="index.php">Home Page</a>

  <!-- GIOCATORI -->
  <li class="flyout">
    <a href="index.php?content=giocatori">Tutti i Giocatori</a>
    <ul class="flyout-content nav stacked flyout-background">
      <li><a href="index.php?content=giocatori&mode=nome">Cerca per Nome</a></li>
      <li><a href="index.php?content=giocatori&mode=ruolo">Cerca per Ruolo</a></li>
      <li><a href="index.php?content=giocatori&mode=squadra">Cerca per Squadra</a></li>
    </ul>

  <!-- TEAM -->
  <li class="flyout">
    <a href="index.php?content=team&mode=list">Team</a>
    <ul class="flyout-content nav stacked flyout-background">
      <li><a href="index.php?content=team&mode=list">Tutti i Team</a></li>
<?php
if (!empty($_SESSION['id'])) {
  $teams = getAllUserTeam($_SESSION['id']);
  foreach ($teams as $t) 
    echo "<li><a href='index.php?content=schedaTeam&teamid=$t[0]'>".$t[1]."</a></li>";
}
?>
    </ul>

  <li><a href="index.php?content=compraGiocatore">Mercato</a>
  
  <li><a href="index.php?content=test">Test</a>
<?php
if (!empty($_SESSION['id'])) {
  echo "<li class='flyout'>";
  echo "<a href=''>".$_SESSION['username']."</a>";
  echo "<ul class='flyout-content nav stacked flyout-background'>";
  echo "<li><a href='php/auth_functions.php?fun=logout'>Log Out</a></li></ul>";
}
if (!empty($_SESSION['teamid'])) {
  echo "<li class='flyout'>";
  $teamname = getTeamById($_SESSION['teamid']);
  echo "<a href=''>".$teamname[1]."</a>";
  echo "<ul class='flyout-content nav stacked flyout-background'>";
  $teams = getAllUserTeam($_SESSION['id']);
  foreach ($teams as $t) 
    echo "<li><a href='index.php?content=schedaTeam&teamid=$t[0]'>".$t[1]."</a></li>";
}
?>


</ul>

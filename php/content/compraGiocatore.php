<h2 class="titoloDue">Compra Giocatore</h2>

<div id="divSearch">
  Cerca un giocatore: 
  <input id="searchPlayer">
  <br /><br />
  <table id='tableSearchPlayer' class='invisible'>
  </table>
  <br /><br />
<?php
if (!empty($_SESSION['message'])) {
  echo "<p>".$_SESSION['message']."</p>";
  unset($_SESSION['message']);
}
?>
</div>

<form id="formCompra" action="php/team_functions.php?fun=compra" method="POST">
<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
if (empty($_SESSION['id'])) {
  header('Location: index.php?content=login&messaggio=needLogin');
}

echo "<span>Giocatore: </span>";
if (!empty($_GET['playerid'])) {

  $playerid = $_GET['playerid'];
  $player = getPlayerById($playerid);
  $p = mysql_fetch_row($player);
  $playername = $p[1];
  echo "<input id='playerinput' type='text' name='playername' value='".trim($playername)."'>";
}
else {
  echo "<input id='playerinput' type='text' name='playername' placeholder='Nome Giocatore'>";
}
echo "<br />";
echo "<span>Team: </span>";
if (!empty($_GET['teamid'])) {

  $teamid = $_GET['teamid'];
  $team = getTeamById($teamid);
  $teamname = $team[1];
  echo "<input type='text' name='teamname' value='".trim($teamname)."' >";

}
else {
  echo "<select type='text' name='teamname' placeholder='Nome Team' >";
  $team = getAllUserTeam($_SESSION['id']);
  foreach ($team as $t) {
    echo "<option value='".$t[1]."'>".$t[1]."</option>";
  }
  echo "</select>";
}
echo "<br /><br />";
echo "<input type='submit' value='COMPRA' >";
echo "<br />";
echo "</form>";
?>



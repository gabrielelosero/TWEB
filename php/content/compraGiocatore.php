<h3>Compra Giocatore</h3>
<div id="divSearch">
  Cerca un giocatore: 
  <input id="searchPlayer">
  <table id='tableSearchPlayer' class='invisible'></table>
  <br /><br />
  <input id="searchTeam">
</div>
<form id="formCompra"><!--action="php/team_functions.php" method="POST">-->
<?php

if (!empty($_GET['playerid'])) {

  $playerid = $_GET['playerid'];
  $player = getPlayerById($playerid);
  $p = mysql_fetch_row($player);
  $playername = $p[1];
  echo "<input id='playerinput' type='text' name='playername' value='".trim($playername)."' >";
  echo "<table id='tableSearchPlayer' class='invisible'></table>";
}
else {
  echo "<input id='playerinput' type='text' name='playername' placeholder='Nome Giocatore' >";
  echo "<table id='tableSearchPlayer' class='invisible'></table>";
}

if (!empty($_GET['teamid'])) {

  $teamid = $_GET['teamid'];
  $team = getTeamById($teamid);
  $teamname = $team[1];
  echo "<input type='text' name='teamname' value='".trim($teamname)."' >";

}
else {
  echo "<input type='text' name='teamname' placeholder='Nome Team' >";
}
echo "<input type='submit' value='COMPRA' >";
echo "<br />";
?>
</form>

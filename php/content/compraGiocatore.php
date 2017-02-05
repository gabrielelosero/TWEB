<h2 class="titoloDue">Mercato</h2>

<div id="divSearch">

</div>

<form id="formCompra" action="php/team_functions.php?fun=compra" method="POST">
<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
$use_team = $_SESSION['id_team'];
if (empty($_SESSION['id'])) {
  header('Location: index.php?content=login&messaggio=needLogin');
}

$r = getPlayerById($_GET['playerid']);
$columns = ['ruolo', 'valore', 'presenze', 'goal', 'ammonizioni', 'espulsioni', 'media', 'fantamedia'];
echo "<table class='tableGiocatori'>";
?>
<tr>  
    <th id="playerName" onclick="ordinaGiocatoriPer('nome')" ordine="asc">Nome</td>
    <th onclick="ordinaGiocatoriPer('squadra')">Squadra</th>
    <th onclick="ordinaGiocatoriPer('ruolo')">Ruolo</th>
    <th onclick="ordinaGiocatoriPer('valore')">Valore</th>
    <th onclick="ordinaGiocatoriPer('presenze')">Pres</th>
    <th onclick="ordinaGiocatoriPer('goal')">Goal</th>
    <th onclick="ordinaGiocatoriPer('ammonizioni')">Amm</th>
    <th onclick="ordinaGiocatoriPer('espulsioni')">Esp</th>
    <th onclick="ordinaGiocatoriPer('media')">Media</th>
    <th onclick="ordinaGiocatoriPer('fantamedia')">FantaMedia</th>
  </tr>
<?php
$p = genPlayerTable2($r, $columns);
echo $p;
echo "</table>";


// echo "<span>Giocatore: </span>";
if (!empty($_GET['playerid'])) {

  $playerid = $_GET['playerid'];
  $player = getPlayerById($playerid);
  $p = mysql_fetch_row($player);
  $playername = $p[1];
  echo "<input class='invisible' id='playerinput' type='text' name='playername' value='".trim($playername)."'>";
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

if (!empty($_SESSION['message'])) {
  echo "<p style='font-size: 20px'>".$_SESSION['message']."</p>";
  unset($_SESSION['message']);
}
else {
  echo "<p style='font-size: 20px;'>Stai per comprare $playername per la squadra $t[1], clicca su COMPRA per confermare.</p>";
}
echo "<input style='margin-left: 80%' type='submit' value='COMPRA' >";
echo "<br />";
echo "</form>";
?>

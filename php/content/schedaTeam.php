<h2 class="titoloDue">Scheda Team</h2>
<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
?>
<div id="headerTeam">
  <table>
    <tr>
      <th id="headerTeamGenerale" class="selected" onclick="switchTeamSection('generale')">Team</th>
      <th id="headerTeamFormazione" onclick="switchTeamSection('formazione')">Formazione</th>
      <th id="headerTeamVoti" onclick="switchTeamSection('voti')">Ultima Giornata</th>
    </tr>
  </table>
</div>


<?php

echo "<div class='schedaTeamGenerale'>";
if (!empty($_GET['teamid'])) {

  $team = getTeamById($_GET['teamid']);
  $_SESSION['teamid'] = $_GET['teamid'];

  $teamid = $team[0];
  $nome = $team[1];
  $cash = $team[2];
  $punti = $team[3];

  echo "<table class='tableTeam'>";
  $user = getUserById($_SESSION['id']);
  $username = $user[1];

  $strtable .= "<tr><th>Nome Squadra</th><th>Nome Utente</th><th>Soldi</th><th>Punti</th></tr>";
  $strtable .= "<tr class='trpari'><td>";
  $strtable .= "<a href='index.php?content=schedaTeam&teamid=$teamid'>".$nome."</a></td>";
  $strtable .= "<td>".$username."</td>";
  $strtable .= "<td>".$team[2]."</td>";
  $strtable .= "<td>".$team[3]."</td>";
  $strtable .= "</tr>";
  echo $strtable;
  echo "</table>";

  echo "<table class='tableGiocatori'>";
  echo "<tr><th>Nome</th><th>Ruolo</th><th>Valore</th><th>Squadra</th><th>Presenze</th><th>Goal</th><th>Ammonizioni</th><th>Espulsioni</th><th>Media</th><th>FantaMedia</th>";
  if (isMyTeam($_SESSION['id'], $teamid)) {
    echo "<th>Vendi</th></tr>";
  } else {
    echo "</tr>";
  }
  if (isMyTeam($_SESSION['id'], $teamid)) 
    $players = getPlayersByTeam($team[0]);
  else
    $players = getPlayersByTeam($team[0], FALSE);
  echo $players;
  echo "</table>";


    if (!empty($_SESSION['message'])) {
    echo "<p>".$_SESSION['message']."</p>";
    unset($_SESSION['message']);
  }

}
echo "</div>";

echo "<div class='schedaTeamFormazione invisible'>";
echo "<table class='tableGiocatori'>";
echo "<tr><th>Nome</th><th>Squadra</th><th>Ruolo</th><th>Presenze</th><th>Goal</th></th><th>Fanta Voto</th><th>Titolare</th></tr>";
$formazione_table = genFormazioneTable($_GET['teamid']);
echo "</table>";
echo "<button id='schieraFormazione' onclick='schieraFormazione(".$_SESSION['teamid'].")'>Schiera Formazione</button>";
echo "<div id='formazioneErrorDiv'></div>";
echo "</div>";

echo "<div class='schedaTeamVoti invisible'>";
echo "<table class='tableGiocatori tableVoti'>";
echo "<tr><th>Nome</th><th>Squadra</th><th>Voto</th><th>Goal</th><th>Assist</th><th>Rigori</th><th>Rigori Sbagliati</th><th>Autogoal</th><th>Ammonizioni</th><th>Espulsioni</th><th>Fanta Voto</th></tr>";
$voti_table = genVotiTable($_GET['teamid']);
echo "</table>";
echo "<div id='puntiGuadagnati'><span>Totale Punti: </span></div>";

echo "</div>";


?>



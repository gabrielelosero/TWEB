<h2 class="titoloDue">Scheda Team</h2>
<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
if (!empty($_GET['teamid'])) {

  $team = getTeamById($_GET['teamid']);
  $_SESSION['teamid'] = $_GET['teamid'];

  echo "<button id='switchSchedaTeam'>Voti Ultima Giornata</button>";

  $nome = $team[1];
  $cash = $team[2];

  echo "<div id='teamPlayers'>";
  $players = getPlayersByTeam($team[0]);

  echo "<table><tr><td>Nome: </td>";
  echo "<td>$nome</td></tr>";
  echo "<tr><td>Soldi: </td>";
  echo "<td>$cash</td></tr></table>";
  echo "<br />";
  echo "<table id='tableGiocatoriSchedaTeam'>";
  echo "<tr><th>Nome</th><th>Ruolo</th><th>Squadra</th><th>Valore</th><th>Presenze</th><th>Goal</th><th>Ammonizioni</th><th>Espulsioni</th><th>Media</th><th>FantaMedia</th><th>Vendi</th></tr>";
  echo $players;
  echo "</table>";
  echo "<br /><br />";
  echo "<a href='index.php?content=compraGiocatore&teamid=$team[0]'>Compra un giocatore</a>";
  echo "</div>";

  echo "<div id='votiTeam' class='invisible'>";
  $giocatori = getPlayersIdByTeam($team[0]);
  $giocatori = getPlayersByIds($giocatori);
  echo "<table>";
  echo $giocatori;
  echo "</table>";
  echo "</div>";

  if (!empty($_SESSION['message'])) {
    echo "<p>".$_SESSION['message']."</p>";
    unset($_SESSION['message']);
  }

}
?>

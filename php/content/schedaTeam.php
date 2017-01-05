<h3>Scheda Team</h3>
<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
if (!empty($_GET['teamid'])) {

  $team = getTeamById($_GET['teamid']);
  $_SESSION['teamid'] = $_GET['teamid'];

  $nome = $team[1];
  $cash = $team[2];

  $players = getPlayersByTeam($team[0]);

  echo "<table><tr><td>Nome: </td>";
  echo "<td>$nome</td></tr>";
  echo "<tr><td>Soldi: </td>";
  echo "<td>$cash</td></tr></table>";
  echo "<br />";
  echo "<table id='tableGiocatoriSchedaTeam'>";
  echo $players;
  echo "</table>";
  echo "<br /><br />";
  echo "<a href='index.php?content=compraGiocatore&teamid=$team[0]'>Compra un giocatore</a>";

  if (!empty($_SESSION['message'])) {
    echo "<p>".$_SESSION['message']."</p>";
    unset($_SESSION['message']);
  }

}
?>

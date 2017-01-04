<h3>Scheda Team</h3>
<?php

if (!empty($_GET['teamid'])) {

  $team = getTeamById($_GET['teamid']);

  $nome = $team[1];
  $cash = $team[2];

  echo "<table><tr><td>Nome</td>";
  echo "<td>$nome</td></tr>";
  echo "<tr><td>Soldi</td>";
  echo "<td>$cash</td></tr></table>";
  echo "<br />";
  echo "<a href='index.php?content=compraGiocatore&teamid=$team[0]'>Compra un giocatore</a>";


}
?>

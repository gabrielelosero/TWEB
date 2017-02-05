<h2 class="titoloDue">Classifica Team</h2>

<table id="classificaTable" class="tableGiocatori">
<tr><th>Posizione</th><th>Utente</th><th>Team</th><th>Punti Ultima Giornata</th><th>Punti Totali</th></tr>

<?php

$pari = TRUE;
$cont = 0;
$result = getClassificaTable();
while ($r = mysql_fetch_row($result)) {

  $cont ++;
  if ($pari) {
    echo "<tr class='trpari'>";
    $pari = FALSE;
  }
  else {
    echo "<tr class='trdispari'>";
    $pari = TRUE;
  }
  $user = getUserById($r[0]);
  $team = getTeamById($r[1]);
  echo "<td>$cont</td>";
  echo "<td>".$user[1]."</td><td>".$team[1]."</td><td>$r[2]</td><td>$r[3]</td>";
  echo "</tr>";
}

?>
</table>



<table id="allPlayers">
  <tr>  
    <td>Nome</td>
    <td>Ruolo</td>
    <td>Valore</td>
    <td>Squadra</td>
    <td>Pres</td>
    <td>Goal</td>
    <td>Amm</td>
    <td>Esp</td>
    <td>Media</td>
    <td>FantaMedia</td>
  </tr>
<?php

$giocatori = getPlayers();
while ($g = mysql_fetch_row($giocatori)) {
  echo "<tr>";
  for ($i=1; $i<count($g);$i++)
    echo "<td>".$g[$i]."</td>";
  echo "</tr>";
}

?>

  </tr>
</table>

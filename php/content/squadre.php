<?php
if (!empty($_GET['squadra'])) {
  echo "<h3 class='TableTitle'>".ucfirst($_GET['squadra'])."</h3>";
}
?>
<table id="tableSquadra" class="tableGiocatori">
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

$squadra = getPlayersFromTeam($_GET['squadra']);
echo $squadra;

?>
</table>

<?php
if (!empty($_GET['squadra'])) {
  echo "<h2 class='titoloDue'>".ucfirst($_GET['squadra'])."</h2>";
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

$squadra = getPlayersBySquadra($_GET['squadra']);
echo $squadra;

?>
</table>

<?php
$nome =  trim($_GET['nome']);
$spec = getPlayerByName($nome);

$s = mysql_fetch_row($spec);
?>

  <h2 class="titoloDue">SchedaGiocatore:<br /><?php echo $nome;?></h2>

  <h1></h1>
<table class="tableSchedaGiocatore">
  <tr><th>Nome</th><th>Ruolo</th><th>Valore</th><th>Squadra</th></tr>
  <tr class="trpari">
    <td><?php echo $s[1];?></td>
    <td><?php echo $s[2];?></td>
    <td><?php echo $s[3];?></td>
    <td><?php echo $s[4];?></td>
  </tr>
</table>
<table class="tableSchedaGiocatore">
  <tr><th>Presenze</th><th>Goal</th><th>Ammonizioni</th><th>Espulsioni</th></tr>
  <tr class="trpari">
    <td><?php echo $s[5];?></td>
    <td><?php echo $s[6];?></td>
    <td><?php echo $s[7];?></td>
    <td><?php echo $s[8];?></td>
  </tr>
</table>

<table class="tableSchedaGiocatore2">
  <tr><th colspan="2">Media</th><th colspan="2">Fanta Media</th></tr>
  <tr class="trdispari">
    <td colspan="2"><?php echo $s[9];?></td>
    <td colspan="2"><?php echo $s[10];?></td>
  </tr>
</table>

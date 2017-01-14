<h2 class="titoloDue">Scheda Giocatore</h2>

<?php
$nome =  trim($_GET['nome']);
$spec = getPlayerByName($nome);

$s = mysql_fetch_row($spec);
?>

<table>
  <tr>
    <td>Nome:</td>
    <td><?php echo $s[1];?></td>
  </tr>
  <tr>
    <td>Ruolo:</td>
    <td><?php echo $s[2];?></td>
  </tr>
  <tr>
    <td>Valore:</td>
    <td><?php echo $s[3];?></td>
  </tr>
  <tr>
    <td>Squadra:</td>
    <td><?php echo $s[4];?></td>
  </tr>
  <tr>
    <td>Presenze:</td>
    <td><?php echo $s[5];?></td>
  </tr>
  <tr>
    <td>Goal:</td>
    <td><?php echo $s[6];?></td>
  </tr>
  <tr>
    <td>Ammonizioni:</td>
    <td><?php echo $s[7];?></td>
  </tr>
  <tr>
    <td>Espulsioni:</td>
    <td><?php echo $s[8];?></td>
  </tr>
  <tr>
    <td>Media:</td>
    <td><?php echo $s[9];?></td>
  </tr>
  <tr>
    <td>Fanta Media:</td>
    <td><?php echo $s[10];?></td>
  </tr>
</table>

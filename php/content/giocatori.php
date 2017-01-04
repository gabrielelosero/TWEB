<h3 class="tableTitle">Tutti i Giocatori</h3>

<table id="allPlayers" class="tableGiocatori" />
  <tr>  
    <th id="playerName" onclick="ordinaGiocatoriPer('nome')" ordine="asc">Nome</td>
    <th onclick="ordinaGiocatoriPer('ruolo')">Ruolo</th>
    <th onclick="ordinaGiocatoriPer('valore')">Valore</th>
    <th onclick="ordinaGiocatoriPer('squadra')">Squadra</th>
    <th onclick="ordinaGiocatoriPer('presenze')">Pres</th>
    <th onclick="ordinaGiocatoriPer('goal')">Goal</th>
    <th onclick="ordinaGiocatoriPer('ammonizioni')">Amm</th>
    <th onclick="ordinaGiocatoriPer('espulsioni')">Esp</th>
    <th onclick="ordinaGiocatoriPer('media')">Media</th>
    <th onclick="ordinaGiocatoriPer('fantamedia')">FantaMedia</th>
    <th>COMPRA</th>
  </tr>
<?php

session_start();
if (empty($_SESSION['id'])) {
  header('Location: index.php?content=login&messaggio=needLogin');
}

$giocatori = getPlayers();
echo $giocatori;

?>

  <!--</tr>-->
</table>

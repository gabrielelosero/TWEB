<h3 class="titoloDue">Tutti i Giocatori</h3>

<div id="divSearch">
  <table>
      <tr id="searchHeader">
<?php
if (empty($_GET['mode'])) {
  echo '<th id="searchByNome" class="searchByNome divSearchSelected" onclick=\'switchSearchMode("nome")\'>Cerca Per Nome</td>
        <th id="searchByRuolo" class="searchByRuolo" onclick=\'switchSearchMode("ruolo")\'>Cerca Per Ruolo</td>
        <th id="searchBySquadra" class="searchBySquadra" onclick=\'switchSearchMode("squadra")\'>Cerca Per Squadra</td>
        </tr>';
}
else {
  if ($_GET['mode'] == 'ruolo') {
    echo '<th id="searchByNome" class="searchByNome" onclick=\'switchSearchMode("nome")\'>Cerca Per Nome</td>
        <th id="searchByRuolo" class="searchByRuolo divSearchSelected" onclick=\'switchSearchMode("ruolo")\'>Cerca Per Ruolo</td>
        <th id="searchBySquadra" class="searchBySquadra" onclick=\'switchSearchMode("squadra")\'>Cerca Per Squadra</td>
        </tr>';
  }
  else if ($_GET['mode'] == 'nome') {
    echo '<th id="searchByNome" class="searchByNome divSearchSelected" onclick=\'switchSearchMode("nome")\'>Cerca Per Nome</td>
          <th id="searchByRuolo" class="searchByRuolo" onclick=\'switchSearchMode("ruolo")\'>Cerca Per Ruolo</td>
        <th id="searchBySquadra" class="searchBySquadra" onclick=\'switchSearchMode("squadra")\'>Cerca Per Squadra</td>
        </tr>';
  }
  else if ($_GET['mode'] == 'squadra') {
    echo '<th id="searchByNome" class="searchByNome" onclick=\'switchSearchMode("nome")\'>Cerca Per Nome</td>
          <th id="searchByRuolo" class="searchByRuolo" onclick=\'switchSearchMode("ruolo")\'>Cerca Per Ruolo</td>
        <th id="searchBySquadra" class="searchBySquadra divSearchSelected" onclick=\'switchSearchMode("squadra")\'>Cerca Per Squadra</td>
        </tr>';
  }
  else {
    echo '<th id="searchByNome" class="searchByNome divSearchSelected" onclick=\'switchSearchMode("nome")\'>Cerca Per Nome</td>
        <th id="searchByRuolo" class="searchByRuolo" onclick=\'switchSearchMode("ruolo")\'>Cerca Per Ruolo</td>
        <th id="searchBySquadra" class="searchBySquadra" onclick=\'switchSearchMode("squadra")\'>Cerca Per Squadra</td>
        </tr>';
  }
}
?>
<?php
if (!empty($_GET['mode'])) {
  if ($_GET['mode'] == 'nome') {
    echo '<tr id="cercaPerNome" class="searchSelected">';
  }
  else {
    echo '<tr id="cercaPerNome" class="invisible">';
  }
}
else {
  echo "<tr id=\"cercaPerNome\" class=\"searchSelected\">";
}
?>
        <td><span>Nome: </span></td>
        <td colspan="2">
          <input id="searchPlayer" class="searchInput">
        </td>
      </tr>
<?php
if (!empty($_GET['mode'])) {
  if ($_GET['mode'] == 'ruolo') {
    echo '<tr id="cercaPerRuolo" class="searchSelected">';
  }
  else {
    echo '<tr id="cercaPerRuolo" class="invisible">';
  }
}
else {
  echo '<tr id="cercaPerRuolo" class="invisible">';
}
?>
        <td><span>Ruolo: </span></td>
        <td colspan="2">
        <select id="searchRuolo" class="searchInput">
          <option value="P">Portiere</option>
          <option value="D">Difensore</option>
          <option value="C">Centrocampista</option>
          <option value="A">Attaccante</option>
        </select>
        </td>
      </tr>
<?php
if (!empty($_GET['mode'])) {
  if ($_GET['mode'] == 'squadra') echo '<tr id="cercaPerSquadra" class="searchSelected">';
  else echo '<tr id="cercaPerSquadra" class="invisible">';
}
else
  echo '<tr id="cercaPerSquadra" class="invisible">';
?>
        <td><span>Squadra: </span></td>
        <td colspan="2">
          <select id="searchSquadra" class="searchInput">
            <option value="atalanta">Atalanta</option>
            <option value="bologna">Bologna</option>
            <option value="cagliari">Cagliari</option>
            <option value="chievo">Chievo</option>
            <option value="crotone">Crotone</option>
            <option value="empoli">Empoli</option>
            <option value="fiorentina">Fiorentina</option>
            <option value="genoa">Genoa</option>
            <option value="inter">Inter</option>
            <option value="juventus">Juventus</option>
            <option value="lazio">Lazio</option>
            <option value="milan">Milan</option>
            <option value="napoli">Napoli</option>
            <option value="palermo">Palermo</option>
            <option value="pescara">Pescara</option>
            <option value="roma">Roma</option>
            <option value="sampdoria">Sampdoria</option>
            <option value="sassuolo">Sassuolo</option>
            <option value="torino">Torino</option>
            <option value="udinese">Udinese</option>
          </select>
        </td>
      </tr>
      <tr id="searchCerca">
        <td colspan="3"><button onclick="cercaGiocatori()">Cerca</button></td>
      </tr>
      <tr id="searchCerca"><td colspan="3"></td></tr>
  </table>
</div>

<table id='tableSearchPlayer' class='invisible allPlayers'></table>
<table id="allPlayers" class="tableGiocatori" />
  <tr>  
    <th id="playerName" onclick="ordinaGiocatoriPer('nome')" ordine="asc">Nome</td>
    <th onclick="ordinaGiocatoriPer('squadra')">Squadra</th>
    <th onclick="ordinaGiocatoriPer('ruolo')">Ruolo</th>
    <th onclick="ordinaGiocatoriPer('valore')">Valore</th>
    <th onclick="ordinaGiocatoriPer('presenze')">Pres</th>
    <th onclick="ordinaGiocatoriPer('goal')">Goal</th>
    <th onclick="ordinaGiocatoriPer('ammonizioni')">Amm</th>
    <th onclick="ordinaGiocatoriPer('espulsioni')">Esp</th>
    <th onclick="ordinaGiocatoriPer('media')">Media</th>
    <th onclick="ordinaGiocatoriPer('fantamedia')">FantaMedia</th>
    <th>COMPRA</th>
  </tr>
<?php
if (session_status() == PHP_SESSION_NONE)
  session_start();
if (empty($_SESSION['id'])) {
  header('Location: index.php?content=login&messaggio=needLogin');
}

$giocatori = getPlayers("", 0, 0);
echo $giocatori;
echo "</table>";
$scroll = genScrollPlayerTable();
echo "<div class='scrollTable'>".$scroll."</div>";
?>

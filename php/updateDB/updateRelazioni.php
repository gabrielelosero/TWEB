<?php

function salvaRelazioniUtentiTeam() {
  
  include("../setting.php");

  // ottengo tutte le relazioni tra utenti e team
  $query = "SELECT * FROM giocatori_team";
  $result = mysql_query($query, $conn) or die(mysql_error());

  // creo un array dove mettere le relazioni
  $array_rel = array();

  while ($r = mysql_fetch_row($result)) {

    $id_giocatore = $r[0];
    $id_team = $r[1];

    // cerco il nome del giocatore associato al team
    $q = "SELECT nome FROM giocatori WHERE id=$id_giocatore";
    $res = mysql_query($q, $conn) or die(mysql_error());
    $g = mysql_fetch_row($res);
    $nome_giocatore  = $g[0];

    // metto una relazione dentro l'array con il nome al posto dell'ID
    array_push($array_rel, array($nome_giocatore, $id_team));
  }
  var_dump($array_rel);
  return $array_rel;
}

function importaRelazioniUtentiTeam($data) {

  include("../setting.php");

  // per ogni relazione
  foreach ($data as $d) {

    echo "<br /><br />seleziono il giocatore $d[0]";
    $query = "SELECT id FROM giocatori WHERE nome LIKE '%$d[0]%'";
    echo "<br />$query<br /";
    $result = mysql_query($query, $conn) or die(mysql_error());
    $r = mysql_fetch_row($result);

    if (!empty($r)) {
      echo "importo la relazione per $d[0]<br /><br />";
      $q = "INSERT INTO giocatori_team (id_giocatore, id_team) VALUES ($r[0], $d[1])";
      $res = mysql_query($q, $conn) or die(mysql_error());
    } else {
      echo "<br />ATTENZIONE: il giocatore $d[0] non gioca più nel campionato italiano<br />";
    }
    
  }
}

function eliminaVecchieRelazioni() {

  include("../setting.php");

  // elimino le vecchie relazioni
  $query = "DELETE FROM giocatori_team";
  $exec = mysql_query($query, $conn) or die(mysql_error());
}
?>

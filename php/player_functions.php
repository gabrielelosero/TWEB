<?php

if (!empty($_POST['fun'])) {

  switch ($_POST['fun']) {

  case 'getPlayers':
    $a = getPlayers($_POST['ord'], $_POST['asc']);
    echo $a;
    break;

  case 'autocomplete':
    $playername = $_POST['playername'];
    $player = getPlayerByName($playername);
    $players = Array();
    while ($p_row = mysql_fetch_row($player)) {
      array_push($players, $p_row[0]);
    }
    $table = getPlayersByIds($players);
    $j_table = json_encode($table);
    echo $j_table;
    break;

  case 'vendi':
    require("team_functions.php");
    if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }
    $id_player = $_POST['playerid'];
    $id_team = $_SESSION['teamid'];
    $result = vendiGiocatore($id_player, $id_team);
  }
}

function getPlayers($ordine="", $f=0) {

  require("setting.php");

  $query = "SELECT * FROM giocatori";
  
  if ($ordine != "") {
    $query .= " ORDER BY ".$ordine;
  }

  if (strpos($query, "ORDER") !== FALSE) {
    if ($f == 0) {
      $query .= " ASC";
    }
    else {
      $query .= " DESC";
    }
  }

  $query .= " LIMIT 20";
  $result = mysql_query($query, $conn) or die(mysql_error());

  $table = genPlayerTable($result);
  return $table;
  
}

function getPlayerById($id) {
  
  require("setting.php");
  $query = "SELECT * FROM giocatori WHERE id = '".$id."'";
  $result = mysql_query($query, $conn) or die(mysql_error());

  return $result;
}

function getPlayersByIds($ids) {

  require("setting.php");
  $query = "SELECT * FROM giocatori WHERE id in (";
  for ($i=0; $i<count($ids); $i++) {
    if ($i != count($ids)-1)
      $query .= "'".$ids[$i]."',";
    else
      $query .= "'".$ids[$i]."'";
  }
  $query .= ");";

  $result = mysql_query($query, $conn) or die(mysql_error());
  $table = genPlayerTable($result, false);
  return $table;
}

function getPlayerByName($nome) {

  require("setting.php");
  $query = "SELECT * FROM giocatori WHERE nome LIKE '%".$nome."%'";
  $result = mysql_query($query, $conn) or die(mysql_error());

  return $result;
}

function getPlayersByTeam($id_team) {

  require("setting.php");
  
  $query = "SELECT * FROM giocatori_team WHERE id_team = ".$id_team.";";
  $result = mysql_query($query, $conn) or die(mysql_error());
  
  $players = Array();
  while ($r = mysql_fetch_row($result)) {
    array_push($players, $r[0]);
  }
  $q = "SELECT * FROM giocatori WHERE id IN (";
  for ($i=0; $i<count($players); $i++) {
    $q .= "'".$players[$i]."'";
    if ($i != count($players) - 1) {
      $q .= ",";
    }
  }
  $q .= ");";

  if (count($players) != 0) {
    $p = mysql_query($q, $conn) or die(mysql_error());
  } else {
    return false;
  }

  $table = genPlayerTable($p, false);
  return $table;
}

function getPlayersBySquadra($squadra) {
  
  require("setting.php");
  $query = "SELECT * FROM giocatori WHERE squadra LIKE '%".$squadra."%'";
  $result = mysql_query($query, $conn) or die(mysql_error());

  $table = genPlayerTable($result);
  return $table;

}

function genPlayerTable($r, $list=true) {
  $pari = TRUE;
  $table = "";

  while ($g = mysql_fetch_row($r)) {
    
    if ($pari) {
      $table .= "<tr class='trpari'>";
      $pari = FALSE;
    }
    else {
      $table .= "<tr class='trdispari'>";
      $pari = TRUE;
    }
    for ($i=0; $i<count($g);$i++) {

      $str = "";
      switch ($i) {
      case 0: //id
        $str = "<span class='invisible'>".$g[$i]."</span>";
        break;
      case 1: //giocatore
        $str = "<a class='click' href='index.php?content=schedaGiocatore&nome=".trim($g[$i])."'>".$g[$i]."</a>";
        break;
      case 4: //squadra
        $str = "<a class='click' href='index.php?content=squadra&squadra=".trim($g[$i])."'>".strtoupper($g[$i])."</a>";
        break;
      default: //ogni altro caso
        $str = $g[$i];
      }
      if ($i == 0) {
        $table .= "<td class='invisible'>".$str."</td>";
      } else {
        $table .= "<td>".$str."</td>";
      }
    }
    if ($list)
      $table .= "<td><a class='click' href='index.php?content=compraGiocatore&playerid=$g[0]'>COMPRA</a></td></tr>";
  }
  return $table;

}

?>

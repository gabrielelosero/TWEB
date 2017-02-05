<?php

// chimatate tramite $_POST
if (!empty($_POST['fun'])) {

  switch ($_POST['fun']) {

  case 'getPlayers':
    $a = getPlayers($_POST['ord'], $_POST['asc'], $_POST['range']);
    echo $a;
    break;

  case 'searchPlayerByName':
    $a = getPlayerByName($_POST['nome']);
    $columns = ['ruolo', 'valore', 'presenze', 'goal', 'ammonizioni', 'espulsioni', 'media', 'fantamedia', 'compra'];
    $r = genPlayerTable2($a, $columns);
    echo $r;
    break;

  case 'searchPlayerByRuolo':
    $a = getPlayerByRuolo($_POST['ruolo']);
    $columns = ['ruolo', 'valore', 'presenze', 'goal', 'ammonizioni', 'espulsioni', 'media', 'fantamedia', 'compra'];
    $r = genPlayerTable2($a, $columns);
    echo $r;
    break;

  case 'searchPlayerBySquadra':
    $a = getPlayerBySquadra($_POST['squadra']);
    $columns = ['ruolo', 'valore', 'presenze', 'goal', 'ammonizioni', 'espulsioni', 'media', 'fantamedia', 'compra'];
    $r = genPlayerTable2($a, $columns);
    echo $r;
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

function genScrollPlayerTable() {

  require("setting.php");
  $query = "SELECT id FROM giocatori";
  $result = mysql_query($query, $conn) or die(mysql_error());
  $num = mysql_num_rows($result);
  $num_pages = round($num / 20);
  $str = "";
  for ($i=1; $i<$num_pages; $i++) {
    $str .= "<a onclick='reloadPlayerTable($i)'>".$i."</a> ";
  } 
  return $str;
}

function genVotiTable($teamid) {

  require("setting.php");
  $query = "SELECT id_giocatore FROM giocatori_team WHERE id_team=$teamid";
  $result = mysql_query($query, $conn) or die(mysql_error());
  $columns = ['voti', 'goal', 'assist', 'rigori', 'rigori_sbagliati', 'autogoal', 'ammonizioni', 'espulsioni', 'fanta_voto'];
  while ($r = mysql_fetch_row($result)) {
    $q = "SELECT * FROM giocatori WHERE id=$r[0]";
    $res = mysql_query($q, $conn) or die(mysql_error());
    $table = genPlayerTable2($res, $columns);
    echo $table;
  }

}

function genPlayerTable2($r, $columns) {

  $pari = TRUE;
  $table = "";

  while ($g = mysql_fetch_row($r)) {

    // class pari o dispari per css
    if ($pari) {
      $table .= "<tr class='trpari'>";
      $pari = FALSE;
    }
    else {
      $table .= "<tr class='trdispari'>";
      $pari = TRUE;
    }

    $str_id = "<span class='invisible'>".$g[0]."</span>";
    $str_nome = "<a class='click' href='index.php?content=schedaGiocatore&nome=".trim($g[1])."'>".$g[1]."</a>";
    $str_squadra = "<a class='click squadra' href='index.php?content=squadra&squadra=".trim($g[4])."'>".strtoupper($g[4])."</a>";
    
    $table .= "<td class='invisible'>".$str_id."</td>";
    $table .= "<td>".$str_nome."</td>";
    $table .= "<td>".$str_squadra."</td>";
    // contenuto di ogni riga
    for ($i=0; $i<count($g);$i++) {
      
      $str = "";

      switch ($i) {
      case 2: 
        if (in_array('ruolo', $columns)) {
          $str = "<span>".$g[$i]."</span>";
          $table .= "<td>".$str."</td>";
        }
        break;
      case 3:
        if (in_array('valore', $columns)) {
          $str = "<span>".$g[$i]."</span>";
          $table .= "<td>".$str."</td>";
        }
        break;
      case 5:
        if (in_array('presenze', $columns)) {
          $str = "<span>".$g[$i]."</span>";
          $table .= "<td>".$str."</td>";
        }
        break;
      case 6:
        if (in_array('goal', $columns)) {
          $str = "<span>".$g[$i]."</span>";
          $table .= "<td>".$str."</td>";
        }
        break;
      case 7:
        if (in_array('ammonizioni', $columns)) {
          $str = "<span>".$g[$i]."</span>";
          $table .= "<td>".$str."</td>";
        }
        break;
      case 8:
        if (in_array('espulsioni', $columns)) {
          $str = "<span>".$g[$i]."</span>";
          $table .= "<td>".$str."</td>";
        }
        break;
      case 9:
        if (in_array('media', $columns)) {
          $str = "<span>".$g[$i]."</span>";
          $table .= "<td>".$str."</td>";
        }
        break;
      case 10:
        if (in_array('fantamedia', $columns)) {
          $str = "<span>".$g[$i]."</span>";
          $table .= "<td>".$str."</td>";
        }
        break;
      }
    }
    
    if (in_array('voti', $columns)) {
      
      $q = "SELECT * FROM voti_giocatori WHERE id_giocatore=$g[0]";
      echo $q;
      $r = mysql_query($q, $conn) or die(mysql_error());

      $re = mysql_fetch_row($r);
      echo $re;

      for ($k=0; $k<count($re); $k++) {

        switch ($k) {
        case '2':
          if (in_array('voto', $columns))
            $table .= "<td><span>".$re[$k]."</span></td>";
          break;
        case '3':
          if (in_array('goal', $columns))
          $table .= "<td><span>".$re[$k]."</span></td>";
          break;

        case '4':
          if (in_array('assist', $columns))
          $table .= "<td><span>".$re[$k]."</span></td>";
          break;

        case '5':
          if (in_array('rigori', $columns))
          $table .= "<td><span>".$re[$k]."</span></td>";
          break;

        case '6':
          if (in_array('rigori_sbagliati', $columns))
          $table .= "<td><span>".$re[$k]."</span></td>";
          break;

        case '7':
          if (in_array('autogoal', $columns))
          $table .= "<td><span>".$re[$k]."</span></td>";
          break;

        case '8':
          if (in_array('ammonizioni', $columns))
          $table .= "<td><span>".$re[$k]."</span></td>";
          break;

        case '9':
          if (in_array('espulsioni', $columns))
          $table .= "<td><span>".$re[$k]."</span></td>";
          break;

        case '10':  
          if (in_array('fanta_voto', $columns))
          $table .= "<td><span>".$re[$k]."</span></td>";
          break;



        }
      }    
    }


    if (in_array('compra', $columns))
      $table .= "<td><a class='click' href='index.php?content=compraGiocatore&playerid=$g[0]'>C</a></td></tr>";
    
    if (in_array('vendi', $columns))
      $table .= "<td><a onclick='vendiGiocatore($g[0])'>VENDI</a></td>";
  }
  return $table;

}

// FUNZIONI VECCHIE; tenute per compatibilità

function getPlayers($ordine="", $f=0, $range=0) {

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

  if ($range == 0)
    $query .= " LIMIT 20";
  else {
    $query .= " LIMIT 21 OFFSET $range"; //.$range.", ".$range + 20;
    echo $query;
  }

  $result = mysql_query($query, $conn) or die(mysql_error());

  $columns = ['ruolo', 'valore', 'presenze', 'goal', 'ammonizioni', 'espulsioni', 'media', 'fantamedia', 'compra'];
  $table = genPlayerTable2($result, $columns);
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

function getPlayerByRuolo($ruolo) {

  require("setting.php");
  $query = "SELECT * FROM giocatori WHERE ruolo LIKE '%".$ruolo."%'";
  $result = mysql_query($query, $conn) or die(mysql_error());

  return $result;
}

function getPlayerBySquadra($squadra) {

  require("setting.php");
  $query = "SELECT * FROM giocatori WHERE squadra LIKE '%".$squadra."%'";
  $result = mysql_query($query, $conn) or die(mysql_error());

  return $result;
}

function getPlayersIdByTeam($id_team) {
  
  require("setting.php");
  
  $query = "SELECT id_giocatore FROM giocatori_team WHERE id_team = ".$id_team.";";
  $result = mysql_query($query, $conn) or die(mysql_error());
  
  $players = Array();
  while ($r = mysql_fetch_row($result)) {
    array_push($players, $r[0]);
  }
  return $players;

}

function getPlayersByTeam($id_team, $vendi=TRUE) {

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

  if ($vendi)
    $columns = ['valore', 'ruolo', 'presenze', 'goal', 'ammonizioni', 'espulsioni', 'media', 'fantamedia', 'vendi'];
  else
    $columns = ['valore', 'ruolo', 'presenze', 'goal', 'ammonizioni', 'espulsioni', 'media', 'fantamedia'];
  $table = genPlayerTable2($p, $columns);
  return $table;
}

function getPlayersBySquadra($squadra) {
  
  require("setting.php");
  $query = "SELECT * FROM giocatori WHERE squadra LIKE '%".$squadra."%'";
  $result = mysql_query($query, $conn) or die(mysql_error());

  $table = genPlayerTable($result);
  return $table;

}

function getVotiGiocatoriByIds($ids) {

  require("setting.php");
  $ids_array = join("','", $ids);
  $query = "SELECT * FROM voti_giocatori WHERE id IN ('$ids')";
  $result = mysql_query($query, $conn) or die(mysql_error());

  while ($r = mysql_fetch_row($result)) {
    echo $r[0];
  }
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
        $str = "<a class='click squadra' href='index.php?content=squadra&squadra=".trim($g[$i])."'>".strtoupper($g[$i])."</a>";
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
      $table .= "<td><a class='click' href='index.php?content=compraGiocatore&playerid=$g[0]'>C</a></td></tr>";
  }
  return $table;

}

?>

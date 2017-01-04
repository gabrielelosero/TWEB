<?php

if (!empty($_GET['fun'])) {

  if ($_GET['fun'] == 'create') {

    session_start();
    unset($_SESSION['error']);

    if (empty($_POST['nome'] || $_POST['nome'] == '')) {
      $_SESSION['error'] = 'Inserire un nome per la squadra';
    }
    
    if (strlen($_POST['nome']) < 4) {
      $_SESSION['error'] = 'Il nome non può essere più corto di 4 caratteri';
    }

    if (strlen($_POST['nome']) > 20) {
      $_SESSION['error'] = 'Il nome non può essere più lungo di 20 caratteri';
    }

    if (!empty($_SESSION['error'])) {
      header('Location: ../index.php?content=team&mode=create');
    } 
    
    else {
      $newTeam = creaTeam($_POST['nome']);
      if ($newTeam) {
        $_SESSION['message'] = 'Squadra Creata!';
        header('Location: ../index.php?content=team&mode=list');
      }
    }
  }
}

function creaTeam($nome) {
  
  session_start();

  if (!empty($_SESSION['id'])) {
    require("setting.php");

    $query = "INSERT INTO team (nome) VALUES ('".$nome."');";
    $result = mysql_query($query, $conn) or die(mysql_error());

    $id_utente = $_SESSION['id'];
    $team_id = mysql_insert_id();
    $q = "INSERT INTO utenti_team VALUES('".$id_utente."', '".$team_id."');";
    $r = mysql_query($q, $conn) or die(mysql_error());

    return true;
  }
}

function getAllTeam() {

  require("setting.php");

  $query = "SELECT * from utenti_team ";
  $result = mysql_query($query, $conn) or die (mysql_error());

  $table = genTeamTable($result);

  return $table;
}


function genTeamTable($result) {

  $table = "";
  while ($t = mysql_fetch_row($result)) {

    $user = getUserById($t[0]);
    $username = $user[1];

    $team = getTeamById($t[1]);
    $teamid = $team[0];
    $teamname = $team[1];

    $table .= "<tr><td>".$username."</td>";
    $table .= "<td><a href='index.php?content=schedaTeam&teamid=$teamid'>".$teamname."</a></td></tr>";
    
  }
  return $table;
}

function getTeamById($id) {
  
  require('setting.php');

  $query = "SELECT * FROM team WHERE id = $id LIMIT 1";
  $result = mysql_query($query, $conn) or die(mysql_error());

  $r = mysql_fetch_row($result);
  
  return $r;
}

?>

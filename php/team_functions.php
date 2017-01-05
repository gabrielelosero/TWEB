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

  if ($_GET['fun'] == 'compra') {
    
    require("player_functions.php");
    
    $id_player = getPlayerByName($_POST['playername']);
    $id_player = mysql_fetch_row($id_player);
    $id_player = $id_player[0];

    $id_team = getTeamByName($_POST['teamname']);
    $id_team = mysql_fetch_row($id_team);
    $id_team = $id_team[0];

    compraGiocatore($id_player, $id_team);
  }

}

function compraGiocatore($id_giocatore, $id_team) {

  require("setting.php");
  session_start();

  $ok = true;

  $team = getTeamById($id_team);
  $player = getPlayerById($id_giocatore);
  $player = mysql_fetch_row($player);
  
  if ($team[2] < $player[3]) {
    $_SESSION['message'] = "Non hai abbastanza soldi per acquistare questo giocatore";
    $ok = false;
  }
  
  if ($ok) {
    $query = "INSERT INTO giocatori_team VALUES('".$id_giocatore."', '".$id_team."')";
    $result = mysql_query($query, $conn);
  }

  if (mysql_errno() == 0) {
    soldiSquadra($id_team, $player[3]);
    $_SESSION['message'] = "Hai comprato ".$player[1]." per la squadra ".$team[1].".";
    header('Location: ../index.php?content=compraGiocatore');
  } 
  elseif (mysql_errno() != 0 || !$ok) {
    if (mysql_errno() == 1062) {
      $_SESSION['message'] = "Hai già comprato questo giocatore per questo team";
    }
    header('Location: ../index.php?content=compraGiocatore');
  }  
  echo $_SESSION['message']; 
}

function vendiGiocatore($id_giocatore, $id_team) {
  
  require("setting.php");
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }

  $ok = true;

  $team = getTeamById($id_team);
  $player = getPlayerById($id_giocatore);
  $player = mysql_fetch_row($player);

  $query = "DELETE FROM giocatori_team WHERE id_giocatore='".$id_giocatore."' and id_team='".$id_team."';";
  $result = mysql_query($query, $conn) or die(mysql_error());

  if (mysql_errno() != 0) {
    $_SESSION['message'] = "Si è verificato un problema, non è stato possibile vendere ".$player[1].".";
  } else {
    $_SESSION['message'] = $player[1]." è stato venduto.";
  }
  soldiSquadra($id_team, -$player[3]);
  header('Location: ../index.php?content=schedaTeam&teamid='.$id_team);
  return $_SESSION['message'];
}

function creaTeam($nome) {
  
  session_start();

  if (!empty($_SESSION['id'])) {
    
    require("setting.php");

    $verifica = "SELECT nome FROM team WHERE nome='".$nome."';";
    $verifica = mysql_query($verifica, $conn) or die(mysql_error());
    $verifica = mysql_fetch_row($verifica);

    if (!$verifica) {
      $query = "INSERT INTO team (nome) VALUES ('".$nome."');";
      $result = mysql_query($query, $conn) or die(mysql_error());

      $id_utente = $_SESSION['id'];
      $team_id = mysql_insert_id();
      $q = "INSERT INTO utenti_team VALUES('".$id_utente."', '".$team_id."');";
      $r = mysql_query($q, $conn) or die(mysql_error());
      return true;
    }

    return false;
  }
}

function getAllTeam() {

  require("setting.php");

  $query = "SELECT * from utenti_team ";
  $result = mysql_query($query, $conn) or die (mysql_error());

  $table = genTeamTable($result);

  return $table;
}

function getAllUserTeam($id) {

  require("setting.php");

  $query = "SELECT * FROM utenti_team WHERE id_utente = '".$id."';";
  $result = mysql_query($query, $conn) or die(mysql_error());
  $teams = Array();
  while ($r = mysql_fetch_row($result)) {

    $t = getTeamById($r[1]);
    array_push($teams, $t);
  }


  return $teams;
}
  
function getTeamById($id) {
  
  require('setting.php');

  $query = "SELECT * FROM team WHERE id = $id LIMIT 1";
  $result = mysql_query($query, $conn) or die(mysql_error());

  $r = mysql_fetch_row($result);
  
  return $r;
}

function getTeamByName($name) {

  require("setting.php");

  $query = "SELECT * FROM team WHERE nome = '".$name."';";
  $result = mysql_query($query, $conn) or die(mysql_error());

  return $result;
}

function soldiSquadra($id_team, $valore) {
  
  require("setting.php");

  $team = getTeamById($id_team);
  $saldo = $team[2] - $valore;

  $query = "UPDATE team SET soldi=".$saldo." WHERE id=".$id_team.";";
  echo $query;
  $result = mysql_query($query, $conn) or die(mysql_error());
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



?>

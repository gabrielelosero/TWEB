<?php

aggiornaClassificaPunti();

function aggiornaClassificaPunti() {

  include("../setting.php");

  // prendo gli utenti che ci sono
  //
  // uno per uno guardo che squadre hanno
  //
  // guardo per ogni squadra che giocatori schierati ha
  //
  // somma dei punti dei giocatori schierati
  //
  // inserisco in una tabella utente - squadra - punti totali - ultima giornata

  $query_all_users = "SELECT id FROM utenti";
  $result_all_users = mysql_query($query_all_users, $conn) or die(mysql_error());

  while ($r_all_users = mysql_fetch_row($result_all_users)) {
    $id_utente = $r_all_users[0];
    $query_user_team = "SELECT id_squadra FROM utenti_team where id_utente=$id_utente";
    $result_user_team = mysql_query($query_user_team, $conn) or die(mysql_error());

    while ($r_user_team = mysql_fetch_row($result_user_team)) {
      $voto_squadra = 0;
      $team_id = $r_user_team[0];
      $query_giocatori_team = "SELECT id_giocatore FROM giocatori_team WHERE id_team=$team_id AND titolare=1";
      $result_giocatori_team = mysql_query($query_giocatori_team, $conn) or die(mysql_error());

      while ($r_giocatori_team = mysql_fetch_row($result_giocatori_team)) {
        $id_giocatore = $r_giocatori_team[0];
        $query_voto_giocatore = "SELECT id_giocatore, fanta_voto FROM voti_giocatori WHERE id_giocatore=$id_giocatore";
        $result_voto_giocatore = mysql_query($query_voto_giocatore, $conn) or die(mysql_error());

        while ($r_voto_giocatore = mysql_fetch_row($result_voto_giocatore)) {
          $voto = $r_voto_giocatore[1];
          $voto_squadra += $voto;
        }
      }

      $query = "INSERT INTO classifica (id_utente, id_team, punti_ultima, punti) VALUES ($id_utente, $team_id, $voto_squadra, $voto_squadra) ON DUPLICATE KEY UPDATE punti_ultima=$voto_squadra, punti=punti+$voto_squadra";
      echo $query;
      $result = mysql_query($query, $conn) or die(mysql_error());
    }
  }
}

// INSERT INTO classifica (id_utente, id_team, punti_ultima, punti) VALUES (idu, idt, pu, p) ON DUPLICATE KEY UPDATE pu=pu p=p+pu


?>

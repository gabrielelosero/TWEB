<?php

include("updateGiocatori.php");
include("updateVoti.php");
include("updateRelazioni.php");


// salvo le vecchie relazioni tra utenti e giocatori
echo "<br />SALVO LA RELAZIONE UTENTI GIOCATORI"."<br /><br />";
$data = salvaRelazioniUtentiTeam();

// elimino il vecchio elenco di giocatori
echo "<br />ELIMINO L'ELENCO DEI VECCHI GIOCATORI"."<br /><br />";
eliminaVecchiGiocatori();

//carico l'elenco nuovo
echo "<br />INSERISCO I NUOVI GIOCATORI"."<br /><br />";
inserisciNuoviGiocatori();

// elimino i vecchi voti dei giocatori
echo "<br /><br />ELIMINO I VECCHI VOTI"."<br /><br />";
echo "ancora da implementare";
// eliminaVecchiVoti();

// assegno ai giocatori i voti che hanno preso nell' ultima giornata
echo "<br />INSERISCO I NUOVI VOTI"."<br /><br />";
echo "ancora da implementare";
// inserisciNuoviVoti();

// elimino le vecchie relazioni dal DB
echo "<br /><br />ELIMINO LE VECCHIE RELAZIONI<br /><br />";
eliminaVecchieRelazioni();

// assegno i giocatori agli utenti recuperando le relazioni dall' array $ug
echo "<br />IMPORTO LA VECCHIA RELAZIONE UTENTI GIOCATORI"."<br /><br />";
importaRelazioniUtentiTeam($data);

?>


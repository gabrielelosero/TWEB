<?php

include("updateGiocatori.php");
include("updateVoti.php");
include("updateRelazioni.php");
include("updateClassifica.php");


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
echo "<br />ELIMINO I VECCHI VOTI"."<br /><br />";
eliminaVecchiVoti();

// assegno ai giocatori i voti che hanno preso nell' ultima giornata
echo "<br />INSERISCO I NUOVI VOTI"."<br /><br />";
inserisciNuoviVoti();

// elimino le vecchie relazioni dal DB
echo "<br />ELIMINO LE VECCHIE RELAZIONI<br /><br />";
eliminaVecchieRelazioni();

// assegno i giocatori agli utenti recuperando le relazioni dall' array $ug
echo "<br />IMPORTO LA VECCHIA RELAZIONE UTENTI GIOCATORI"."<br /><br />";
importaRelazioniUtentiTeam($data);


echo "<br />INSERISCO I PUNTI PER OGNI TEAM<br /><br />";
aggiornaClassificaPunti();

?>


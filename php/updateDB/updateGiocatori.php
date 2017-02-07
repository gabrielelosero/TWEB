<?php

function inserisciNuoviGiocatori() {
  
  include("../setting.php");
  
  /* questa opzione fa in modo che php non mostri gli errori della pagina che sto caricando */
  libxml_use_internal_errors(true);

  /* carico la pagina e la rendo un DOMdocument */
  $doc = new DOMDocument();

  $doc->loadHTMLFile("http://www.gazzetta.it/calcio/fantanews/statistiche/serie-a-2016-17/?refresh_ce-cp");
  /* con xpath posso lavorare sul DOM della pagina */
  $xpath = new DOMXpath($doc);

  /* riabilito gli errori */
  libxml_use_internal_errors(false);

  /* ciclo su tutti gli elementi td della tabella che mi interessa */
  $x = array();
  $num = 0;
  foreach ($xpath->query("//table[contains(concat(' ', @class, ' '), ' playerStats ')]/tbody/tr") as $tr) {

    // per ogni riga della tabella ricavo il DOM in questo modo:
    $DD = new DOMDocument('1.0', 'utf-8');
    $DD->loadXML( "<html></html>" );
    $DD->documentElement->appendChild($DD->importNode($tr,true));

    // ciclo il nuovo DOM per ottenere una stringa da usare nella query
    $xpathe = new DOMXPath($DD);
    $num = 0;
    $s = "";
    foreach ($xpathe->query("//td") as $td) {
      
      switch ($num) {
      
        // squadra
        case 1:
          $s .= "'".$td->textContent."', ";
          break;

        // nome
        case 2:
          $s .= "'".$td->textContent."', ";
          break;

        // ruolo
        case 3:
          $replace = trim($td->textContent);
          if ($replace == "T (A)") $s .= "'A', ";
          else if ($replace == "T (C)") $s .= "'C', ";
          else $s .= "'".$td->textContent."', ";
          break;

        // valore
        case 4:
          $s .= "'".$td->textContent."', ";
          break;

        // presenze
        case 5:
          if ($td->textContent == "-")
            $s .= "0, ";
          else
            $s .= $td->textContent.", ";
          break;

        // goal
        case 6:
          if (trim($td->textContent) == "-") 
            $s .= "0, ";
          else 
            $s .= $td->textContent.", ";
          break;

        // ammonizioni
        case 8:
          if (trim($td->textContent) == "-") 
            $s .= "0, ";
          else 
            $s .= $td->textContent.", ";
          break;

        // espulsioni
        case 9:
          if (trim($td->textContent) == "-") 
            $s .= "0, ";
          else 
            $s .= $td->textContent.", ";
          break;

        // media
        case 14:
          if (trim($td->textContent) == "-") 
            $s .= "0, ";
          else 
            $s .= $td->textContent.", ";
          break;
    
        // fantamedia
        case 15:
          if (trim($td->textContent) == "-") 
            $s .= "0";
          else 
            $s .= $td->textContent;
          break;
      }
        $num ++;
      }
      array_push($x, $s);
      $s = "";
    }
    
    $query = "INSERT INTO giocatori (squadra, nome, ruolo, valore, presenze, goal, ammonizioni, espulsioni, media, fantamedia) VALUES ";
    for ($i=0; $i<=count($x)-1; $i++) {
      if ($i != count($x)-1)
        $query .= "(".$x[$i]."), ";
      else 
        $query .= "(".$x[$i]."); ";
    }

    $result = mysql_query($query, $conn) or die(mysql_error());
}

// elimina il vecchio elenco di giocatori
function eliminaVecchiGiocatori() {

  include("../setting.php");

  // elimino i giocatori
  $query = "DELETE FROM giocatori";
  $exec = mysql_query($query, $conn) or die(mysql_error());
}


?>

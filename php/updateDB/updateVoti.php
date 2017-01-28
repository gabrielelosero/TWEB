<?php

inserisciNuoviVoti();
function inserisciNuoviVoti() {

  include("../setting.php");
  
  /* questa opzione fa in modo che php non mostri gli errori della pagina che sto caricando */
  libxml_use_internal_errors(true);

  /* carico la pagina e la rendo un DOMdocument */
  $doc = new DOMDocument();

  $doc->loadHTMLFile("http://www.gazzetta.it/calcio/fantanews/voti/serie-a-2016-17/");

  /* con xpath posso lavorare sul DOM della pagina */
  $xpath = new DOMXpath($doc);

  /* riabilito gli errori */
  libxml_use_internal_errors(false);

  // prendiamo tutte le tabelle
  $num_tabelle = 0;
  $query = "INSERT INTO voti_giocatori (id_giocatore, voto, goal, assist, rigori, rigori_sbagliati, autogoal, ammonizioni, espulsioni, fanta_voto) VALUES ";
  foreach ($xpath->query("//div[contains(concat(' ', @class, ' '), ' magicDayList ')]/div/div/ul") as $ul) { 
  
    if ($num_tabelle < 20) {

      $newDOM = new DOMDocument('1.0', 'utf-8');
      $newDOM->loadXML( "<html></html>" );
      $newDOM->documentElement->appendChild($newDOM->importNode($ul,true));

      // ciclo il nuovo DOM per ottenere una stringa da usare nella query
      $new_xpath = new DOMXPath($newDOM);

      $dontTakeFirst = true;
      $s = "";
      // per ogni tabella prendiamo i li di cui è composta
      foreach ($new_xpath->query("//li") as $li) {
      
        if ($dontTakeFirst == true) 
          $dontTakeFirst = false;
        else {
          $nwDOM = new DOMDocument('1.0', 'utf-8');
          $nwDOM->loadXML("<html></html>");
          $nwDOM->documentElement->appendChild($nwDOM->importNode($li, true));

          $nw_xpath = new DOMXPath($nwDOM);

          //prendiamo il nome del giocatore
          foreach ($nw_xpath->query("//div/div/span[contains(concat(' ', @class, ' '), ' playerNameIn ')]") as $nome) {
          
            $query_nome = mysql_query("SELECT id FROM giocatori WHERE nome LIKE '%".$nome->textContent."%'", $conn) or die(mysql_error());
            $result = mysql_fetch_row($query_nome);
            $s .= "(".$result[0].",";
          }
      
          $nDOM = new DOMDocument('1.0', 'utf-8');
          $nDOM->loadXML("<html></html>");
          $nDOM->documentElement->appendChild($nDOM->importNode($li, true));

          $n_xpath = new DOMXPath($nDOM);

          // e gli altri parametri relativi al voto del giocatore
          foreach ($nw_xpath->query("//div[contains(concat(' ', @class, ' '), ' inParameter ')]") as $par) {
            $p = str_replace("-", "0", $par->textContent);
            $s .= trim($p).",";
          }
          $s = rtrim($s, ",");
          $s .= "),";
        }
      }
      $query .= $s;
      $num_tabelle ++;
    }
  }
  $query = rtrim($query, ",");
  echo $query;
  $exec = mysql_query($query, $conn) or die(mysql_error());
}

function eliminaVecchiVoti() {
  
  // connessione al DB
  $conn = connectDB();

  // elimino i vecchi voti 
  $delete_old = "DELETE FROM voti_giocatori";
  $delete = mysql_query($delete_old, $conn) or die(mysql_error());
}



?>

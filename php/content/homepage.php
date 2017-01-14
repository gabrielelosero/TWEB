<div class="content">
  

<?php
session_start();
if (empty($_SESSION['id'])) {
?>
  <h2 class="titoloDue">
    Benvenuto!
  </h2>
  <p>
    Questo è un sito dedicato al fantacalcio.<br />
    Se desideri partecipare effettua la registrazione cliccando 
    <a href='index.php?content=login'>qui</a>.
  </p>

  <p>
    Dopo esserti registrato potrai iniziare a giocare.
    La prima cosa di cui avrai bisogno sarà un TEAM.
  </p>

  <p>
    Ogni utente può infatti avere fino a 5 squadre per competere
    con gli altri utenti iscritti al sito. Una volta creato un team
    dovrai comprare almeno 11 giocatori per poter giocare.
  </p>

  <p>
    Dopo aver comprato i giocatori non ti resterà che decidere quali schierare
    in campo, al termine della giornata a ogni giocatore verrà dato un voto.
    Se la somma dei voti dei giocatori della tua squadra sarà più alta di quella
    delle squadre avversarie avrai vinto la giornata.
    Ma attenzione! Il campionato è lungo, e dovrai fare buoni punteggi ogni giornata 
    per rimanere in cima alla classifica.
  </p>


<?php
}
else {
  if (!empty($_GET['content'])) {
    if ($_GET['content'] == 'loginSuccess')
      echo "<h2 class='titoloDue'>";
      echo "Benvenuto ".$_SESSION['username']."!";
      echo "</h2>";
  }
?>
  <p>
    Ora che hai effettuato il login puoi iniziare a giocare.<br /><br />
    Vai alla casella del menu "Team" per creare un nuovo team, e poi dai un'occhiata
    al mercato per cercare i giocatori che ti interessano.
  </p>

  <p>
    Se invece ti vuoi disconnettere o collegare con un altro utente
    clicca <a href='php/auth_functions.php?fun=logout'>qua</a>.
  </p>
<?php
}
?>
</div>

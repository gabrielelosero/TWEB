<?php

include_once("setting.php");

if (!empty($_GET['fun'])) {
  if ($_GET['fun'] == 'login') {

    session_start();
      
    $user = $_POST['username'];
    $pass = md5($_POST['password']);

    $query = "SELECT * FROM utenti WHERE username='$user' AND password='$pass'";
    $result = mysql_query($query, $conn) or die(mysql_error());
    $result = mysql_fetch_row($result);

    if (empty($result)) {
      header('Location: ../index.php?content=login');
      $_SESSION['loginMessage'] = 'LOGIN ERRATO';
    } else {
      header('Location: ../index.php?content=loginSuccess');
      $_SESSION['username'] = $user;
      $_SESSION['id'] = $result[0];
    }
  }

  if ($_GET['fun'] == 'signup') {

    $user = $_POST['username'];
    $pass = md5($_POST['password']);
    $ver = md5($_POST['verifica']);
    $error = null;

    if (userExist($user) == 1) 
      $error = "Esiste già un utente con questo username";

    else if ($pass != $ver) 
      $error = "Le password non corrispondono";
      
    else if (strlen($user) <= 4)
      $error = "Username troppo corto";

    else if (strlen($pass) <= 4) 
      $error = "Password troppo corta";

    else if (strlen($user) > 40)
      $error = "Username troppo lungo";

    else if (strlen($pass) > 40) 
      $error = "Password troppo lunga";

    session_start();

    if ($error == null) {
      echo "qua";
      $query = "INSERT INTO utenti (username, password) VALUES ('$user', '$pass')";
      $result = mysql_query($query) or die(mysql_error());
      if ($result == 1) {
        $_SESSION['messaggio'] = "UTENTE CREATO";
        header('Location: ../index.php?content=login');
      } else {
        $_SESSION['messaggio'] = "NON E' STATO POSSIBILE CREARE IL NUOVO UTENTE";
        header('Location: ../index.php?content=signup');
      }
    } else {
      echo "qua";
      $_SESSION['messaggio'] = $error;
      header('Location: ../index.php?content=signup');
    }
  }

  if ($_GET['fun'] == 'logout') {

    header('Location: ../index.php?content=login');
    $_SESSION['loginMessage'] = 'LOGOUT EFFETTUATO';
  }
}

function userExist($user) {
  echo "asd";
  require("setting.php");
  
  $query = "SELECT * FROM utenti WHERE username = '$user';";
  $result = mysql_query($query, $conn) or die(mysql_error());

  $numRows = mysql_num_rows($result);
  if ($numRows == 0) 
    return 0;
  else
    return 1;
}

function getUserById($id) {

  require("setting.php");

  $query = "SELECT * FROM utenti WHERE id = $id LIMIT 1";
  $result = mysql_query($query, $conn) or die(mysql_error());

  $r = mysql_fetch_row($result);

  return $r;

}
?>

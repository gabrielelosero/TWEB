<?php

include("setting.php");

if (!empty($_GET['fun'])) {
  if ($_GET['fun'] == 'login') {

    session_start();
      
    $user = $_POST['username'];
    $pass = $_POST['password'];

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

  if ($_GET['fun'] == 'logout') {

    header('Location: ../index.php?content=login');
    $_SESSION['loginMessage'] = 'LOGOUT EFFETTUATO';
  }
}

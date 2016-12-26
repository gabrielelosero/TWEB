<h2>
  HOMEPAGE
</h2>
<?php
session_start();
if (empty($_SESSION['id'])) {
  echo "<a href='index.php?content=login'>Login</a>";
}
else {
  if (!empty($_GET['content'])) {
    if ($_GET['content'] == 'loginSuccess')
      echo "Benvenuto ".$_SESSION['username']."!";
    echo "<br />";
  }
  echo "<a href='php/auth_functions.php?fun=logout'>Logout</a>";
}

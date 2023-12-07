<?php
session_start();

if(isset($_SESSION['logon']) && $_SESSION['logon'] == True){
  unset($_SESSION['logon']);
  unset($_SESSION['username']);
  $_SESSION['error'] = "Pomyślnie wylogowano!";
  header('Location: index.html');
  exit();
}
else{
  $_SESSION['error'] = "Proszę się zalogować!";
  header('Location: index.html');
  exit();
}

?>
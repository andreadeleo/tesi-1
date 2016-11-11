<?php
require_once "funzioni_php.inc";
setRegistro($_SESSION['id'],$_SESSION['annoAcc'],$_POST['giorno'],$_POST['mese'],$_POST['tipologia'],$_POST['argomento']);
header("Location:registro.php");
 ?>

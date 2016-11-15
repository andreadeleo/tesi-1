<?php
require_once "funzioni_php.inc";
$ris=setRegistro($_SESSION['id'],$_POST['giorno'],$_POST['mese'],$_POST['tipologia'],$_POST['argomento']);
if (!$ris) {
  $_SESSION['errore']['err_registro']="Errore nell'inserimento";
}
header("Location:registro.php");
 ?>

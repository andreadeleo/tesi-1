<?php
require_once "funzioni_php.inc";
$giorno=$_POST['giorno'];
$mese=$_POST['mese'];
$tipologia=$_POST['tipologia'];
$argomento=$_POST['argomento'];
//FARE CONTROLLO PER PRENDERSI L'ANNO DA ANNO ACCADEMICO
$anno=getAnnoIns($mese);
$ris=insertRegistro($_SESSION['id'],$anno,$giorno,$mese,$tipologia,$argomento);
if (!$ris) {
  $_SESSION['errore']['err_registro']="Errore nell'inserimento";
}
header("Location:registro.php");
 ?>

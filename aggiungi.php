<?php
require_once "funzioni_php.inc";
session_start();
$giorno=$_POST['giorno'];
$mese=$_POST['mese'];
$tipologia=$_POST['tipologia'];
$argomento=$_POST['argomento'];
//FARE CONTROLLO PER PRENDERSI L'ANNO DA ANNO ACCADEMICO
$anno=getAnnoIns($mese);
insertRegistro($_SESSION['id'],$_SESSION['annoAcc'],$anno,$giorno,$mese,$tipologia,$argomento);
header("Location:registro.php");
 ?>

<?php
require_once 'funzioni_php.inc';
if($_GET['mod']=="aggiungi"){
  stampaInizioPagina("Aggiungi nuova lezione");
  $cod=$_SESSION['id'];
  stampaModuloModifica("",$_SESSION['annoAcc'], $_GET['mod']);
  stampaFinePagina();
}else{
  stampaInizioPagina("Inserisci/modifica lezione");
  $lezione=getElencoRegistroModifica($_SESSION['id'],$_GET['giorno'],$_GET['mese']);
  stampaModuloModifica($lezione, $_SESSION['annoAcc'], $_GET['mod']);
  stampaFinePagina();
}
 ?>

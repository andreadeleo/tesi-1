<?php
require_once 'funzioni_php.inc';
if($_GET['mod']=="aggiungi"){
  stampaInizioPagina("Aggiungi nuova lezione");
  $cod=$_SESSION['id'];
  stampaModuloModifica("",$_GET['mod']);
  stampaFinePagina();
}else{
  stampaInizioPagina("Inserisci/modifica lezione");
  $lezione=getElencoRegistroModifica($_SESSION['id'],$_SESSION['annoAcc'],$_GET['giorno'],$_GET['mese']);
  stampaModuloModifica($lezione,$_GET['mod']);
  stampaFinePagina();
}
 ?>

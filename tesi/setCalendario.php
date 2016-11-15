<?php
require_once 'funzioni_php.inc';
if (!isset($_POST)) {
  $_SESSION['errore']['err_sessione']="Errore";
  header("Location: index.php");
}else{
  $ris=getDataCal($_POST['anno_acc'], $_POST['semestre']);
  if ($ris) {
    $_SESSION['ris']=$ris;
    $_SESSION['errore']['esito']="Date gi&agrave inserite";
    header("Location: modulo_setCalendario.php");
  }else{
    if ($_POST['mese_in']==$_POST['mese_fin']&&$_POST['giorno_in']==$_POST['giorno_fin']) {
      $_SESSION['errore']['esito']="Date non valide";
      header("Location: modulo_setCalendario.php");
    }else{
      $ris=setCalendario($_POST['anno_acc'], $_POST['semestre'], $_POST['mese_in'], $_POST['giorno_in'], $_POST['mese_fin'], $_POST['giorno_fin']);
      if(!$ris){
        $_SESSION['errore']['esito']="Inserimento non riuscito";
        header("Location: modulo_setCalendario.php");
      }else {
        $_SESSION['errore']['esito']='Date inserite';
        header("Location: riepilogo.php?id=".$_SESSION['doc']);
      }
    }
  }
}
 ?>

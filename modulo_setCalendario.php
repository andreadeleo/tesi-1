<?php
require_once "funzioni_php.inc";
$anno=getAnno();
$annoAcc=$anno."/".($anno+1);
$dataPrimoSem=getDataCal($annoAcc, 'primo');
$dataSecSem=getDataCal($annoAcc, 'secondo');
if ($dataPrimoSem&&$dataSecSem) {
  $_SESSION['errore']['esito']="Date gi&agrave inserite";
  header("Location: riepilogo.php?id=".$_SESSION['doc']);
}else{
  stampaInizioPagina("Imposta calendario");
  $esito="";
  if ($dataPrimoSem) {
    $esito="Primo semestre impostato";
    stampaModulo_setCalendario($annoAcc, 'secondo', $dataPrimoSem['mese_in'], $dataPrimoSem['giorno_in'], $dataPrimoSem['mese_fin'], $dataPrimoSem['giorno_fin']);
    }else{
      if ($dataSecSem) {
        $esito='Secondo semestre impostato';
        stampaModulo_setCalendario($annoAcc, 'primo', $dataSecSem['mese_in'], $dataSecSem['giorno_in'], $dataSecSem['mese_fin'], $dataSecSem['giorno_fin']);
      }else{
      if (array_key_exists('ris', $_SESSION)) {
        $ris=$_SESSION['ris'];
        stampaModulo_setCalendario($annoAcc, $ris['semestre'], $ris['mese_in'], $ris['giorno_in'], $ris['mese_fin'], $ris['giorno_fin']);
      }else{
        stampaModulo_setCalendario($annoAcc);
      }
    }
  }
  echo "<span style='color: red'>$esito</span>";
  stampaErrore('esito');
  stampaFinePagina();
  unset($_SESSION['ris']);
  unset($_SESSION['errore']);
}
 ?>

<?php
require_once "funzioni_php.inc";
if (!controllaSessione()) {
  $_SESSION['errore']['err_sessione']="Utente non ammesso";
  header("Location: index.php");
}else{
  if(controllaRegistro($_SESSION['id'], $_SESSION['annoAcc'])){
    header("Location: registro.php");
  }else{
    stampaInizioPagina("Imposta orario");
    if (array_key_exists("oldpost", $_SESSION)) {
      $oldpost=$_SESSION['oldpost'];
      stampaModuloOrario($oldpost['giorno_in'], $oldpost['mese_in'], $oldpost['giorno_fin'], $oldpost['mese_fin'], $oldpost['giorni']);
    }else {
      $semestre=getSemestreLezione($_SESSION['id']);
      if ($semestre['sem']=="S1") {
        $ris=getDataCal($_SESSION['annoAcc'], 'primo');
      }
      if($semestre['sem']=="S2"){
        $ris=getDataCal($_SESSION['annoAcc'], 'secondo');
      }
    stampaModuloOrario($ris['giorno_in'], $ris['mese_in'], $ris['giorno_fin'], $ris['mese_fin']);
    }
    stampaErrore("err_data_setOrario");
    stampaErrore("err_fatal_setOrario");
    unset($_SESSION['oldpost']);
    unset($_SESSION['errore']);
    stampaTest($_SESSION);
    stampaFinePagina();
  }
}
 ?>

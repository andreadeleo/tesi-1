<?php
require_once "funzioni_db.inc";
require_once "moduli.inc";
ini_set('error_reporting',E_ALL & ~E_NOTICE);
session_start();

function getAnno(){
  $anno=date('Y');
  $mese=date('m');
  if($mese<9){
    $anno=$anno-1;
  }
  return $anno;
}

function getAnnoIns($mese){
  $anno=getAnno();
  if ($mese<9) {
    $anno=$anno+1;
  }
  return $anno;
}

function controllaSessione(){
  if (!array_key_exists('annoAcc', $_SESSION)||!array_key_exists('id', $_SESSION)) {
    return false;
  }else {
    return true;
  }
}

function getCds($cds){
  $corso=strtolower($cds);
  if ($corso=="economia e commercio") {
    return "CLEC";
  }
  if ($corso=="economia  e informatica per l'impresa") {
    return "CLEII";
  }
  if ($corso=="economia aziendale") {
    return "CLEA";
  }
  if ($corso=="servizi giuridici per l'impresa") {
    return "SEGI";
  }
  return $cds;
}

function getATipologia(){
  return array(
      'lezione' => 'Lezione',
      'esercitazione' => 'Esercitazione'
  );
}

function getASemestre(){
  return array(
    'primo' =>'Primo' ,
    'secondo'=>'Secondo');
}

function getMese(){
  return array('01' =>"Gennaio",
  '02' =>"Febbraio",
  '03' =>"Marzo",
  '04' =>"Aprile",
  '05' =>"Maggio",
  '06' =>"Giugno",
  '07' =>"Luglio",
  '08' =>"Agosto",
  '09' =>"Settembre",
  '10' =>"Ottobre",
  '11' =>"Novembre",
  '12' =>"Dicembre" );
}

function controllaRegistro($cod, $anno){
  $ris=getElencoRegistro($cod,$anno);
  if($ris->fetch()){
    return true;
  }else{
    return false;
  }
}

function stampaTest($a){
  echo "<pre>";
  print_r($a);
  echo "</pre>";
}

function stampaErrore($el) {
	$msg = $_SESSION['errore'][$el];
	if ($msg != '') {
		echo '<br> <span style="color: red">'
					.$msg
					.'</span>';
	}
  return true;
}
 ?>

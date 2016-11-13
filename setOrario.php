<?php
require_once "funzioni_php.inc";
ini_set("memory_limit",1024);
session_start();
function giornoData($g,$m,$a){
        $gShort = array('Dom','Lun','Mart','Merc','Giov','Ven','Sab');
        $ts = mktime(0,0,0,$m,$g,$a);
        $gd = getdate($ts);
      //  return $gShort[$gd['wday']]; restituisce giorno
         return $gd['wday']; //ritorna l’indice del giorno compreso tra 0 e 6
}

function aumenta($nGiorni,$inizio,$fine){
  $ris=array();
  $giorniSucc=array();
  $giorniSucc[]=$inizio;
  for($i=0;$i<count($nGiorni);$i++){
    $giorniSucc[]=date('Y-m-d',strtotime("$inizio +$nGiorni[$i] days"));
  }

  $ris=$giorniSucc;

  $pos=0;
  while($ris[count($ris)-1]!=$fine){
    $ris[]=date('Y-m-d',strtotime("$ris[$pos] +7 days"));
    $pos++;
  }
  return $ris;
}

function conta($day,$inizio){
  $n=count($day);
  $ris=array();
  $pos=0;
  for($i=0;$i<$n;$i++){
    if($day[$i]==$inizio){
      $pos=$i;
    }
  }
  for($i=$pos;$i<$n;$i++){
    if($i==$n-1){
      for($j=0;$j<$pos;$j++){
        $ris[]=7+$day[$j]-$day[$pos];
      }
    }else{
      $ris[]=$day[$i+1]-$day[$pos];
    }
  }
  return $ris;
}

if (!controllaSessione()) {
  $_SESSION['errore']['err_sessione']="Utente non ammesso";
}else{
  if (controllaRegistro($_SESSION['id'])) {
    header("Location: registro.php");
  }else {
    $giornoIn=$_POST['giorno_in'];
    $meseIn=$_POST['mese_in'];
    $giornoFin=$_POST['giorno_fin'];
    $meseFin=$_POST['mese_fin'];
    $giorni=$_POST['giorni'];
    $numGiorni=count($giorni);
    $annoAcc=$_SESSION['annoAcc'];
    $anni=explode("/",$annoAcc);

    if($meseIn>$meseFin){
      $annoIn=$anni[0];
      $annoFin=$anni[1];
    }else{
      if($meseIn>=9){
        $annoIn=$annoFin=$anni[0];
      }else{
        $annoIn=$annoFin=$anni[1];
      }
    }

    if(checkdate($meseIn,$giornoIn,$annoIn) && checkdate($meseFin,$giornoFin,$annoFin)){

      //controllo se data inserita corrisponde giorno della settimana selezionato
      $flag=false;
      $flag1=false;
      for($i=0;$i<$numGiorni;$i++){
        if($giorni[$i]==giornoData($giornoIn,$meseIn,$annoIn)){
          $flag=true;
        }
      }
      for($i=0;$i<$numGiorni;$i++){
        if($giorni[$i]==giornoData($giornoFin,$meseFin,$annoFin)){
          $flag1=true;
        }

      }
      if(!$flag || !$flag1){
        $_SESSION['errore']['err_data_setOrario']="Date non valide";
      }else{
        $dataInizio=$annoIn."-".$meseIn."-".$giornoIn;
        $dataFine=$annoFin."-".$meseFin."-".$giornoFin;
        $prova=conta($giorni,giornoData($giornoIn,$meseIn,$annoIn));
        $ris=aumenta($prova,$dataInizio,$dataFine);
        for($j=0;$j<count($ris);$j++){
          $giorni=explode("-",$ris[$j]);
          setOrario($_SESSION['id'],$giorni[0],$giorni[1],$giorni[2]);
        }
        header ("Location:registro.php");
      }
    }else {
     $_SESSION['errore']['err_fatal_setOrario']="Errore";
   }
  }
}

if (array_key_exists('errore', $_SESSION)) {
  if (array_key_exists('err_data_setOrario', $_SESSION['errore'])||array_key_exists('err_fatal_setOrario', $_SESSION['errore'])) {
     $_SESSION['oldpost']=$_POST;
     header("Location:modulo_setOrario.php");
  }else {
    header("Location: index.php");
  }
}
 ?>

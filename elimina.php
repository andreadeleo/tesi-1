<?php
session_start();
require_once "funzioni_db.inc";
if(!empty($_POST['giorni'])){
  for($i=0;$i<count($_POST['giorni']);$i++){
    $giorno=explode("-",$_POST['giorni'][$i]);
    deleteGiorno($_SESSION['id'],$_SESSION['annoAcc'],$giorno[0],$giorno[1]);
  }
}
  header ("Location:registro.php");
?>

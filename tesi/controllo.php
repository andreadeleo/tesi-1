<?php
require_once "funzioni_php.inc";
$_SESSION['id']=$_GET['id'];
$_SESSION['annoAcc']=$_GET['anno'];
if(controllaRegistro($_SESSION['id'], $_SESSION['annoAcc'])){
  header("Location: registro.php");
}else{
  header("Location: modulo_setOrario.php");
}
 ?>

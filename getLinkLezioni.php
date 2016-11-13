<?php
require_once "funzioni_php.inc";
$corsi=getCorsi($_SESSION['doc'], $_POST['anno']);
$ris="";
while($n=$corsi->fetch()){
$ris=$ris."<a href=controllo.php?id=".$n['id']."&anno=".$n['anno_acc']."/".($n['anno_acc']+1).">".$n['nome']." ".$n['anno_acc']." (".getCds($n['NOME_CDS']).")</a><br>";
}
echo $ris;
 ?>

<?php
require_once "funzioni_php.inc";
stampaErrore('err_sessione');
$ris=getDoc();
while ($n=$ris->fetch()) {
 echo "<a href=riepilogo.php?id=".$n['id'].">".$n['nome']."</a><br>";
}
stampaTest($_SESSION);
unset($_SESSION);
session_destroy();
 ?>

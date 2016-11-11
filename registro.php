<?php
require_once "funzioni_php.inc";
stampaInizioPagina("Registro");
$ris=getElencoRegistro($_SESSION['id'], $_SESSION['annoAcc']);
$ins=getInfoCorso($_SESSION['id']);
$doc=getInfoDoc($_SESSION['doc']);
echo "<h1 align='center'> Registro del corso: ".$ins['nome_c']." (".getCds($ins['cds']).")<br>Anno Accademico: ".$_SESSION['annoAcc']."<br>Docente: ".$doc['nome']." ".$doc['cognome']."</h1>";
echo stampaLink("aggiungiModificaForm.php?mod=aggiungi","Aggiungi nuova lezione");
echo "<div align=right>".stampaLink("riepilogo.php?id=".$_SESSION['doc'],"Torna alla home")."</div>";
echo "<br><form action='elimina.php' method='post'>";
echo "<table cellspacing='0' cellpadding='5' border='1'><tr><th>Elimina</th><th>Giorno</th><th>Mese</th><th>Anno</th><th>Tipologia</th><th>Argomento</th><th>Inserisci/Modifica</th>";
while($n=$ris->fetch()){
  if($n['tipologia']==NULL){
    $n['tipologia']="";
  }
  if($n['argomento']==NULL){
    $n['argomento']="";
  }
  echo stampaRigaTabella(stampaCheckbox("giorni[]",$n['giorno']."-".$n['mese']),$n['giorno'],$n['mese'],$n['anno'],$n['tipologia'],$n['argomento'],stampaLink("aggiungiModificaForm.php?mod=modifica&mese=".$n['mese']."&giorno=".$n['giorno'],"Inserisci/Modifica argomento"));
}
echo "</table>";
echo "<input type='submit' value='Elimina'>";
echo "</form>";
stampaTest($_SESSION);
stampaFinePagina();

 ?>

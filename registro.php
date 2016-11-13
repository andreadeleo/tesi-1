<?php
require_once "funzioni_php.inc";
if (!array_key_exists('id', $_SESSION)) {
  if(!array_key_exists('doc', $_SESSION)){
    $_SESSION['errore']['err_sessione']="Utente non ammesso";
    header("Location: index.php");
  }else {
    $_SESSION['errore']['err_registro']="Selezionare un insegnamento";
    header("Location: riepilogo.php?id=".$_SESSION['doc']);
  }
}else{
  if (!controllaRegistro($_SESSION['id'])) {
    header("Location: modulo_setOrario.php");
  }else{
    stampaInizioPagina("Registro");
    $ris=getElencoRegistro($_SESSION['id']);
    $ins=getInfoCorso($_SESSION['id']);
    $doc=getInfoDoc($_SESSION['doc']);
    echo "<h1 align='center'> Registro del corso: ".$ins['nome_c']." (".getCds($ins['cds']).")<br>Anno Accademico: ".$_SESSION['annoAcc']."<br>Docente: ".$doc['nome']." ".$doc['cognome']."</h1>";
    echo stampaLink("aggiungiModificaForm.php?mod=aggiungi","Aggiungi nuova lezione");
    echo "<div align=right>".stampaLink("riepilogo.php?id=".$_SESSION['doc'],"Torna alla home")."</div>";
    stampaErrore("err_registro");
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
    unset($_SESSION['errore']);
    stampaFinePagina();
  }
}
 ?>

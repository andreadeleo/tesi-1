<?php
  require_once "funzioni_php.inc";
    if(!isset($_GET['id'])||$_GET['id']==""){
      $_SESSION['errore']['err_sessione']="Utente non ammesso";
      header("Location: index.php");
    }else{
    stampaInizioPagina("Riepilogo", "funzioni_js.js");
    $_SESSION['doc']=$_GET['id'];
    $info=getInfoDoc($_SESSION['doc']);
    echo "<h3>Pagina del Professore: ".$info['nome']." ".$info['cognome']."</h3>";


    $anno=getAnno();
    ?>
    Anno accademico:
    <select id="anno" onchange="aggiorna()">
    <?
    $anni=getAnni($_SESSION['doc']);
    while ($n=$anni->fetch()) {
      $select="";
      $annoAcc=$n['ANNO_EROGAZIONE']."/".($n['ANNO_EROGAZIONE']+1);
      if ($n['ANNO_EROGAZIONE']==$anno) {
        $select="selected='selected'";
      }
      echo "<option value=".$n['ANNO_EROGAZIONE']." ".$select.">".$annoAcc;
    }
    ?>
  </select>
  <div align="right">
    <?
      echo stampaLink("modulo_setCalendario.php","Imposta calendario didattico");
      stampaErrore('esito');
      unset($_SESSION['errore']);
      ?>
  </div>
  <!--<input type="button" value="Mostra Corsi" onclick="aggiorna()">!-->
  <hr>
    <strong>Insegnamenti:</strong>
    <div id="link"></div>
   <script type="text/javascript">
     document.ready=aggiorna();
   </script>
   <?
    echo "<hr>".stampaLink("index.php", "Esci");
    stampaTest($_SESSION);
    unset($_SESSION['errore']);
    stampaFinePagina();
}
?>

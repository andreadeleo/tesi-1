<?php
require_once "html.inc";

function stampaModuloOrario($giorno_in="", $mese_in="", $giorno_fin="", $mese_fin="", $giorni_sett=""){
  ?>
  <form action="setOrario.php" method="post">
  <fieldset>
    <legend> <h2>Imposta orario lezioni</h2></legend>
    <h3>Data inizio lezioni: </h3>
    Giorno:
    <?=stampaSelectGiorni("giorno_in", $giorno_in); ?>
    Mese:
    <?php
      $mese=getMese();
      echo stampaSelect("mese_in",$mese, $mese_in);
     ?>
    <span id="err_dataIn"> </span>
    <br>
    <h3>Data fine lezioni: </h3>
    Giorno:
    <?=stampaSelectGiorni("giorno_fin", $giorno_fin); ?>
    Mese:
    <?php
    echo stampaSelect("mese_fin",$mese, $mese_fin);
     ?>
    <span id="err_dataFin"> </span>

      <br>
    <h3>Giorni della settimana: </h3>
    <?php
    $giorni = array('1' => "Lunedi", '2'=>"Martedi",'3'=>"Mercoledi",'4'=>"Giovedi",'5'=>"Venerdi",'6'=>"Sabato" );
    foreach ($giorni as $key => $value) {
      $check="";
      for($i=0; $i<count($giorni_sett); $i++) {
        if ($giorni_sett[$i]==$key) {
          $check=" checked='checked'";
        }
      }
     echo stampaCheckbox("giorni[]",$key,$value, $check);
    }
    ?>
    <span id="err_giorni"> </span>
    <br>
    <input type="submit" value="Invia" />
  </fieldset>
  </form>
<?php
}

function stampaModuloModifica($lezione="", $anno="", $mod=""){
  $tipologia="";
  $argomento="";
  if($mod=="modifica"){
   ?>
   <form action="modifica.php" method="post">
     <fieldset>
       <legend> <?="<h2>Lezione del ".$lezione['giorno']."/".$lezione['mese']." Anno Accademico ".$anno."</h2>"?></legend>
       <input type="hidden" name="giorno" value="<?=$lezione['giorno']?>">
       <input type="hidden" name="mese" value="<?=$lezione['mese']?>">
    <?
    $tipologia=$lezione['tipologia'];
    $argomento=$lezione['argomento'];
}
  if ($mod=="aggiungi"): ?>
  <form  action="aggiungi.php" method="post">
    <fieldset>
      <legend><h2>Aggiungi nuova lezione </h2></legend>
      Giorno: <?=stampaSelectGiorni('giorno'); ?>
      <br>
      Mese <?=stampaSelect("mese",getMese()); ?>
      <br>
<?php endif; ?>
     <h3>Tipologia:</h3> <?=stampaRadio('tipologia',getATipologia(),$tipologia); ?>
     <h3>Argomento: </h3>
     <?=stampaTextArea('argomento',$argomento);?>
     <br>
     <input type="submit" value="Invia" />
     </fieldset>
    </form>
   <?php
 }

function stampaModulo_setCalendario($annoAcc, $sem="", $meseIn="", $giornoIn="", $meseFin="", $giornoFin=""){
  ?>
  <form action="setCalendario.php" method="post">
    <fieldset>
      <legend><h2>Imposta calendario didattico per l'anno <?=$annoAcc?></h2></legend>
    <input type="hidden" name="anno_acc" value=<?=$annoAcc?>>
    <h3>Semestre: </h3>
    <?=stampaRadio("semestre", getASemestre(),$sem);?>
    <h3>Data Inizio</h3>
    Giorno: <?=stampaSelectGiorni("giorno_in", $giornoIn)?>
    Mese: <?=stampaSelect("mese_in", getMese(), $meseIn)?>
    <h3>Data Fine</h3>
    Giorno: <?=stampaSelectGiorni("giorno_fin", $giornoFin)?>
    Mese: <?=stampaSelect("mese_fin", getMese(), $meseFin)?>
    <p>
    <input type="submit" value="Invia">
  </p>
  </fieldset>
  </form>
<?php
}
?>

<?php
function stampaCheckbox($id,$val,$name="", $check=""){
    $ris="<label><input type='checkbox' name=".$id." value=".$val."".$check.">".$name."<br></label>";
    return $ris;
}

function stampaSelectGiorni($id, $val=""){
  $ris="<select name=".$id.">";
  $num=1;
  while($num<=31){
    $select="";
    if($num==$val){
        $select =' selected="selected" ';
      }
    if($num<10){
      $num="0".$num;
    }
    $ris=$ris."<option value=".$num."".$select.">".$num."</option>";
    $num++;
  }
  $ris=$ris."</select>";
  return $ris;
}

function stampaSelect($id,$array,$val=""){
  $ris="<select name=".$id.">";
  foreach ($array as $key => $value) {
    $select="";
    if($val==$key){
      $select=" selected='selected'";
    }
      $ris=$ris."<option value=".$key."".$select.">".$value."</option>";
  }
  $ris=$ris."</select>";
  return $ris;

}

function stampaInizioPagina($title,$val="") {
  ?>
  <!DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8">
      <title><?=$title?></title>
      <?php if ($val!=""): ?>
        <script type="text/javascript" src=<?=$val?>></script>
      <?php endif; ?>
    </head>
    <body>
<?}


function stampaFinePagina(){?>
  </body>
  </html>
<?}


function stampaRigaTabella($check="",$anno,$mese,$giorno,$tip,$arg,$mod=""){
  $ris="<tr><td>".$check."</td><td>".$anno."</td><td>".$mese."</td><td>".$giorno."</td><td>".$tip."</td><td>".$arg."</td><td>".$mod."</td></tr>";
  return $ris;
}

function stampaLink($pagina,$valore){
  $ris="<a href=".$pagina.">".$valore."</a>";
  return $ris;
}

function stampaRadio($nomeEl,$arrayEl,$currVal='') {
  $ris="";
	foreach($arrayEl as $val=>$label) {
		$checkedStr = '';
		if ($val==$currVal) {
			$checkedStr = ' checked="checked" ';
		}
		 $ris=$ris."<label>$label <input type=\"radio\" name=\"$nomeEl\" value=\"$val\" $checkedStr/></label><br>";
	}
  return $ris;
}

/*function stampaOpzioniSelect($arrayEl,$currValA) {
	foreach($arrayEl as $key=>$value) {
    $selectedStr = '';
		if ($key==$currValA) {
			$selectedStr = ' selected="selected" ';
		}
		echo "<option value=\"$key\" $selectedStr> $value </option>  ";
	}
}

function stampaOpzioniSelectGiorno($val){
  $num=1;
  $selectedStr = '';
  while($num<=31){
    if($num<10){
      $num="0".$num;
    }
    if($num==$val){
      	$selectedStr = ' selected="selected" ';
        echo "<option value=\"$num\" $selectedStr>".$num."</option>";
    }else{
      echo "<option value=".$num.">".$num."</option>";
    }
    $num++;
  }
}
*/
function stampaTextArea($nome,$val=''){
  $ris="<textarea name=".$nome." rows=\"5\" cols=\"40\" maxlength=\"200\">".$val."</textarea>";
  return $ris;
}
?>

<?php
function dbConnect(){
  try {
    $pdo=new pdo("mysql:host=localhost;dbname=tesi","root","root");
    //$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
  } catch (PDOException $e) {
    echo "Errore: ".$e->getMessage();
  }
}

function getAnni($doc){
  $pdo=dbConnect();
  $ris=$pdo->prepare("SELECT ANNO_EROGAZIONE FROM v_insegnamenti where MATRICOLA_RESP_DID=:doc group by ANNO_EROGAZIONE");
  $ris->bindValue(":doc",$doc);
  $ris->execute();
  return $ris;
}

function getInfoCorso($id){
  $pdo=dbConnect();
  $result=$pdo->prepare("SELECT NOME_CDS as cds, DES as nome_c, ANNO_EROGAZIONE from v_insegnamenti where AF_ID=:id");
  $result->bindValue(":id", $id);
  $result->execute();
  $n=$result->fetch();
  return $n;
}

function getInfoDoc($id){
  $pdo=dbConnect();
  $query="SELECT COGNOME_RESP_DID as cognome, NOME_RESP_DID as nome  from v_insegnamenti where MATRICOLA_RESP_DID=:id";
  $result=$pdo->prepare($query);
  $result->bindValue(":id",$id);
  $result->execute();
  $n=$result->fetch();
  return $n;
}

function getCorsi($doc, $anno){
  $pdo=dbConnect();
  $query="SELECT AF_ID as id, NOME_CDS, DES as nome, ANNO_EROGAZIONE as anno_acc from v_insegnamenti where MATRICOLA_RESP_DID=:id and ANNO_EROGAZIONE=:anno group by nome";
  $ris=$pdo->prepare($query);
  $ris->bindValue(":id",$doc);
  $ris->bindValue(":anno",$anno);
  $ris->execute();
  return $ris;
}

function getDoc(){
  $pdo=dbConnect();
  $ris=$pdo->query("SELECT COGNOME_RESP_DID as 'nome', MATRICOLA_RESP_DID AS 'id' from v_insegnamenti where NOME_CDS='ECONOMIA  E INFORMATICA PER L\'IMPRESA' group by MATRICOLA_RESP_DID");
  $ris->execute();
  return $ris;
}

function getElencoRegistro($id){
  $pdo=dbConnect();
  $ris=$pdo->prepare("SELECT * from reg_corso where cod=:id ORDER BY anno,mese,giorno");
  $ris->bindValue("id", $id);
  $ris->execute();
  return $ris;
}

function setOrario($ins,$anno_acc , $anno, $mese, $giorno){
  $pdo=dbConnect();
  $ris=$pdo->prepare("INSERT INTO reg_corso (cod,  anno_acc,anno ,mese, giorno, tipologia, argomento) values (:ins, :anno_acc, :anno, :mese, :giorno, NULL, NULL)");
  $ris->bindValue(":ins", $ins);
  $ris->bindValue(":anno_acc", $anno_acc);
  $ris->bindValue(":anno", $anno);
  $ris->bindValue(":mese", $mese);
  $ris->bindValue(":giorno", $giorno);
  $ris->execute();
}

function deleteGiorno($cod,$annoAcc,$giorno,$mese){
  $pdo=dbConnect();
  $ris=$pdo->prepare("DELETE FROM reg_corso WHERE cod=:cod AND anno_acc=:anno_acc AND giorno=:giorno AND mese=:mese");
  $ris->bindValue(":cod",$cod );
  $ris->bindValue(":anno_acc",$annoAcc);
  $ris->bindValue(":giorno", $giorno);
  $ris->bindValue(":mese", $mese);
  $ris->execute();

}

 function getElencoRegistroModifica($cod,$annoAcc,$giorno,$mese){
   $pdo=dbConnect();
   $ris=$pdo->prepare("SELECT * FROM reg_corso WHERE cod=:cod AND anno_acc=:anno_acc AND giorno=:giorno AND mese=:mese");
   $ris->bindValue(":cod",$cod );
   $ris->bindValue(":anno_acc",$annoAcc);
   $ris->bindValue(":giorno", $giorno);
   $ris->bindValue(":mese", $mese);
   $ris->execute();
   $riga = $ris->fetch();
   return $riga;
 }

 function setRegistro($cod,$annoAcc,$giorno,$mese,$tipologia,$argomento){
   $pdo=dbConnect();
   $ris=$pdo->prepare("UPDATE reg_corso SET tipologia=:tipologia , argomento=:argomento WHERE cod=:cod AND anno_acc=:anno_acc AND mese=:mese AND giorno=:giorno");
   $ris->bindValue(":cod",$cod );
   $ris->bindValue(":anno_acc",$annoAcc);
   $ris->bindValue(":giorno", $giorno);
   $ris->bindValue(":mese", $mese);
   $ris->bindValue(":tipologia", $tipologia);
   $ris->bindValue(":argomento", $argomento);
   $ris->execute();
 }

 function insertRegistro($cod,$annoAcc,$anno,$giorno,$mese,$tipologia,$argomento){
   $pdo=dbConnect();
   $ris=$pdo->prepare("INSERT INTO reg_corso (cod, anno_acc, anno, mese, giorno, tipologia, argomento) VALUES (:cod, :anno_acc, :anno, :mese, :giorno, :tipologia, :argomento)");
   $ris->bindValue(":cod",$cod );
   $ris->bindValue(":anno_acc",$annoAcc);
   $ris->bindValue(":anno",$anno);
   $ris->bindValue(":giorno", $giorno);
   $ris->bindValue(":mese", $mese);
   $ris->bindValue(":tipologia", $tipologia);
   $ris->bindValue(":argomento", $argomento);
   $ris->execute();
 }

function setCalendario($anno_acc, $semestre, $mese_in, $giorno_in, $mese_fin, $giorno_fin){
  $pdo=dbConnect();
  $query=$pdo->prepare("INSERT into calendario_did(anno_acc, semestre, mese_in, giorno_in, mese_fin, giorno_fin) values(:anno, :sem, :mese_in, :giorno_in, :mese_fin, :giorno_fin)");
  $query->bindValue(":anno", $anno_acc);
  $query->bindValue(":sem", $semestre);
  $query->bindValue(":mese_in", $mese_in);
  $query->bindValue("giorno_in", $giorno_in);
  $query->bindValue(":mese_fin", $mese_fin);
  $query->bindValue(":giorno_fin", $giorno_fin);
  if($query->execute()){
    return true;
  }else {
    return false;
  }
}

function getDataCal($anno_acc, $sem){
  $pdo=dbConnect();
  $query=$pdo->prepare("SELECT * from calendario_did where anno_acc=:anno and semestre=:sem");
  $query->bindValue(":anno", $anno_acc);
  $query->bindValue(":sem", $sem);
  $query->execute();
  return $query->fetch();
}

function getSemestreLezione($id){
  $pdo=dbConnect();
  $query=$pdo->prepare("SELECT tipo_ciclo_cod as sem from v_insegnamenti where AF_ID=:id");
  $query->bindValue(":id", $id);
  $query->execute();
  return $query->fetch();
}

 ?>

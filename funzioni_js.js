  function creaErrore(id,s){
    var elem=document.getElementById(id);
    elem.innerHTML=s;
  }

  function pulisci(a){
    for (var i = 0; i < a.length; i++) {
      document.getElementById(a[i]).innerHTML="";
    }
  }

  /*function validaOrario(modulo){
    var flag=true;
    pulisci(new Array("err_dataIn", "err_dataFin", "err_giorni"));
    var giorno_in=modulo.giorno_in.value;
    var mese_in=modulo.mese_in.value;
    if (giorno_in==""||mese_in=="") {
      creaErrore("err_dataIn", "Data non valida");
      flag=false;
    }
    if (modulo.giorno_fin.value==""||modulo.mese_fin.value=="") {
      creaErrore("err_dataFin", "Data non valida");
      flag=false;
    }
    var check=false;
    var giorni=modulo["giorni[]"];
    for (var i = 0; i < giorni.length; i++) {
      if(giorni[i].checked){
        check=true;
      }
    }
    if(!check){
      creaErrore("err_giorni", "Selezionare almeno un giorno");
      flag=false;
    }
    return flag;
  }

  function impostaGiorno(mese){
    var giorno_in=document.modulo.giorno_in;
    var giorno_fin=document.modulo.giorno_fin;
    if (mese.value=="02") {
      giorno_in.options['30'].style.display="none";
      giorno_in.options['31'].style.display="none";
    }else{
    if (mese.value=="09") {
      giorno_in.options['31'].style.display="none";
    }else {
      giorno_in.options['30'].style.display="inline";
      giorno_in.options['31'].style.display="block";
    }
  }
    if(mese.value=="11"||mese.value=="aprile"){
      giorno_fin.options['31'].style.display="none";
    }else {
      giorno_fin.options['31'].style.display="inline";
    }
  }
*/
  function aggiorna(){
      var xhr=new XMLHttpRequest();
      xhr.onreadystatechange=function(){
        if(xhr.readyState==4&&xhr.status==200){
          if(xhr.response==""){
            document.getElementById('link').innerHTML="Nessun risultato";
          }else{
              document.getElementById('link').innerHTML=xhr.response;
            }
        }else{
          document.getElementById('link').innerHTML="Errore";
        }
      }
        xhr.open("POST", "getLinkLezioni.php", true);
        xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xhr.send("anno="+document.getElementById('anno').value);
    }

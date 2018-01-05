$('#myModal2').modal()

  function matchfct(champ)
  {

    $.getJSON('fichier.json',function(data){

     for(i=0; i<data.length; i++)
     {
      if (champ.value == data[i].name) 
      {
        document.imgequipe1.src = data[i].img;
        var trans = data[i].date;
        var madate = trans.split('/');

        document.getElementById("affichematch").value = madate[2]+'-'+madate[1]+'-'+madate[0];
        document.getElementById("divaff").style.display="block";
        document.getElementById("acc").style.display="block";

        document.getElementById("selec1").value="init";
        document.getElementById("selec2").value="init";
        document.getElementById("selec3").value="init";

        document.getElementById("selec1").style.backgroundColor ="white";
        document.getElementById("selec2").style.backgroundColor ="white";
        document.getElementById("selec3").style.backgroundColor ="white";

        document.getElementById("selec1").style.borderColor ="white";
        document.getElementById("selec2").style.borderColor ="white";
        document.getElementById("selec3").style.borderColor ="white";

      }
    }
  });
    validselect(champ);
  }

  function validselect(champ)
  {
    if (champ.value != 'init'){
      verif(champ, false);
      return true;
    }else
    {
      verif(champ, true);
      return false;
    }
  }

  function rangfct(champ,valeur)
  {
    var valeurmin=0;
    var valeurmax=0;
    var increm=0;

    for (var i = 1; i < 202; i++) {
      if (champ.value==i)
      {
        valeurmin=(i-1)*20;
        valeurmax=valeurmin+20;
      }
    }


     $.getJSON('fichier2.json',function(data){
     
     for(var i=0; i<data.length; i++)
     {

     for (var j = valeurmin; j <= valeurmax; j++) 
     {

      if (j == data[i].place && document.getElementById("ListeClub").value == data[i].name) 
      {

      document.getElementById("place"+increm).innerHTML=j+" non disponible ";
      document.getElementById("place"+increm).disabled = true;
      document.getElementById("place"+increm).style.backgroundColor = "#F0A8A9";
      increm++;

      }else
      {

      document.getElementById("place"+increm).innerHTML=j;
      document.getElementById("place"+increm).disabled = false;
      document.getElementById("place"+increm).style.backgroundColor = "white";
      increm++;

      }

     if(valeur==0)
     {
      validselect(champ);
     }

    }

    }

    });

  }

  function accesfct(champ)
  {

    var valeurmin=0;
    var valeurmax=0;
    var increm=0;


    switch(champ.value)
    {

      case "A":
      valeurmin=1;
      break;

      case "B":
      valeurmin=21;
      break;

      case "C":
      valeurmin=41;
      break;

      case "D":
      valeurmin=61;
      break;

      case "E":
      valeurmin=81;
      break;

      case "F":
      valeurmin=101;
      break;

      case "G":
      valeurmin=121;
      break;

      case "H":
      valeurmin=141;
      break;

      case "I":
      valeurmin=161;
      break;

      case "J":
      valeurmin=181;
      break;
    }

    valeurmax= valeurmin+20;

    for (var j = valeurmin; j <= valeurmax; j++) {
      document.getElementById("rang"+increm).innerHTML=j;
      increm++;
    }

    validselect(champ);
    rangfct(document.getElementById("selec2"),1);
    
  }

  function traitementmail(champ)
  {
   var filtre = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
   if(filtre.test(champ.value))
   {
    verif(champ, false);
    return true;
  }
  else
  {
    verif(champ, true);
    return false;
  }
}

function traitementmot(champ)
{
  var filtre=/^[a-zA-Zàâéèëêïîôùüç -]{1,60}$/;
  if( !filtre.test(champ.value) || champ.value.length < 2 || champ.value.length > 25)
  {
    verif(champ, true);
    return false;
  }
  else
  {
    verif(champ, false);
    return true;
  }
}


function traitementcp(champ)
{

 var filtre=/^(2[AB]|0[1-9]|[1-9][0-9])[0-9]{3}$/;

 if(!filtre.test(champ.value) || champ.value.length<5 || champ.value.length>6 )
 {
  verif(champ, true);
  return false;
}
else
{
  verif(champ, false);
  return true;
}
}

function traitementadresse(champ)
{
  var filtre = /[0-9]{1,3}(?:(?:[,. ]){1}[-a-zA-Zàâäéèêëïîôöùûüç]+)+/;

  if(filtre.test(champ.value))
  {
    verif(champ, false);
    return true;
  }
  else
  {
    verif(champ, true);
    return false;
  }
}

function traitementdate(champ)
{
  var filtre = /[+-]?[0-9]{1,4}/;

  var ladate = new Date();

  var lejour= ladate.getDate();
  var lemois= ladate.getMonth();
  var lannee= ladate.getFullYear();

  var monjour = champ.value.substring(8,10);
  var monmois = champ.value.substring(5,7);
  var monannee = champ.value.substring(0,4);

  lannee-=18;
  lemois+=1;

  if((!filtre.test(monjour)||!filtre.test(monmois)||!filtre.test(monannee))||(lannee-monannee<0)||(lannee-monannee==0 && lemois-monmois<0)||(lannee-monannee==0 && lemois-monmois==0 && lejour-monjour<0))
  {
    verif(champ,true);
    return false;
  }else{
    verif(champ,false);
    return true; 
  }

}

function traitementradio()
{
  if (document.getElementById("civil1").checked || document.getElementById("civil2").checked || document.getElementById("civil3").checked) 
  {
    document.getElementById("civil").style.padding= "1% 1% 1% 1%";
    document.getElementById("civil").style.borderRadius= "5px";
    document.getElementById("civil").style.backgroundColor="#C8F2B3";
    document.getElementById("civil").style.border="thick solid #5cb85c";
    return true;
  }else{
    document.getElementById("civil").style.padding= "1% 1% 1% 1%";
    document.getElementById("civil").style.borderRadius= "5px";
    document.getElementById("civil").style.backgroundColor="#F0A8A9";
    document.getElementById("civil").style.border="thick solid #d9534f";
    return false;
  }
}


function verif(champ, error)
{


  if(error)
  {
    champ.style.backgroundColor = "#F0A8A9";
    champ.style.borderColor = "#d9534f";
  }else
  {
    champ.style.backgroundColor = "#C8F2B3";
    champ.style.borderColor = "#5cb85c";
  }
}

function traitementform()
{
 var monnom = traitementmot(document.getElementById("nom"));
 var monprenom = traitementmot(document.getElementById("prenom"));
 var monadresse = traitementadresse(document.getElementById("adresse"));
 var maville = traitementmot(document.getElementById("ville"));
 var moncp = traitementcp(document.getElementById("CP"));
 var monmail = traitementmail(document.getElementById("mail"));
 var moncivil = traitementradio();
 var madate =traitementdate(document.getElementById("naissance"));

 var monmatch = validselect(document.getElementById("ListeClub"));
 var monacces = validselect(document.getElementById("selec1"));
 var monrang = validselect(document.getElementById("selec2",0));
 var maplace = validselect(document.getElementById("selec3"));

 if(monnom && monprenom && monadresse && maville && moncp && monmail && moncivil && madate && monmatch && monacces && monrang && maplace)
 {

  return true;
}else
{
  $('#myModal').modal()
  return false;
}
}


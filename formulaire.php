
<!DOCTYPE html>
<html>
<head>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>

<?php

try
{
  $bdd = new PDO('mysql:host=localhost;dbname=projetevent;charset=utf8', 'root', '');
}
catch (Exception $e)
{
  die('Erreur : ' . $e->getMessage());
}
?>

  <div class="container">

    <form  method="post" action="formulaire.php" name="formulaire" onsubmit="return traitementform()">

      <div class="row">

       <div class="col-xs-12 text-center">
         <h2 id="titreform">Formulaire d'inscription</h2>
       </div>

       <div class="form-group col-xs-12 col-md-3 col-lg-2">
        <div class="divradio">

          <label for="example-text-input" id="civil" class="col-form-label"> <i class="fa fa-users" aria-hidden="true"></i> Civilité</label>
          <div class="radio" >
            <label><input type="radio" class="mesboutons" value="Monsieur" id="civil1" name="utilisateur[civil]" onclick="traitementradio()">Monsieur</label>
          </div>
          <div class="radio">
            <label><input type="radio" class="mesboutons" value="Madame" id="civil2" name="utilisateur[civil]" onclick="traitementradio()">Madame</label>
          </div>
          <div class="radio">
            <label><input type="radio" class="mesboutons" value="Mademoiselle" id="civil3" name="utilisateur[civil]" onclick="traitementradio()">Mademoiselle</label>
          </div>
          <p class="info"><i class="fa fa-question-circle" aria-hidden="true"></i> Vous devez cocher votre civilité.</p>

        </div>
      </div>


      <div class="col-xs-12 col-md-9 col-lg-10">
        <div class="divform">
          <div class="row">

            <div class="divnom form-group col-xs-12 col-md-4 col-lg-12 ">
              <label for="nom" class="col-form-label"> <i class="fa fa-id-card" aria-hidden="true"></i> Mon nom :</label>  
              <p class="info"><i class="fa fa-question-circle" aria-hidden="true"></i> Votre nom doit faire entre deux et vingt-cinq caractéres et ne doit contenir que des lettres.</p>
              <input class="form-control"  type="text" placeholder="Ex : Dupond" id="nom" name="utilisateur[nom]" onblur="traitementmot(this)">             
            </div>

            <div class="divprenom form-group col-xs-12 col-md-4 col-lg-12">
              <label for="prenom" class="col-form-label"><i class="fa fa-id-card-o" aria-hidden="true"></i> Mon prénom :</label>
              <p class="info"><i class="fa fa-question-circle" aria-hidden="true"></i> Votre prénom doit faire entre deux et vingt-cinq caractéres et ne doit contenir que des lettres.</p>
              <input class="form-control" type="text" placeholder="Ex: Jean" id="prenom" name="utilisateur[prenom]" onblur="traitementmot(this)"> 
            </div>

            <div class="divcp form-group col-xs-12 col-md-4 col-lg-6">
              <label for="CP" class="col-form-label"><i class="fa fa-key" aria-hidden="true"></i> Mon Code Postal :</label>
              <p class="info"><i class="fa fa-question-circle" aria-hidden="true"></i> Votre Code Postal doit contenir cinq chiffres.</p>
              <input class="form-control" type="text" placeholder="Ex: 75000" id="CP" maxlength="5" name="utilisateur[cp]" onblur="traitementcp(this)">
            </div>

            <div class="divville form-group col-xs-12 col-md-4 col-lg-6">
              <label for="ville" class="col-form-label"><i class="fa fa-building" aria-hidden="true"></i> Ma ville :</label>
              <p class="info"><i class="fa fa-question-circle" aria-hidden="true"></i> Votre ville doit faire entre deux et vingt-cinq caractéres et ne doit contenir que des lettres.</p>
              <input class="form-control" type="text" placeholder="Ex: Poitiers" id="ville" name="utilisateur[ville]" onblur="traitementmot(this)">
            </div>

            <div class="divadresse form-group col-xs-12 col-md-4 col-lg-6">
              <label for="adresse" class="col-form-label"><i class="fa fa-map-marker" aria-hidden="true"></i> Mon adresse :</label>
              <p class="info"><i class="fa fa-question-circle" aria-hidden="true"></i> Votre adresse doit contenir le numéro ainsi que le nom de votre rue.</p>
              <input class="form-control" type="text" placeholder="Ex: 19 Place du village" id="adresse" name="utilisateur[adresse]" onblur="traitementadresse(this)">
            </div>

            <div class="divnaissance form-group col-xs-12 col-md-4 col-lg-6">
              <label for="ville" class="col-form-label"><i class="fa fa-calendar-minus-o" aria-hidden="true"></i> Ma date de naissance :</label>
              <p class="info"><i class="fa fa-question-circle" aria-hidden="true"></i> Votre date de naissance doit correspondre à celle d'une personne majeur.</p>
              <input class="form-control" type="date" id="naissance" name="utilisateur[naissance]" onblur="traitementdate(this)">
            </div>

            <div class="divmail form-group col-xs-12 col-md-4 col-lg-6">
              <label for="mail" class="col-form-label"><i class="fa fa-envelope-open-o" aria-hidden="true"></i> Mon e-mail :</label>
              <p class="info"><i class="fa fa-question-circle" aria-hidden="true"></i> Votre adresse e-mail doit être conforme et valide.</p>
              <input class="form-control" type="e-mail" placeholder="Ex: exemple@monadresse.fr" " id="mail" name="utilisateur[mail]" onblur="traitementmail(this)">
            </div>

          </div>
        </div>
      </div>

     
      <div class="col-xs-12 divmatch">
      <div class="row">

      <div class="col-xs-6">
       <label for="ListeClub">Club:</label>
        <select id="ListeClub" onchange="matchfct(this)"" class="form-control" value="">
          <?php  

          $reponse1= $bdd-> query('SELECT * from matchfoot ORDER BY pays');

$album_type = '';
$donnees = $reponse1->fetchAll();
                                         

foreach ($donnees as $donnees1) {

  if ($album_type != $donnees1['pays']) {
  echo '<optgroup label="'.$donnees1['pays'].'">';
    }
  echo '<option value="' . $donnees1['matchequ'] ." le : ".$donnees1['datematch'].'">'.$donnees1['club'] . '</option>';
  if ($album_type != $donnees1['pays']) {
  $album_type = $donnees1['pays']; 
  echo '</optgroup>';
  }   


 }
              
                
              
         ?>
          </select>
        </div>

      <div id="divaff" class="col-xs-6 text-center divaffichmatch">
      <label for="affichematch">Match:</label>
      <p id="affichematch"></p>
      </div>

     <!-- optgrp -->

      </div>
     
   
    


          <div class="col-xs-4">

              <label for="selec1">Accés: </label>
                <select class="form-control" onchange="accesfct(this)" value="" id="selec1">
                 <?php 
                 for ($i = "A"; $i <= "J"; $i++) {
                   echo '<option value="'.$i.'">'.$i.'</option>';
                 }
                 ?>
               </select>
             </div>

      
         <div class="col-xs-4">
         <label for="selec2">Rang: </label>
              <select class="form-control" value="" onchange="rangfct(this)" id="selec2">
               <?php for ($i = 0; $i <= 20; $i++) {
                echo '<option id="rang'.$i.'">'.($i+1).'</option>';
              }
              ?>
            </select>
          </div>

      <div class="col-xs-4">    
           <label for="selec3">Place:  </label>
           <select class="form-control" value="" id="selec3">
             <?php for ($i = 0; $i <= 20; $i++) {
              echo '<option value="" id="place'.$i.'">'.$i.'</option>';
            }
            ?>
          </select>
     </div>


 </div>
</div>


    


<input type="submit" class="btn btn-default" name="envoie" value="Envoyer"/>
<div class="row">
  <div class="col-xs-offset-3 col-xs-6">
    <div class="alert alert-danger" id="alert" role="alert">
      <div class="row">
        <div class="col-xs-1"><i class="fa fa-exclamation-circle fa-2x" aria-hidden="true"></i></div>
        <div class="col-xs-11 text-center alert_text">Certains champs n'ont pas été rempli correctement</div> 
      </div> 
    </div>
  </div>
</div> 



</form>

</div>

</body>

<script type="text/javascript">

  function matchfct(champ)
  {
  document.getElementById("divaff").style.display="block";
  document.getElementById("affichematch").innerHTML=champ.value;
  }

  function rangfct(champ)
  {
    var valeurmin=0;
    var valeurmax=0;
    var increm=0;
    for (var i = 1; i < 201; i++) {
      if (champ.value==i)
      {
        valeurmin=(i-1)*20;
        valeurmax=valeurmin+20;
      }
    }

    for (var j = valeurmin; j <= valeurmax; j++) {
      document.getElementById("place"+increm).innerHTML=j;
      increm++;
    }
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

    rangfct(document.getElementById("selec2"));

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
 var filtre=/^[0-9]{5,5}$/;

 if(!filtre.test(champ.value) || champ.value.length!=5)
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
    document.getElementById("alert").style.display="none";
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
    document.getElementById("alert").style.display="none";
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

 if(monnom && monprenom && monadresse && maville && moncp && monmail && moncivil && madate)
 {
  return true;
}else
{
  document.getElementById("alert").style.display="block";
  return false;
}
}


</script>

<style type="text/css">

 .divform, .divradio, .divmatch{
   padding: 2% 2% 2% 2%;
   background-color: rgba(0,0,0,0.2);
   border-radius: 10px;
 }

 .divmatch
 {
margin-top: 2%;
 }

 .info{
  display: none;
}

.divnom:hover > .info,
.divprenom:hover > .info,
.divadresse:hover > .info,
.divville:hover > .info,
.divradio:hover > .info,
.divnaissance:hover > .info,
.divcp:hover > .info,
.divmail:hover > .info{
 display: inline;
 position: absolute;
 background-color: #FDFABD;
 border-radius: 10px;
 padding: 2px 2px 2px 2px;
 margin-left: 1%;
 font-size: 10px;
}

.alert
{
 display: none;
}

.alert_text
{
 font-size: 16px;
}

.divaffichmatch
{
  display: none;
  border-radius: 10px;
  background-color: white;
}






</style>


<?php

$util=array();

if (isset($_POST['envoie']) && $_POST['envoie']=='Envoyer'){

  foreach($_POST['utilisateur'] as $valeur){
    $util[]=$valeur;
  }

  list($a,$b,$c,$d,$e,$f,$g,$h)=$util;

if (is_string($a) && is_string($b) && is_string($c) && is_int($d) && is_string($e) && is_string($g))
{
  $bdd->exec('INSERT INTO utilisateur(civilite, nom, prenom, cp, ville, adresse, naissance, mail, inscription) VALUES("'.$a.'","'.$b.'","'.$c.'","'.$d.'","'.$e.'","'.$f.'","'.$g.'","'.$h.'",NOW())');
}

}

?>


</html>


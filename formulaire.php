
<!DOCTYPE html>
<html>
<head>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <meta name="viewport" content="width=device-width, user-scalable=no">
<link href="https://fonts.googleapis.com/css?family=Yanone+Kaffeesatz" rel="stylesheet">
</head>

<body>

  <?php

  try
  {
    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
    $bdd = new PDO('mysql:host=localhost;dbname=projetevent;charset=utf8', 'root', '', $pdo_options);
  }
  catch (Exception $e)
  {
    die('Erreur : ' . $e->getMessage());
  }

  define('MYSQL_DATETIME_FORMAT','Y-m-d H:i:s');
  ?>



  <div class="container">

    <form  method="post" action="formulaire.php" name="formulaire" onsubmit="return traitementform()">

      <div class="row">

       <div class="col-xs-12 text-center titrediv">
        <h2 id="titreform">Billeterie en ligne</h2>
       </div>

      <div class="col-xs-12">
        <div class="divform">
          <div class="row">

          <div class="col-xs-4 col-md-2 text-center">
            <img src="./logos_equipes/logo_2.png" id="ballon">
          </div>

          <div class="col-xs-4 col-md-2 divradio">
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

          <div class="col-xs-4 col-md-2 text-center">
          <img src="./logos_equipes/comtois.png" id="comtois">
          </div>

            <div class="divnom form-group col-xs-12 col-md-6">
              <label for="nom" class="col-form-label labelcol"> <i class="fa fa-id-card" aria-hidden="true"></i> Mon nom :</label>  
              <p class="info"><i class="fa fa-question-circle" aria-hidden="true"></i> Votre nom doit faire entre deux et vingt-cinq caractéres et ne doit contenir que des lettres.</p>
              <input class="form-control"  type="text" placeholder="Ex : Dupond" id="nom" name="utilisateur[nom]" onblur="traitementmot(this)">             
            </div>

            <div class="divprenom form-group col-xs-12 col-md-6">
              <label for="prenom" class="col-form-label labelcol"><i class="fa fa-id-card-o" aria-hidden="true"></i> Mon prénom :</label>
              <p class="info"><i class="fa fa-question-circle" aria-hidden="true"></i> Votre prénom doit faire entre deux et vingt-cinq caractéres et ne doit contenir que des lettres.</p>
              <input class="form-control" type="text" placeholder="Ex: Jean" id="prenom" name="utilisateur[prenom]" onblur="traitementmot(this)"> 
            </div>

            <div class="divcp form-group col-xs-12 col-md-6">
              <label for="CP" class="col-form-label labelcol"><i class="fa fa-key" aria-hidden="true"></i> Mon Code Postal :</label>
              <p class="info"><i class="fa fa-question-circle" aria-hidden="true"></i> Votre Code Postal doit contenir cinq ou six caractéres.</p>
              <input class="form-control" type="text" placeholder="Ex: 75000" id="CP" maxlength="6" name="utilisateur[cp]" onblur="traitementcp(this)">
            </div>

            <div class="divville form-group col-xs-12 col-md-6">
              <label for="ville" class="col-form-label labelcol"><i class="fa fa-building" aria-hidden="true"></i> Ma ville :</label>
              <p class="info"><i class="fa fa-question-circle" aria-hidden="true"></i> Votre ville doit faire entre deux et vingt-cinq caractéres et ne doit contenir que des lettres.</p>
              <input class="form-control" type="text" placeholder="Ex: Poitiers" id="ville" name="utilisateur[ville]" onblur="traitementmot(this)">
            </div>

            <div class="divadresse form-group col-xs-12 col-md-6">
              <label for="adresse" class="col-form-label labelcol"><i class="fa fa-map-marker" aria-hidden="true"></i> Mon adresse :</label>
              <p class="info"><i class="fa fa-question-circle" aria-hidden="true"></i> Votre adresse doit contenir le numéro ainsi que le nom de votre rue.</p>
              <input class="form-control" type="text" placeholder="Ex: 19 Place du village" id="adresse" name="utilisateur[adresse]" onblur="traitementadresse(this)">
            </div>

            <div class="divnaissance form-group col-xs-12 col-md-6">
              <label for="naissance" class="col-form-label labelcol"><i class="fa fa-calendar-minus-o" aria-hidden="true"></i> Ma date de naissance :</label>
              <p class="info"><i class="fa fa-question-circle" aria-hidden="true"></i> Votre date de naissance doit correspondre à celle d'une personne majeur.</p>
              <input class="form-control" type="date" id="naissance" name="utilisateur[naissance]" onblur="traitementdate(this)">
            </div>

            <div class="divmail form-group col-xs-12 col-md-6">
              <label for="mail" class="col-form-label labelcol"><i class="fa fa-envelope-open-o" aria-hidden="true"></i> Mon e-mail :</label>
              <p class="info"><i class="fa fa-question-circle" aria-hidden="true"></i> Votre adresse e-mail doit être conforme et valide.</p>
              <input class="form-control" type="e-mail" placeholder="Ex: exemple@monadresse.fr" " id="mail" name="utilisateur[mail]" onblur="traitementmail(this)">
            </div>

            <div class="col-xs-12 col-md-6">
            <img src="./logos_equipes/partenaires.png" id="partenaires">
            </div>

          </div>
        </div>
      </div>





      <div class="col-xs-12 divmatch">
        <div class="row">

          <div class="col-xs-12 col-md-6 equipeext">
           <label class="labelcol" for="ListeClub"><i class="fa fa-futbol-o" aria-hidden="true"></i> Club extérieur :</label>
           <p class="info"><i class="fa fa-question-circle" aria-hidden="true"></i> Veuillez sélectionner l'équipe extérieure qui jouera contre FC Sochaux à domicile.</p>
           <select id="ListeClub" name="maListeClub" onchange="matchfct(this)" class="form-control" value=''>
             <option value="init">Sélectionnez une équipe</option>

             <?php  

             $reponse1= $bdd-> query('SELECT * from matchfoot ORDER BY matchequ');

             $donneesimg = $reponse1->fetchAll();   

             $dataimg = array();

             foreach ($donneesimg as $donneesimg1) 
             {

              $dataimg["name"]=$donneesimg1['matchequ'];
              $dataimg["date"]=$donneesimg1['datematch'];
              $dataimg["img"]=$donneesimg1['img_equipe'];
              $data1[]=$dataimg;

              echo '<option value="'.$donneesimg1['matchequ'].'" >'.$donneesimg1['matchequ'] . '</option>';
            }

            $fichier = fopen('fichier.json', 'w+');
            fwrite($fichier, json_encode($data1,JSON_PRETTY_PRINT));
            fclose($fichier);




            $reponse2= $bdd-> query('SELECT * from utilisateur');

            $donneesacces = $reponse2->fetchAll(); 

            $dataacces = array();

            foreach ($donneesacces as $donneesacces1 ) {

              $dataacces["place"]=$donneesacces1["place"];
              $dataacces["name"]=$donneesacces1["equipeadv"];
              $data2[]=$dataacces;

            }

            $fichier2 = fopen('fichier2.json','w+');
            fwrite($fichier2, json_encode($data2,JSON_PRETTY_PRINT));
            fclose($fichier2);



            ?>


          </select>
        </div>
        <div id="divaff" class=" col-xs-offset-1 col-xs-10 col-md-offset-0 col-md-6 text-center divaffichmatch">

          <div class="row">

            <div class="duelmatch col-xs-offset-1 col-xs-5 col-md-6">
              <div class="row">

                <div class="col-xs-4 col-md-5">
                  <img class="imgequ" name="imgequipe" src="./logos_equipes/Sochaux.png">
                </div>

                <div class="col-xs-4 col-md-2">
                  <img id="cross" src="./logos_equipes/cross.png">
                </div>

                <div class="col-xs-4 col-md-5">
                  <img class="imgequ" name="imgequipe1" src="">
                </div>

              </div>
            </div>

            <div class="col-xs-offset-0 col-xs-6 col-md-5">
              <label for="monaffichematch">Prochain match :</label>
              <input readonly class="form-control" type="date" id="affichematch" name="monaffichematch" value="" />
            </div>

          </div>




        </div>

      </div>

      <div class="col-xs-12 divacces" id="acc">
      <div class="row">

      <div class="col-xs-4 acces">

        <label class="labelcol" for="selec1"><i class="fa fa-list" aria-hidden="true"></i> Accés: </label>
        <p class="info"><i class="fa fa-question-circle" aria-hidden="true"></i> Veuillez sélectionner la zone d'accès du stade.</p>
        <select class="form-control" onchange="accesfct(this)" name="maselec1" value="" id="selec1">
          <option value="init">Sélectionnez un accés</option>
          <?php 
          for ($i = "A"; $i <= "J"; $i++) {
           echo '<option value="'.$i.'">'.$i.'</option>';
         }
         ?>
       </select>
     </div>


     <div class="col-xs-4 rang">
       <label class="labelcol" for="selec2"><i class="fa fa-list" aria-hidden="true"></i> Rang: </label>
       <p class="info"><i class="fa fa-question-circle" aria-hidden="true"></i> Veuillez sélectionner le rang d'accès du stade.</p>
       <select class="form-control" value="" name="maselec2" onchange="rangfct(this,0)" id="selec2">
         <option value="init">Sélectionnez un rang</option>
         <?php for ($i = 0; $i <= 20; $i++) {
          echo '<option id="rang'.$i.'">'.($i+1).'</option>';
        }
        ?>
      </select>
    </div>

    <div class="col-xs-4 place">    
     <label class="labelcol" for="selec3"><i class="fa fa-list" aria-hidden="true"></i> Place:  </label>
     <p class="info"><i class="fa fa-question-circle" aria-hidden="true"></i> Veuillez sélectionner le numéro de place souhaité dans le stade.</p>
     <select class="form-control" value="" name="maselec3" id="selec3" onchange="validselect(this)">
       <option value="init">Sélectionnez une place</option>
       <?php for ($i = 0; $i <= 20; $i++) {
        echo '<option id="place'.$i.'">'.$i.'</option>';
      }
      ?>
    </select>
  </div>

</div>
</div>

<div class="col-xs-offset-2 col-xs-8 text-center">
<input type="submit" class="btn btn-default" id="env" name="envoie" value="Envoyer"/>
</div>

</div>
</div>

</form>

</div>

<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="fa fa-exclamation-circle fa-1x" aria-hidden="true"></i> Erreur dans l'inscription</h4>
            </div>
            <div class="modal-body">
                <p>Certains champs n'ont pas été rempli correctement</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-error" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

</body>

<?php

$util=array();

$dateactuelle= new Datetime();
$dateactuelle->format('Y-m-d H:i:s');

function validateDate($date, $format = 'Y-m-d')
{
  $d = DateTime::createFromFormat($format, $date);
  return $d && $d->format($format) == $date;
}


if (isset($_POST['envoie']) && $_POST['envoie']=='Envoyer'){



  $lacces= $_POST['maselec1'];
  $lerang= $_POST['maselec2'];
  $laplace= $_POST['maselec3'];
  $larencontre=$_POST['monaffichematch'];
  $lequipeadv=$_POST['maListeClub'];



  foreach($_POST['utilisateur'] as $valeur){
    $util[]=$valeur;
  }

  list($lecivil,$lenom,$leprenom,$lecp,$laville,$ladresse,$lanaissance,$lemail)=$util;

  $lecp = (int)$lecp;
  $laplace= (int)$laplace;
  $lerang= (int)$lerang;


// Vérifier qu'une place n'ait pas été déja réservée par un client !


  $stmt2 = $bdd->prepare('SELECT acces, rang, place, equipeadv FROM utilisateur WHERE acces = :acces AND rang = :rang AND place = :place AND equipeadv = :equipeadv LIMIT 1');

  $stmt2->bindValue(':acces', $lacces, PDO::PARAM_STR);
  $stmt2->bindValue(':rang', $lerang, PDO::PARAM_INT);
  $stmt2->bindValue(':place', $laplace, PDO::PARAM_INT);
  $stmt2->bindValue(':equipeadv', $lequipeadv, PDO::PARAM_STR);

  $stmt2->execute();
  $result = $stmt2->fetch(); 

  if (isset($result) && $result!=false) 
  {
    ?>


    <div id="myModal2" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="fa fa-exclamation-circle fa-1x" aria-hidden="true"></i> Erreur dans l'inscription</h4>
            </div>
            <div class="modal-body">
                <p>La place <?php echo $laplace; ?> pour le match Sochaux / <?php echo $lequipeadv; ?> a déjà été commandée par un client !</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-error" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>



    <?php

  }
    else if( is_string($lecivil) 
    && is_string($lenom) && strlen($lenom)>=2 && strlen($lenom)<26
    && is_string($leprenom) && strlen($leprenom)>=2 && strlen($leprenom)<26
    && is_string($laville) && strlen($laville)>=2 && strlen($laville)<26
    && is_string($ladresse) && strlen($ladresse)>=4 && strlen($ladresse)<30
    && is_string($lemail) && strlen($lemail)>=4 && strlen($lemail)<30
    && is_string($lequipeadv) && strlen($lequipeadv)>=4 && strlen($lequipeadv)<16
    && is_string($lacces) && strlen($lacces)==1 
    && is_int($lerang) && strlen($lerang)<4 && $lerang>=1 && $lerang<=201
    && is_int($laplace) && strlen($laplace)<5 && $laplace>=0 && $laplace<=2620
    && is_string($lecp) && strlen($lecp)<7 && strlen($lecp)>4
    && validateDate($lanaissance) && strlen($lanaissance) == 10
    && validateDate($larencontre) && strlen($larencontre) == 10)
   {

       $stmt = $bdd->prepare('INSERT INTO utilisateur(civilite, nom, prenom, cp, ville, adresse, naissance, mail, inscription, acces, rang, place, equipeadv, rencontre, validation) VALUES(:civilite,:nom,:prenom,:cp,:ville,:adresse,:naissance,:mail,:inscription,:acces,:rang,:place,:equipeadv,:rencontre,:validation)');

     $stmt->bindValue('civilite', $lecivil, PDO::PARAM_STR);
     $stmt->bindValue('nom', $lenom, PDO::PARAM_STR);
     $stmt->bindValue('prenom', $leprenom, PDO::PARAM_STR);
     $stmt->bindValue('cp', $lecp, PDO::PARAM_STR);
     $stmt->bindValue('ville', $laville, PDO::PARAM_STR);
     $stmt->bindValue('adresse', $ladresse, PDO::PARAM_STR);
     $stmt->bindValue('naissance',$lanaissance, PDO::PARAM_STR);
     $stmt->bindValue('mail', $lemail, PDO::PARAM_STR);
     $stmt->bindValue('inscription',$dateactuelle->format(MYSQL_DATETIME_FORMAT)); 

     $stmt->bindValue('acces', $lacces, PDO::PARAM_STR); 
     $stmt->bindValue('rang', $lerang, PDO::PARAM_INT); 
     $stmt->bindValue('place', $laplace, PDO::PARAM_INT); 
     $stmt->bindValue('equipeadv', $lequipeadv, PDO::PARAM_STR); 
     $stmt->bindValue('rencontre', $larencontre, PDO::PARAM_STR); 
     $stmt->bindValue('validation', 0, PDO::PARAM_INT); 


     $stmt->execute();

   }

}

?>


<script type="text/javascript">

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

 var filtre=/^(2[ab]|0[1-9]|[1-9][0-9])[0-9]{3}$/;

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


</script>


<style type="text/css">

.modal-content
{
background-color: #102B64;
color: #EABB0E;
}

.btn-error
{
background-color: #EABB0E;
color: #102B64;
}

.btn-error:hover
{
background-color: #102B64;
color: #EABB0E;
}

 .divform, .divmatch
 {
   padding: 2% 2% 2% 2%;
   background-color: #102B64;
   border-style: solid;
   border-width: 5px 5px 5px 5px;
   border-color: #EABB0E;
   border-radius: 10px;
   font-size: 14px;
   font-family: 'Yanone Kaffeesatz', sans-serif;
 }

.titrediv
{
   padding: 2% 2% 2% 2%;
   background-color: #102B64;
   border-style: solid;
   border-width: 5px 5px 5px 5px;
   border-color: #EABB0E;
   color: white;
   border-radius: 10px;
   font-family: 'Yanone Kaffeesatz', sans-serif;
   margin-bottom: 2%;
}

 #partenaires
 {
width: 100%;
height: 100%;
 }

 .divradio
 {
 background-color:#EABB0E;
 border-radius: 10px;
 color: #102B64;
 padding-top: 1%;
 }

 .divmatch
 {
  margin-top: 2%;
 }

.info
{
display: none;
}

#env
{
margin-top: 3%;
border-radius: 50%;
background: url("./logos_equipes/sticker.png");
color: #102B64;
font-weight: bold;
font-size: 16px;
background-size: 5em 5em;
width: 5em;
height: 5em;

}


.divnom:hover > .info,
.divprenom:hover > .info,
.divadresse:hover > .info,
.divville:hover > .info,
.divradio:hover > .info,
.divnaissance:hover > .info,
.divcp:hover > .info,
.divmail:hover > .info,
.equipeext:hover >.info,
.rang:hover > .info,
.acces:hover > .info,
.place:hover > .info
{
 display: inline;
 position: absolute;
 background-color: #FDFABD;
 border-radius: 10px;
 padding: 2px 2px 2px 2px;
 margin-left: 1%;
 font-size: 14px;
}

.divacces
{
margin-top: 18px;
display: none;
}


#alert
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
  background-color: #EABB0E;
  padding: 1% 1% 1% 1%;
  color :#102B64;
}

.duelmatch
{
  border-radius: 10px;
  background-color: white; 
}

#ballon
{
width: 50%;
height: 50%;
}

#comtois
{
padding-top: 10%;
width:80%; 
height:80%;
}

.labelcol
{
color: white;
}



input[type="radio"] {
    background-color: #102B64;
    border-radius: 10px;
    box-shadow: inset 0 1px 1px hsla(0,0%,100%,.8),
                0 0 0 1px hsla(0,0%,0%,.6),
                0 2px 3px hsla(0,0%,0%,.6),
                0 4px 3px hsla(0,0%,0%,.4),
                0 6px 6px hsla(0,0%,0%,.2),
                0 10px 6px hsla(0,0%,0%,.2);
    cursor: pointer;
    height: 15px;
    width: 15px;
    -webkit-appearance: none;
}
input[type="radio"]:after {
    background-color: #EABB0E;
    border-radius: 25px;
    box-shadow: inset 0 0 0 1px hsla(0,0%,0%,.4),
                0 1px 1px hsla(0,0%,100%,.8);
    content: '';
    display: block;
    height: 7px;
    left: 4px;
    position: relative;
    top: 4px;
    width: 7px;
}
input[type="radio"]:checked:after {
    background-color: white;
    box-shadow: inset 0 0 0 1px hsla(0,0%,0%,.4),
                inset 0 2px 2px hsla(0,0%,100%,.4),
                0 1px 1px hsla(0,0%,100%,.8),
                0 0 2px 2px hsla(0,70%,70%,.4);
}

@media only screen and (min-width: 0px) and (max-width: 768px) {

 .divform, .divmatch
 {
  font-size: 14px;
 }

.divaffichmatch,.duelmatch
  {
  margin-top: 1%;
  margin-bottom: 1%;
  }

.imgequ
{
  width:2em;
  height:2em;

}

#cross
{
  width:1.4em; 
  height:1.4em;
  margin-top: 20%;
}


} 

@media only screen and (min-width: 768px) and (max-width: 991px) {

 .divform, .divmatch, .info
 {
  font-size: 16px;
 }

.divaffichmatch,.duelmatch
  {
  margin-top: 1%;
  margin-bottom: 1%;
  }

.imgequ
{
  width:3.7em;
  height:3.7em;

}

#cross
{
  width:1.8em; 
  height:1.8em;
  margin-top: 20%;
}


}

@media only screen and (min-width: 992px) {

 .divform, .divmatch, .info
 {
  font-size: 18px;
 }

  .duelmatch
  {
    padding: 1% 1% 1% 1%;
  }
  .imgequ
{
  width:4em;
  height:4em;

}

#cross
{
  width:2em; 
  height:2em;
  margin-top: 70%;
}


}

</style>

</html>


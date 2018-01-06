
<!DOCTYPE html>
<html>
<head>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <meta name="viewport" content="width=device-width, user-scalable=no">

<link href="https://fonts.googleapis.com/css?family=Yanone+Kaffeesatz" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="./css/cssform.css">

<script type="text/javascript" src="./ficjs/fichierjs.js"></script>

    <script src="js/modernizr-2.6.2.min.js"></script>
    <!-- FontAwesome -->
    <script src="https://use.fontawesome.com/a40bcd97ad.js"></script>
    <!-- Animate.css -->
    <link rel="stylesheet" href="css/animate.css">
    <!-- Style.css -->
    <link rel="stylesheet" href="css/style.css">

</head>

  <section class="background">

  <?php require "./utilisateur.php"; ?>

  <?php include_once('header.php'); ?>

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

    <form  method="post" action="projetweb/index.php?page=inscription" name="formulaire" onsubmit="return traitementform()">

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
           <select id="ListeClub" name="utilisateur[listeclub]" onchange="matchfct(this)" class="form-control" value=''>
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

            $fichier = fopen('ficjs/fichier.json', 'w+');
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

            $fichier2 = fopen('ficjs/fichier2.json','w+');
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

            <div class="col-xs-6 col-md-5">
              <label for="monaffichematch">Prochain match :</label>
              <input readonly class="form-control" type="date" id="affichematch" name="utilisateur[affichematch]" value="" />
            </div>

          </div>




        </div>

      </div>

      <div class="col-xs-12 divacces" id="acc">
      <div class="row">

      <div class="col-xs-4 acces">

        <label class="labelcol" for="selec1"><i class="fa fa-list" aria-hidden="true"></i> Accés : </label>
        <p class="info"><i class="fa fa-question-circle" aria-hidden="true"></i> Veuillez sélectionner la zone d'accès du stade.</p>
        <select class="form-control" onchange="accesfct(this)" name="utilisateur[acces]" value="" id="selec1">
          <option value="init">Sélectionnez un accés</option>
          <?php 
          for ($i = "A"; $i <= "J"; $i++) {
           echo '<option value="'.$i.'">'.$i.'</option>';
         }
         ?>
       </select>
     </div>


     <div class="col-xs-4 rang">
       <label class="labelcol" for="selec2"><i class="fa fa-list" aria-hidden="true"></i> Rang : </label>
       <p class="info"><i class="fa fa-question-circle" aria-hidden="true"></i> Veuillez sélectionner le rang d'accès du stade.</p>
       <select class="form-control" value="" name="utilisateur[rang]" onchange="rangfct(this,0)" id="selec2">
         <option value="init">Sélectionnez un rang</option>
         <?php for ($i = 0; $i <= 20; $i++) {
          echo '<option id="rang'.$i.'">'.($i+1).'</option>';
        }
        ?>
      </select>
    </div>

    <div class="col-xs-4 place">    
     <label class="labelcol" for="selec3"><i class="fa fa-list" aria-hidden="true"></i> Place :  </label>
     <p class="info"><i class="fa fa-question-circle" aria-hidden="true"></i> Veuillez sélectionner le numéro de place souhaité dans le stade.</p>
     <select class="form-control" value="" name="utilisateur[place]" id="selec3" onchange="validselect(this)">
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

<?php


$util=array();

$dateactuelle= new Datetime();
$dateactuelle->format('Y-m-d H:i:s');

function validateDate($date, $format = 'Y-m-d')
{
  $d = DateTime::createFromFormat($format, $date);
  return $d && $d->format($format) == $date;
}

if (isset($_POST['envoie'])){

  foreach($_POST['utilisateur'] as $key => $valeur){
    $util[$key]=$valeur;
  }

$util['id']=0;
$util['validation']=0;
$util['inscription']=$dateactuelle;
 
   $utilisateur = new User( $util['civil'], $util['nom'], $util['prenom'], $util['cp'], $util['ville'], $util['adresse'], $util['naissance'], $util['mail'], $util['inscription'], $util['acces'], $util['rang'], $util['place'], $util['listeclub'], $util['affichematch'], $util['validation'], $util['id']);


// Vérifier qu'une place n'ait pas été déja réservée par un client !

  $stmt2 = $bdd->prepare('SELECT acces, rang, place, equipeadv FROM utilisateur WHERE acces = :acces AND rang = :rang AND place = :place AND equipeadv = :equipeadv LIMIT 1');

  $stmt2->bindValue(':acces', $utilisateur->getAcces(), PDO::PARAM_STR);
  $stmt2->bindValue(':rang', $utilisateur->getRang(), PDO::PARAM_INT);
  $stmt2->bindValue(':place', $utilisateur->getPlace(), PDO::PARAM_INT);
  $stmt2->bindValue(':equipeadv', $utilisateur->getEquipeadv(), PDO::PARAM_STR);

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

    else
   {

       $stmt = $bdd->prepare('INSERT INTO utilisateur(civilite, nom, prenom, cp, ville, adresse, naissance, mail, inscription, acces, rang, place, equipeadv, rencontre, validation) VALUES(:civilite,:nom,:prenom,:cp,:ville,:adresse,:naissance,:mail,:inscription,:acces,:rang,:place,:equipeadv,:rencontre,:validation)');

     $stmt->bindValue('civilite', $utilisateur->getCivilite(), PDO::PARAM_STR);
     $stmt->bindValue('nom', $utilisateur->getNom(), PDO::PARAM_STR);
     $stmt->bindValue('prenom', $utilisateur->getPrenom(), PDO::PARAM_STR);
     $stmt->bindValue('cp', $utilisateur->getCp(), PDO::PARAM_STR);
     $stmt->bindValue('ville', $utilisateur->getVille(), PDO::PARAM_STR);
     $stmt->bindValue('adresse', $utilisateur->getAdresse(), PDO::PARAM_STR);
     $stmt->bindValue('naissance',$utilisateur->getNaissance(), PDO::PARAM_STR);
     $stmt->bindValue('mail', $utilisateur->getMail(), PDO::PARAM_STR);
     $stmt->bindValue('inscription',$utilisateur->getInscription()->format(MYSQL_DATETIME_FORMAT)); 

     $stmt->bindValue('acces', $utilisateur->getAcces(), PDO::PARAM_STR); 
     $stmt->bindValue('rang', $utilisateur->getRang(), PDO::PARAM_INT); 
     $stmt->bindValue('place', $utilisateur->getPlace(), PDO::PARAM_INT); 
     $stmt->bindValue('equipeadv', $utilisateur->getEquipeadv(), PDO::PARAM_STR); 
     $stmt->bindValue('rencontre', $utilisateur->getRencontre(), PDO::PARAM_STR); 
     $stmt->bindValue('validation', $utilisateur->getValidation(), PDO::PARAM_INT); 

     $stmt->execute();

   }

}

?>

</body>

<?php include_once('footer.php'); ?>

</section>

</html>


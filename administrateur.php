<?php 

session_start(); 

const MDP_ADMIN = "azerta";
const LOGIN_ADMIN = "Vincent";
$valid=0;
?>

<!DOCTYPE html>

<html>

<head>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Yanone+Kaffeesatz" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="./fichiercss2.css">
  <meta name="viewport" content="width=device-width, user-scalable=no">
</head>

<body>

<div class="container">

<div class="row"> 

  <?php

  require "./utilisateur.php";

  try
  {
    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
    $bdd = new PDO('mysql:host=localhost;dbname=projetevent;charset=utf8', 'root', '', $pdo_options);
  }
  catch (Exception $e)
  {
    die('Erreur : ' . $e->getMessage());
  }


  if(isset($_POST['adminbtn']) && $_POST['adminlogin'] == LOGIN_ADMIN && $_POST['adminmdp'] == MDP_ADMIN) 
  {

    $_SESSION['login'] = $_POST['adminlogin'];
    $_SESSION['mdp'] = $_POST['adminmdp'];
  }

  else if(!isset($_GET['p']) && !isset($_GET['a']))
  {

    $_SESSION['login'] = null;
    $_SESSION['mdp'] = null;

    ?>
   

       <div class="col-xs-offset-3 col-xs-6 divformadm">

         <form method="POST" action="administrateur.php?p=1" name="formadm">

           <div class="row">

           <div class="col-xs-8">

           <div class="row">

            <div class="form-group col-xs-12">
              <label for="adminlogin" class="col-form-label"> Login de l'administrateur :</label>  
              <input class="form-control"  type="text" placeholder="Ex : MyAdminLogin" id="admlogin" name="adminlogin" value="">             
            </div>

            <div class="form-group col-xs-12">
              <label for="adminmdp" class="col-form-label"> Mot de passe de l'administrateur :</label>
              <input class="form-control" type="password" placeholder="********" id="admmdp" name="adminmdp"> 
            </div>

            </div>
            </div>

            <div class="form-group col-xs-4 text-center" >
              <button type="submit" id="admbtn" name="adminbtn">
              <i class="fa fa-sign-in fa-5x" aria-hidden="true"></i>
              </button>
            </div>

          </div>

        </form>

      </div>

      <?php
    }
    if($_SESSION['login'] == LOGIN_ADMIN && $_SESSION['mdp'] == MDP_ADMIN) 
    {
      if (!isset($_GET['a'])) {

        ?>

        <div class="espaceadm col-xs-12">

          <div class="row">

             <div class="col-xs-2 text-center">
              <img src="logos_equipes/admin.png" id="imgadm">
             </div>

             <div class="col-xs-8 text-center">
               
              <h2>Espace Administrateur</h2>

             </div>

             <div class="col-xs-2 text-center">

              <form method="post" action="administrateur.php" name="formdeco">
              <button type="submit" name="deco" id="sedeco">
              <i class="fa fa-sign-out fa-5x" aria-hidden="true"></i>
              </button>
              </form>

            </div>
          </div>

          

          <div class="col-xs-10 col-xs-offset-1 infoins">

              <p>Bonjour <strong> <?php echo $_SESSION['login']; ?> </strong>, heureux de vous revoir.</p>
              <p>Nous sommes actuellement le <?php echo date('d/m/Y'); ?>. </p>

          
              <?php
              $inscriptions_adm= $bdd-> query('SELECT COUNT(*) from utilisateur');
              $total_insc_adm = $inscriptions_adm->fetch(); 

              $inscriptions_nonval = $bdd-> query('SELECT COUNT(*) from utilisateur WHERE validation = 2');
              $total_nonval_adm = $inscriptions_nonval->fetch();

              $inscriptions_val = $bdd-> query('SELECT COUNT(*) from utilisateur WHERE validation = 1');
              $total_val_adm = $inscriptions_val->fetch();

              $inscriptions_att = $bdd-> query('SELECT COUNT(*) from utilisateur WHERE validation = 0');
              $total_val_att = $inscriptions_att->fetch();
              ?>

             <p>Vous avez <?php echo $total_insc_adm[0]; ?> inscriptions au total.</p>
             <p>Parmis ces inscriptions ... </p>
             <p><span class="label label-default"><?php echo $total_nonval_adm[0]; ?></span> est/sont refusée(s).</p>
             <p><span class="label label-default"><?php echo $total_val_adm[0]; ?></span> est/sont validée(s).</p>
             <p><span class="label label-default"><?php echo $total_val_att[0]; ?></span> est/sont en attente de validation.</p>

              <?php
              $nbrArt=$total_insc_adm[0];
              $perPage=4;
              $nbrpages= ceil($nbrArt/$perPage);

              if (isset($_GET['p']) && $_GET['p']>0 && $_GET['p']<=$nbrpages) {
                $pageActu=$_GET['p'];
              }else{
               $pageActu=1;
             }

             $pagesuiv=$pageActu+1;
             $pageprec=$pageActu-1;
             ?>

           </div>

      </div>

      <?php

      if (isset($_POST['deco'])) 
      {
        $_SESSION = array();
        session_destroy();
        header("Location: http://localhost/projetweb/administrateur.php");
      }

      ?>


      <div class="pagin col-xs-12">

      <div class="row">

      <div class="col-xs-8 col-xs-offset-2 text-center">
      <h2> Annuaire des inscriptions</h2> 
      </div>

      <div class="col-xs-1 col-xs-offset-1">
      <h3> Page : <?php echo $_GET['p']; ?></h3> 
      </div>

      <?php

      $sql= "SELECT * FROM utilisateur ORDER BY inscription LIMIT ".(($pageActu-1)*$perPage).",".$perPage."";
      $mespages = $bdd->query($sql);
      $affichpages = $mespages->fetchAll();

      foreach ($affichpages as $affichles) 
      {

        $utilisateur = new User( $affichles['civilite'], $affichles['nom'], $affichles['prenom'], $affichles['cp'], $affichles['ville'], $affichles['adresse'], $affichles['naissance'], $affichles['mail'], $affichles['inscription'], $affichles['acces'], $affichles['rang'], $affichles['place'], $affichles['equipeadv'], $affichles['rencontre'], $affichles['validation'], $affichles['id']);

        ?>

        <div class="col-xs-6 grpins">

         <div class="row">

         <div class="col-xs-10 col-xs-offset-1 panel panel-default panins">

          <div class="row">

            <div class="panel-body col-xs-8 col-xs-offset-2 text-center">

            <div class="titleins">
              <a href= <?php echo "administrateur.php?a=".$utilisateur->getId()."" ?> > <?php echo "<h2> Inscription N° ".$affichles['id']."</h2>"; ?></a>
            </div>

            </div>

            <div class="panel-footer">
              <table class="table">
               <tr><th scope="row"> Inscription :</th> <td><?php echo $utilisateur->getInscription()?></td></tr>
               <tr><th scope="row"> Civilité :</th> <td><?php echo $utilisateur->getCivilite()?></td></tr>
               <tr><th scope="row"> Nom :</th> <td><?php echo $utilisateur->getNom() ?></td></tr>
               <tr><th scope="row"> Prénom :</th> <td><?php echo $utilisateur->getPrenom() ?></td></tr>
               <tr><th scope="row"> Code Postal :</th> <td><?php echo $utilisateur->getCp() ?></td></tr>
               <tr><th scope="row"> Ville :</th> <td><?php echo $utilisateur->getVille() ?></td></tr>
               <tr><th scope="row"> Adresse :</th> <td><?php echo $utilisateur->getAdresse() ?></td></tr>
               <tr><th scope="row"> Naissance :</th> <td><?php echo $utilisateur->getNaissance() ?></td></tr>
               <tr><th scope="row"> Mail :</th> <td><?php echo $utilisateur->getMail() ?></td></tr>
               <tr><th scope="row"> Accés :</th> <td><?php echo $utilisateur->getAcces() ?></td></tr>
               <tr><th scope="row"> Rang :</th> <td><?php echo $utilisateur->getRang() ?></td></tr>
               <tr><th scope="row"> Place :</th> <td><?php echo $utilisateur->getPlace() ?></td></tr>
               <tr><th scope="row"> Equipe adverse :</th> <td><?php echo $utilisateur->getEquipeadv() ?></td></tr>
               <tr><th scope="row"> Rencontre :</th> <td><?php echo $utilisateur->getRencontre() ?></td></tr>
               <tr><th scope="row"> Validation :</th> <td><?php echo $utilisateur->getValidation() ?></td></tr>
             </table>
           </div>
         </div>
       </div>
       </div>

       </div>




       <?php

     }


     ?>

     <div class="col-xs-12 text-center">
       <nav aria-label="Page navigation">
        <ul class="pagination">
          <li><a href= <?php echo "administrateur.php?p=$pageprec" ?> aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
          <?php
          for ($i=1; $i <$nbrpages+1 ; $i++)
          { 
            echo "<li><a href=\"administrateur.php?p=$i\">$i</a></li>";
          }
          ?>
          <li><a href=<?php echo "administrateur.php?p=$pagesuiv" ?> aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
        </ul>
      </nav>
    </div>

    </div>
    </div>

    <?php
  }


  elseif (isset($_GET['a'])) 
  {
    $annonceselec=$_GET['a'];

    $sql= "SELECT * FROM utilisateur WHERE id=".$annonceselec." LIMIT 1";
    $monannonce = $bdd->query($sql);
    $afficheannonce = $monannonce->fetch();

    $utilisateur2 = new User( $afficheannonce['civilite'], $afficheannonce['nom'], $afficheannonce['prenom'], $afficheannonce['cp'], $afficheannonce['ville'], $afficheannonce['adresse'], $afficheannonce['naissance'], $afficheannonce['mail'], $afficheannonce['inscription'], $afficheannonce['acces'], $afficheannonce['rang'], $afficheannonce['place'], $afficheannonce['equipeadv'], $afficheannonce['rencontre'], $afficheannonce['validation'], $afficheannonce['id']);

    ?>

    

      <div class="col-xs-8 col-xs-offset-2 annonce">

       <form method="post" action=<?php echo "administrateur.php?a=".$utilisateur2->getId()."" ?> name="annoncegestion">

        <div class="row">

          <div class="col-xs-12">
            <ul class="list-group">

            <div class="raw">

             <div class="col-xs-12 text-center">
             <li class="list-group-item">
             <h4 id="titleannonce"><strong> Numéro d'inscription : <?php  echo $utilisateur2->getId() ?> </strong></h4>
             </li>
             </div>

             <div class="col-xs-4">
             <li class="list-group-item">
             <label> Inscription : </label>
             <input class="form-control" type="textarea" name="upd[inscription]" value="<?php if(isset($_POST['upd']['inscription'])){ echo $_POST['upd']['inscription']; }else{ echo $utilisateur2->getInscription(); } ?>">
             </li>
             </div>

             <div class="col-xs-4">
             <li class="list-group-item">
             <label> Civilité : </label>
             <input class="form-control" type="text" name="upd[civilite]" value="<?php if(isset($_POST['upd']['civilite]'])){ echo $_POST['upd']['civilite']; }else{ echo $utilisateur2->getCivilite(); } ?>">
             </li>
             </div>             

             <div class="col-xs-4">
             <li class="list-group-item">
             <label> Nom : </label>
             <input class="form-control" type="text" name="upd[nom]" value="<?php if(isset($_POST['upd']['nom'])){ echo $_POST['upd']['nom']; }else{ echo $utilisateur2->getNom(); } ?>">
             </li>
             </div>

             <div class="col-xs-4">
             <li class="list-group-item">
             <label> Prénom : </label>
             <input class="form-control" type="text" name="upd[prenom]" value="<?php if(isset($_POST['upd']['prenom'])){ echo $_POST['upd']['prenom']; }else{ echo $utilisateur2->getPrenom(); } ?>">
             </li>
             </div>

             <div class="col-xs-4">
             <li class="list-group-item">
             <label> Code Postal : </label>
             <input class="form-control" type="text" name="upd[cp]" value="<?php if(isset($_POST['upd']['cp'])){ echo $_POST['upd']['cp']; }else{ echo $utilisateur2->getCp(); } ?>">
             </li>
             </div>

             <div class="col-xs-4">
             <li class="list-group-item">
             <label> Ville : </label>
             <input class="form-control" type="text" name="upd[ville]" value="<?php if(isset($_POST['upd']['ville'])){ echo $_POST['upd']['ville']; }else{ echo $utilisateur2->getVille(); } ?>">
             </li>
             </div>

             <div class="col-xs-4">
             <li class="list-group-item">
             <label> Adresse : </label>
             <input class="form-control" type="text" name="upd[adresse]" value="<?php if(isset($_POST['upd']['adresse'])){ echo $_POST['upd']['adresse']; }else{ echo $utilisateur2->getAdresse(); }  ?>">
             </li>
             </div>

             <div class="col-xs-4">
             <li class="list-group-item">
             <label> Naissance : </label>
             <input class="form-control" type="text" name="upd[naissance]" value="<?php if(isset($_POST['upd']['naissance'])){ echo $_POST['upd']['naissance']; }else{ echo $utilisateur2->getNaissance(); } ?>">
             </li>
             </div>

             <div class="col-xs-4">
             <li class="list-group-item">
             <label> Mail : </label>
             <input class="form-control" type="text" name="upd[mail]" value="<?php if(isset($_POST['upd']['mail'])){ echo $_POST['upd']['mail']; }else{ echo $utilisateur2->getMail(); } ?>">
             </li>
             </div>

             <div class="col-xs-4">
             <li class="list-group-item">
             <label> Accés : </label>
             <input class="form-control" type="text" name="upd[acces]" value="<?php if(isset($_POST['upd']['acces'])){ echo $_POST['upd']['acces']; }else{ echo $utilisateur2->getAcces(); } ?>">
             </li>
             </div>

             <div class="col-xs-4">
             <li class="list-group-item">
             <label> Rang : </label>
             <input class="form-control" type="text" name="upd[rang]" value="<?php if(isset($_POST['upd']['rang'])){ echo $_POST['upd']['rang']; }else{ echo $utilisateur2->getRang(); } ?>">
             </li>
             </div>

             <div class="col-xs-4">
             <li class="list-group-item">
             <label> Place : </label>
             <input class="form-control" type="text" name="upd[place]" value="<?php if(isset($_POST['upd']['place'])){ echo $_POST['upd']['place']; }else{ echo $utilisateur2->getPlace(); } ?>">
             </li>
             </div>

             <div class="col-xs-4">
             <li class="list-group-item">
             <label> Equipe adverse : </label>
             <input class="form-control" type="text" name="upd[equipeadv]" value="<?php if(isset($_POST['upd']['equipeadv'])){ echo $_POST['upd']['equipeadv']; }else{echo $utilisateur2->getEquipeadv(); } ?>">
             </li>
             </div>

             <div class="col-xs-4">
             <li class="list-group-item">
             <label> Rencontre : </label>
             <input class="form-control" type="text" name="upd[rencontre]" value="<?php if(isset($_POST['upd']['rencontre'])){ echo $_POST['upd']['rencontre']; }else{ echo $utilisateur2->getRencontre(); } ?>">
             </li>
             </div>

             <div class="col-xs-4">
             <li class="list-group-item">
             <label> Validation : </label>
             <input class="form-control" type="text" name="upd[validation]" value="<?php if(isset($_POST['upd']['validation'])){ echo $_POST['upd']['validation']; }else{ echo $utilisateur2->getValidation(); }?>">
             </li>
             </div>

            </div>

           </ul>
         </div>
        
         <div class="col-xs-12 btn-group btn-group-justified" role="group">

         <div class="btn-group" role="group">
          <button class="btn btn-default" type="submit" name="modifins">
          Modifier
          </button>
         </div>

          <div class="btn-group" role="group">
          <button class="btn btn-default" type="submit" name="supins">
          Supprimer
          </button>
          </div>

        </div>

      </div>
     </form>
    </div>

    <div class="col-xs-2 text-center">
    <button type="button" id="exit" onclick="document.location.href='http://localhost/projetweb/administrateur.php?p=1'">
     <i class="fa fa-chevron-circle-left fa-4x" aria-hidden="true"></i>
    </button>
    </div>


  <?php 

  if (isset($_POST['modifins'])) 
  {

$util = array();

foreach ($_POST['upd'] as $key=>$updates) 
{
$util[$key]=$updates;
}

    $utilisateur3 = new User( $util['civilite'], $util['nom'], $util['prenom'], $util['cp'], $util['ville'], $util['adresse'], $util['naissance'], $util['mail'], $util['inscription'], $util['acces'], $util['rang'], $util['place'], $util['equipeadv'], $util['rencontre'], $util['validation'], $annonceselec);

    $stmtann = $bdd->prepare('UPDATE utilisateur SET civilite = :civilite, nom = :nom, prenom = :prenom, cp = :cp, ville = :ville, adresse = :adresse, naissance = :naissance, mail = :mail, inscription = :inscription, acces = :acces, rang = :rang, place = :place, equipeadv = :equipeadv, rencontre = :rencontre, validation = :validation WHERE id = :id');

     $stmtann->bindValue('civilite', $utilisateur3->getCivilite(), PDO::PARAM_STR);
     $stmtann->bindValue('nom', $utilisateur3->getNom(), PDO::PARAM_STR);
     $stmtann->bindValue('prenom', $utilisateur3->getPrenom(), PDO::PARAM_STR);

     $stmtann->bindValue('cp', $utilisateur3->getCp(), PDO::PARAM_STR);
     $stmtann->bindValue('ville', $utilisateur3->getVille(), PDO::PARAM_STR);
     $stmtann->bindValue('adresse', $utilisateur3->getAdresse(), PDO::PARAM_STR);

     $stmtann->bindValue('naissance', $utilisateur3->getNaissance(), PDO::PARAM_STR);
     $stmtann->bindValue('mail', $utilisateur3->getMail(), PDO::PARAM_STR);
     $stmtann->bindValue('inscription',$utilisateur3->getInscription(), PDO::PARAM_STR); 

     $stmtann->bindValue('acces', $utilisateur3->getAcces(), PDO::PARAM_STR); 
     $stmtann->bindValue('rang', $utilisateur3->getRang(), PDO::PARAM_INT); 
     $stmtann->bindValue('place', $utilisateur3->getPlace(), PDO::PARAM_INT); 

     $stmtann->bindValue('equipeadv', $utilisateur3->getEquipeadv(), PDO::PARAM_STR); 
     $stmtann->bindValue('rencontre', $utilisateur3->getRencontre(), PDO::PARAM_STR); 
     $stmtann->bindValue('validation', $utilisateur3->getValidation(), PDO::PARAM_INT); 

     $stmtann->bindValue('id', $utilisateur3->getId(), PDO::PARAM_INT); 

     $stmtann->execute();

     ?>

    <div class="col-xs-12 text-center alertmss">
    <p><i class="fa fa-info fa-2x" aria-hidden="true"></i> Opération de modification effectué avec succès </p>
    <p>Vous avez changé :</p>
    <?php  

    if ($utilisateur3->getCivilite() != $utilisateur2->getCivilite()) {
    echo '<p><i class="fa fa-wrench" aria-hidden="true"></i> La civilité : '.$utilisateur2->getCivilite().' <i class="fa fa-long-arrow-right" aria-hidden="true"></i> '.$utilisateur3->getCivilite().'</p>';
    }

        if ($utilisateur3->getNom() != $utilisateur2->getNom()) {
    echo '<p><i class="fa fa-wrench" aria-hidden="true"></i> Le nom : '.$utilisateur2->getNom().' <i class="fa fa-long-arrow-right" aria-hidden="true"></i> '.$utilisateur3->getNom().'</p>';
    }

        if ($utilisateur3->getPrenom() != $utilisateur2->getPrenom()) {
    echo '<p><i class="fa fa-wrench" aria-hidden="true"></i> Le prénom : '.$utilisateur2->getPrenom().' <i class="fa fa-long-arrow-right" aria-hidden="true"></i> '.$utilisateur3->getPrenom().'</p>';
    }

        if ($utilisateur3->getCp() != $utilisateur2->getCp()) {
    echo '<p><i class="fa fa-wrench" aria-hidden="true"></i> Le Code Postal : '.$utilisateur2->getCp().' <i class="fa fa-long-arrow-right" aria-hidden="true"></i> '.$utilisateur3->getCp().'</p>';
    }

        if ($utilisateur3->getAdresse() != $utilisateur2->getAdresse()) {
    echo '<p><i class="fa fa-wrench" aria-hidden="true"></i> L\'adresse : '.$utilisateur2->getAdresse().' <i class="fa fa-long-arrow-right" aria-hidden="true"></i> '.$utilisateur3->getAdresse().'</p>';
    }

            if ($utilisateur3->getNaissance() != $utilisateur2->getNaissance()) {
    echo '<p><i class="fa fa-wrench" aria-hidden="true"></i> La naissance : '.$utilisateur2->getNaissance().' <i class="fa fa-long-arrow-right" aria-hidden="true"></i> '.$utilisateur3->getNaissance().'</p>';
    }

                if ($utilisateur3->getMail() != $utilisateur2->getMail()) {
    echo '<p><i class="fa fa-wrench" aria-hidden="true"></i> Le mail : '.$utilisateur2->getMail().' <i class="fa fa-long-arrow-right" aria-hidden="true"></i> '.$utilisateur3->getMail().'</p>';
    }

                if ($utilisateur3->getInscription() != $utilisateur2->getInscription()) {
    echo '<p><i class="fa fa-wrench" aria-hidden="true"></i> La naissance : '.$utilisateur2->getInscription().' <i class="fa fa-long-arrow-right" aria-hidden="true"></i> '.$utilisateur3->getInscription().'</p>';
    }

                    if ($utilisateur3->getAcces() != $utilisateur2->getAcces()) {
    echo '<p><i class="fa fa-wrench" aria-hidden="true"></i> L\'accés : '.$utilisateur2->getAcces().' <i class="fa fa-long-arrow-right" aria-hidden="true"></i> '.$utilisateur3->getAcces().'</p>';
    }

                    if ($utilisateur3->getRang() != $utilisateur2->getRang()) {
    echo '<p><i class="fa fa-wrench" aria-hidden="true"></i> Le rang : '.$utilisateur2->getRang().' <i class="fa fa-long-arrow-right" aria-hidden="true"></i> '.$utilisateur3->getRang().'</p>';
    }

                if ($utilisateur3->getPlace() != $utilisateur2->getPlace()) {
    echo '<p><i class="fa fa-wrench" aria-hidden="true"></i> La place : '.$utilisateur2->getPlace().' <i class="fa fa-long-arrow-right" aria-hidden="true"></i> '.$utilisateur3->getPlace().'</p>';
    }

                if ($utilisateur3->getEquipeadv() != $utilisateur2->getEquipeadv()) {
    echo '<p><i class="fa fa-wrench" aria-hidden="true"></i> L\'équipe adverse : '.$utilisateur2->getEquipeadv().' <i class="fa fa-long-arrow-right" aria-hidden="true"></i> '.$utilisateur3->getEquipeadv().'</p>';
    }

                    if ($utilisateur3->getRencontre() != $utilisateur2->getRencontre()) {
    echo '<p><i class="fa fa-wrench" aria-hidden="true"></i> La rencontre : '.$utilisateur2->getRencontre().' <i class="fa fa-long-arrow-right" aria-hidden="true"></i> '.$utilisateur3->getRencontre().'</p>';
    }


                    if ($utilisateur3->getValidation() != $utilisateur2->getValidation()) {
    echo '<p><i class="fa fa-wrench" aria-hidden="true"></i> La validation : '.$utilisateur2->getValidation().' <i class="fa fa-long-arrow-right" aria-hidden="true"></i> '.$utilisateur3->getValidation().'</p>';
    }

    ?>
    </div>

     <?php

  }

 elseif (isset($_POST['supins'])) 
 {

  $stmtann2 = $bdd->prepare('DELETE FROM utilisateur WHERE id = :id');
  $stmtann2->bindValue('id', $annonceselec, PDO::PARAM_INT); 
  $stmtann2->execute();

 }


}
}



?>

</div>

</div>

</body>

</html>
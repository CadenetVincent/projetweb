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
  <meta name="viewport" content="width=device-width, user-scalable=no">
</head>

<body>

<div class="container">

<div class="row"> 

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
        ?>

        <div class="col-xs-6 grpins">

         <div class="row">

         <div class="col-xs-10 col-xs-offset-1 panel panel-default panins">

          <div class="row">

            <div class="panel-body col-xs-8 col-xs-offset-2 text-center">

            <div class="titleins">
              <a href= <?php echo "administrateur.php?a=".$affichles['id']."" ?> > <?php echo "<h2> Inscription N° ".$affichles['id']."</h2>"; ?></a>
            </div>

            </div>

            <div class="panel-footer">
              <table class="table">
               <tr><th scope="row"> Inscription :</th> <td><?php echo $affichles['inscription'] ?></td></tr>
               <tr><th scope="row"> Civilité :</th> <td><?php echo $affichles['civilite'] ?></td></tr>
               <tr><th scope="row"> Nom :</th> <td><?php echo $affichles['nom'] ?></td></tr>
               <tr><th scope="row"> Prénom :</th> <td><?php echo $affichles['prenom'] ?></td></tr>
               <tr><th scope="row"> Code Postal :</th> <td><?php echo $affichles['cp'] ?></td></tr>
               <tr><th scope="row"> Ville :</th> <td><?php echo $affichles['ville'] ?></td></tr>
               <tr><th scope="row"> Adresse :</th> <td><?php echo $affichles['adresse'] ?></td></tr>
               <tr><th scope="row"> Naissance :</th> <td><?php echo $affichles['naissance'] ?></td></tr>
               <tr><th scope="row"> Mail :</th> <td><?php echo $affichles['mail'] ?></td></tr>
               <tr><th scope="row"> Accés :</th> <td><?php echo $affichles['acces'] ?></td></tr>
               <tr><th scope="row"> Rang :</th> <td><?php echo $affichles['rang'] ?></td></tr>
               <tr><th scope="row"> Place :</th> <td><?php echo $affichles['place'] ?></td></tr>
               <tr><th scope="row"> Equipe adverse :</th> <td><?php echo $affichles['equipeadv'] ?></td></tr>
               <tr><th scope="row"> Rencontre :</th> <td><?php echo $affichles['rencontre'] ?></td></tr>
               <tr><th scope="row"> Validation :</th> <td><?php echo $affichles['validation'] ?></td></tr>
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

    $sql= "SELECT * FROM utilisateur WHERE id=".$_GET['a']." LIMIT 1";
    $monannonce = $bdd->query($sql);
    $afficheannonce = $monannonce->fetch();


    ?>

    

      <div class="col-xs-8 col-xs-offset-2 annonce">

       <form method="post" action=<?php echo "administrateur.php?a=".$_GET['a']."" ?> name="annoncegestion">

        <div class="row">

          <div class="col-xs-12">
            <ul class="list-group">

            <div class="raw">

             <div class="col-xs-12 text-center">
             <li class="list-group-item">
             <h4 id="titleannonce"><strong> Numéro d'inscription : <?php  echo $afficheannonce['id'] ?> </strong></h4>
             </li>
             </div>

             <div class="col-xs-4">
             <li class="list-group-item">
             <label> Inscription : </label>
             <input class="form-control" type="textarea" name="updinscription" value="<?php echo $afficheannonce['inscription']?>">
             </li>
             </div>

             <div class="col-xs-4">
             <li class="list-group-item">
             <label> Civilité : </label>
             <input class="form-control" type="text" name="updcivilite" value="<?php echo $afficheannonce['civilite']?>">
             </li>
             </div>             

             <div class="col-xs-4">
             <li class="list-group-item">
             <label> Nom : </label>
             <input class="form-control" type="text" name="updnom" value="<?php echo $afficheannonce['nom']?>">
             </li>
             </div>

             <div class="col-xs-4">
             <li class="list-group-item">
             <label> Prénom : </label>
             <input class="form-control" type="text" name="updprenom" value="<?php echo $afficheannonce['prenom']?>">
             </li>
             </div>

             <div class="col-xs-4">
             <li class="list-group-item">
             <label> Code Postal : </label>
             <input class="form-control" type="text" name="updcp" value="<?php echo $afficheannonce['cp']?>">
             </li>
             </div>

             <div class="col-xs-4">
             <li class="list-group-item">
             <label> Ville : </label>
             <input class="form-control" type="text" name="updville" value="<?php echo $afficheannonce['ville']?>">
             </li>
             </div>

             <div class="col-xs-4">
             <li class="list-group-item">
             <label> Adresse : </label>
             <input class="form-control" type="text" name="updadresse" value="<?php echo $afficheannonce['adresse']?>">
             </li>
             </div>

             <div class="col-xs-4">
             <li class="list-group-item">
             <label> Naissance : </label>
             <input class="form-control" type="text" name="updnaissance" value="<?php echo $afficheannonce['naissance']?>">
             </li>
             </div>

             <div class="col-xs-4">
             <li class="list-group-item">
             <label> Mail : </label>
             <input class="form-control" type="text" name="updmail" value="<?php echo $afficheannonce['mail']?>">
             </li>
             </div>

             <div class="col-xs-4">
             <li class="list-group-item">
             <label> Accés : </label>
             <input class="form-control" type="text" name="updacces" value="<?php echo $afficheannonce['acces']?>">
             </li>
             </div>

             <div class="col-xs-4">
             <li class="list-group-item">
             <label> Rang : </label>
             <input class="form-control" type="text" name="updrang" value="<?php echo $afficheannonce['rang']?>">
             </li>
             </div>

             <div class="col-xs-4">
             <li class="list-group-item">
             <label> Place : </label>
             <input class="form-control" type="text" name="updplace" value="<?php echo $afficheannonce['place']?>">
             </li>
             </div>

             <div class="col-xs-4">
             <li class="list-group-item">
             <label> Equipe adverse : </label>
             <input class="form-control" type="text" name="updequipeadv" value="<?php echo $afficheannonce['equipeadv']?>">
             </li>
             </div>

             <div class="col-xs-4">
             <li class="list-group-item">
             <label> Rencontre : </label>
             <input class="form-control" type="text" name="updrencontre" value="<?php echo $afficheannonce['rencontre']?>">
             </li>
             </div>

             <div class="col-xs-4">
             <li class="list-group-item">
             <label> Validation : </label>
             <input class="form-control" type="text" name="updvalidation" value="<?php echo $afficheannonce['validation']?>">
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

    $stmtann = $bdd->prepare('UPDATE utilisateur SET civilite = :civilite, nom = :nom, prenom = :prenom, cp = :cp, ville = :ville, adresse = :adresse, naissance = :naissance, mail = :mail, inscription = :inscription, acces = :acces, rang = :rang, place = :place, equipeadv = :equipeadv, rencontre = :rencontre, validation = :validation WHERE id = :id');

     $stmtann->bindValue('civilite', $_POST['updcivilite'], PDO::PARAM_STR);
     $stmtann->bindValue('nom', $_POST['updnom'], PDO::PARAM_STR);
     $stmtann->bindValue('prenom', $_POST['updprenom'], PDO::PARAM_STR);

     $stmtann->bindValue('cp', $_POST['updcp'], PDO::PARAM_STR);
     $stmtann->bindValue('ville', $_POST['updville'], PDO::PARAM_STR);
     $stmtann->bindValue('adresse', $_POST['updadresse'], PDO::PARAM_STR);

     $stmtann->bindValue('naissance', $_POST['updnaissance'], PDO::PARAM_STR);
     $stmtann->bindValue('mail', $_POST['updmail'], PDO::PARAM_STR);
     $stmtann->bindValue('inscription',$_POST['updinscription'], PDO::PARAM_STR); 

     $stmtann->bindValue('acces', $_POST['updacces'], PDO::PARAM_STR); 
     $stmtann->bindValue('rang', $_POST['updrang'], PDO::PARAM_INT); 
     $stmtann->bindValue('place', $_POST['updplace'], PDO::PARAM_INT); 

     $stmtann->bindValue('equipeadv', $_POST['updequipeadv'], PDO::PARAM_STR); 
     $stmtann->bindValue('rencontre', $_POST['updrencontre'], PDO::PARAM_STR); 
     $stmtann->bindValue('validation', $_POST['updvalidation'], PDO::PARAM_INT); 

     $stmtann->bindValue('id', $_GET['a'], PDO::PARAM_INT); 

     $stmtann->execute();

     ?>

    <div class="col-xs-12 text-center alertmss">
    <p><i class="fa fa-info fa-2x" aria-hidden="true"></i> Opération effectué avec succès </p>
    </div>

     <?php
  }

 elseif (isset($_POST['supins'])) 
 {

  $stmtann2 = $bdd->prepare('DELETE FROM utilisateur WHERE id = :id');
  $stmtann2->bindValue('id', $_GET['a'], PDO::PARAM_INT); 
  $stmtann2->execute();

 }


}
}



?>

</div>


<style type="text/css">

#imgadm
{
width:70%;
height:70%;
}

.divformadm, .espaceadm, .pagin, .annonce
{
   padding: 2% 2% 2% 2%;
   background-color: #102B64;
   border-style: solid;
   border-width: 5px 5px 5px 5px;
   border-color: #EABB0E;
   border-radius: 10px;
   margin-top: 2%;
}

.divformadm, .espaceadm div h2, .pagin div 
{
color: white;
}


.panins div
{
 background-color: #EABB0E; 
 color: #102B64;
}

#admbtn , #sedeco
{
background-color: #102B64;
border-width: 5px 5px 5px 5px;
border-color: white;
color: white;
padding: 5% 5% 5% 5%;
border-radius :5px;
}

#adminbtn
{
margin-top: 20%;
}

.grpins
{
margin-top: 2%;
}

#admbtn:hover , #sedeco:hover
{
border-color: #EABB0E;
color: #EABB0E;
}

.infoins 
{
background-color: white;
border-width: 5px 5px 5px 5px;
border-color: #EABB0E;
color: #102B64;
margin-top: 2%;
padding: 2% 2% 2% 2%;
border-radius :5px;
}

.titleins a h2
{
background-color: white;
border-radius: 5px;
color:#102B64; 
}

.divformadm, .espaceadm, .pagin
{
font-family: 'Yanone Kaffeesatz', sans-serif;
font-size: 18px;
}

.annonce div li, .annonce div button
{
background-color: #EABB0E;
color: #102B64;
margin-top: 2%;
margin-bottom: 2%;
}

#exit
{
border : none;
border-radius: 50%;
background-color: #EABB0E;
color: #102B64;
margin-top: 20%;
}

#exit:hover
{
  background-color: #102B64;
  color: #EABB0E;
}

#titleannonce
{
text-decoration: underline;
}

.btn-group button:hover
{
  background-color: #102B64;
  color: #EABB0E;
}



</style>

</div>

</body>

</html>
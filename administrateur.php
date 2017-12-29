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
  <meta name="viewport" content="width=device-width, user-scalable=no">
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


         <div class="container">

         <div class="row">    

         <div class="col-xs-offset-3 col-xs-6 divformadm">

         <form method="POST" action="administrateur.php" name="formadm">

         <div class="row">


            <div class="form-group col-xs-12">
              <label for="adminlogin" class="col-form-label"> Login de l'administrateur :</label>  
              <input class="form-control"  type="text" placeholder="Ex : MyAdminLogin" id="admlogin" name="adminlogin" value="">             
            </div>

            <div class="form-group col-xs-12">
              <label for="adminmdp" class="col-form-label"> Mot de passe de l'administrateur :</label>
              <input class="form-control" type="password" placeholder="********" id="admmdp" name="adminmdp"> 
            </div>

            <div class="form-group col-xs-12">
              <input type="submit" value="Se connecter" id="admbtn" name="adminbtn" > 
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

<div class="infoadm col-xs-6">
<h3>Espace Administrateur</h3>
<p>Bonjour <?php echo $_SESSION['login']; ?> , nous sommes heureux de vous revoir.</p>
<p>Nous sommes actuellement le <?php echo date('d/m/Y'); ?> </p>



<?php

  $inscriptions_adm= $bdd-> query('SELECT COUNT(*) from utilisateur');
  $total_insc_adm = $inscriptions_adm->fetch(); 

  $inscriptions_nonval = $bdd-> query('SELECT COUNT(*) from utilisateur WHERE validation = 2');
  $total_nonval_adm = $inscriptions_nonval->fetch();

  $inscriptions_val = $bdd-> query('SELECT COUNT(*) from utilisateur WHERE validation = 1');
  $total_val_adm = $inscriptions_val->fetch();

  $inscriptions_att = $bdd-> query('SELECT COUNT(*) from utilisateur WHERE validation = 0');
  $total_val_att = $inscriptions_att->fetch();


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

<p>Vous avez <?php echo $total_insc_adm[0]; ?> inscriptions au total.</p>

<p>Parmis ces inscriptions ... </p>
<p>- <?php echo $total_nonval_adm[0]; ?> sont refusées.</p>
<p>- <?php echo $total_val_adm[0]; ?> sont validées.</p>
<p>- <?php echo $total_val_att[0]; ?> sont en attente de validation.</p>

</div>


<div class="col-xs-6">

<form method="post" action="administrateur.php" name="formdeco">
<input type="submit" name="deco" value="Déconnexion">
</form>

</div>
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



<?php

  $sql= "SELECT * FROM utilisateur ORDER BY inscription LIMIT ".(($pageActu-1)*$perPage).",".$perPage."";
  $mespages = $bdd->query($sql);
  $affichpages = $mespages->fetchAll();

  foreach ($affichpages as $affichles) 
  {
?>

<div class="panel panel-default col-xs-6">
<div class="row">
<div class="panel-body col-xs-6">
<a href= <?php echo "administrateur.php?a=".$affichles['id']."" ?> > <?php echo "<h1> Inscription N° ".$affichles['id']."</h1>"; ?></a>
</div>

  <div class="panel-footer">
  <table class="table table-xs">
   <tr class="bg-primary"><th scope="row"> Inscription :</th> <td><?php echo $affichles['inscription'] ?></td></tr>
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

<?php
}
}else{
  
}

?>
</div>

</div>

</body>

</html>
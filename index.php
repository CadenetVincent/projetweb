<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Accueil</title>
    <meta charset="utf-8">
    <meta name="format-detection" content="telephone=no"/>
    <link rel="icon" href="images/favicon.ico">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!--Bootstrap-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- Modernizr JS -->
    <script src="js/modernizr-2.6.2.min.js"></script>
    <!-- FontAwesome -->
    <script src="https://use.fontawesome.com/a40bcd97ad.js"></script>
    <!-- Animate.css -->
    <link rel="stylesheet" href="css/animate.css">
    <!-- Style.css -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body style="padding-top: 70px">

<section class="background">

    <?php include_once('header.php'); 

    if($_GET['page']=='inscription')
    {
    include_once('formulaire.php'); 
    }
    elseif ($_GET['page']=='admin') 
    {
    include_once('administrateur.php'); 
    }
    else
    {
    include_once('presentation.php'); 
    }

    include_once('footer.php'); ?>

</section>

</body>
</html>
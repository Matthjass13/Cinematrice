<?php session_start();
error_reporting(E_ERROR | E_PARSE); // Permet de ne pas afficher les warnings
?> 

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/css.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!--Nécessaire pour pouvoir utiliser la fonction d'affichage toggleElement--> 
    <script src="script/script.js"></script>
    <style>
    <?php 
    include "css/css.css";
    // Pour une raison obscure le css n'est pas appliqué avec le href du dessus, j'ai donc fait un include ici
    include "modele/modele.php";
    ?>
    </style>
    <title> 
     <?php 
     $nomPage = ucfirst(basename($_SERVER['SCRIPT_FILENAME'], '.php'));
     echo $nomPage;
     ?>
    </title>
  
  	<link rel="apple-touch-icon" sizes="180x180" href="images/favicon/apple-touch-icon.png">
  	<link rel="icon" type="image/png" sizes="32x32" href="images/favicon/favicon-32x32.png">
  	<link rel="icon" type="image/png" sizes="16x16" href="images/favicon/favicon-16x16.png">
	<link rel="manifest" href="images/favicon/site.webmanifest">
	<link rel="mask-icon" href="images/favicon/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="theme-color" content="#ffffff">
  	<!--Affichage du favicon-->
  
  
    <!--Permet d'obtenir le nom de la page dans le title-->
</head>

<body class="container-fluid bg-image">

<header>
  
	<div style="position: absolute; z-index: -1; top:-125px; left:-5px;"><img class="mobileHidden" style="max-width:520px;" src="images/pellicules/pellicule.png"></img></div>
    <div style="position: absolute; z-index: -1; top:-125px; left:-5px;"><img class="mobileOnly" style="max-width:520px;" src="images/pellicules/pelliculeMobile.png"></img></div>
  
    <!--Je ne pensais pas mettre un z-index dans ce projet !-->

    <br><div class="row container-mobile">

        <img class="element-mobile logo" src="images/logo/logoTexte.png">

        <form class="element-mobile col d-flex justify-content-center align-items-center form-inline" action="resultats.php" method="GET">
            <input class="form-control" type="text" name="recherche" placeholder="Rechercher par film, réalisateur ou genre" style="height: 30px;">
            <input type="image" class="icone" src="images/icones/blanc/loupe.png" alt="icône de loupe" name="submit"/>
        </form>
   
        <div class="element-mobile col d-flex justify-content-center align-items-center"> 
            <?php 
            if (isset($_SESSION['admin'])) {
                    echo "<p>Bonjour, ".$_SESSION['user']['User'].".<p>";
                    echo "<a href='cms/deconnexion.php' class='btn btn-light btn-lg'> Déconnexion</a>";
            } else {
                echo "<a href='connexion.php' class='btn btn-light btn-lg'> Connexion</a>";
            }
            ?>
        </div>
    
    </div><br>

    <nav class="d-flex navMobile">
        <a href="index.php" class="btn btn-dark btn-lg w-100 navButton 
			<?php if($nomPage=='Index') echo ' navButtonCourant';?>">Accueil</a>
        <a href="podcasts.php" class="btn btn-dark btn-lg w-100 navButton
			<?php if($nomPage=='Podcasts') echo ' navButtonCourant';?>">Podcasts</a>
        <a href="films.php" class="btn btn-dark btn-lg w-100 navButton 
			<?php if($nomPage=='Films') echo ' navButtonCourant';?>">Films</a>
        <a href="critiques.php" class="btn btn-dark btn-lg w-100 navButton 
			<?php if($nomPage=='Critiques') echo ' navButtonCourant';?>">Critiques</a>
        <a href="decouvertes.php" class="btn btn-dark btn-lg w-100 navButton 
			<?php if($nomPage=='Decouvertes') echo ' navButtonCourant';?>">Découvertes</a>
        <a href="contact.php" class="btn btn-dark btn-lg w-100 navButton 
			<?php if($nomPage=='Contact') echo ' navButtonCourant';?>">Contact</a>
        <a href="sondages.php" class="btn btn-dark btn-lg w-100 navButton 
			<?php if($nomPage=='Sondages') echo ' navButtonCourant';?>">Sondages</a>
        <a href="equipe.php" class="btn btn-dark btn-lg w-100 navButton 
			<?php if($nomPage=='Equipe') echo ' navButtonCourant';?>">Equipe</a>
    </nav><br>

</header>

<main>
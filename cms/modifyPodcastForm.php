<?php session_start();?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/css.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="script/script.js"></script>
    <style>
    <?php 
    include "css/css.css"; 
    include "../modele/modele.php";
    ?>
    </style>
    <title> <?php echo ucfirst(basename($_SERVER['SCRIPT_FILENAME'], '.php'))?></title>
</head>

<body class="container-fluid bg-image">

<header>

    <br><div class="row">

    <img class="logo" src="../images/logo/logoTexte.png">

    <form class="col d-flex justify-content-center align-items-center" class="form-inline" action="../resultats.php" method="GET">
        <input class="form-control" type="text" name="recherche" placeholder="Rechercher par film, réalisateur ou genre" style="height: 30px;">
        <input type="image" class="icone" src="../images/icones/blanc/loupe.png" alt="icône de loupe" name="submit"/>
    </form>

    <div class="col d-flex justify-content-center align-items-center"> 
        <?php 
        if (isset($_SESSION['admin'])) {
            echo "<p>Bonjour, ".$_SESSION['user']['User'].".<p>";
            echo "<a href='deconnexion.php' class='btn btn-light btn-lg'> Déconnexion</a>";
        } else {
            echo "<a href='../connexion.php' class='btn btn-light btn-lg'> Connexion</a>";
        }
        ?>
    </div>

    </div><br>

    <nav class="d-flex">
        <a href="../index.php" class="btn btn-dark btn-lg w-100 navButton">Accueil</a>
        <a href="../podcasts.php" class="btn btn-dark btn-lg w-100 navButton">Podcasts</a>
        <a href="../films.php" class="btn btn-dark btn-lg w-100 navButton">Films</a>
        <a href="../critiques.php" class="btn btn-dark btn-lg w-100 navButton">Critiques</a>
        <a href="../decouvertes.php" class="btn btn-dark btn-lg w-100 navButton">Découvertes</a>
        <a href="../contact.php" class="btn btn-dark btn-lg w-100 navButton">Contact</a>
        <a href="../sondages.php" class="btn btn-dark btn-lg w-100 navButton">Sondages</a>
        <a href="../equipe.php" class="btn btn-dark btn-lg w-100 navButton">Equipe</a>
    </nav><br>

</header>

<main>

<!--J'ai copié le header en changeant tous les liens car je suis dans le dossier cms...-->

<?php
$podcast = getPodcast($_POST["idPodcast"]);
$films = getFilms();
?>

<div class="bdElement">

    <form action="modifyPodcast.php" method="POST">

        <h1>Modification du podcast</h1>

        <div class="bdElement2">

            <div class="row">
                <div class="col-3">
                    <label for="episode">Numéro de l'épisode :</label> 
                    <input type="number" class="form-control" name="episode" id="episode" value="<?php echo $podcast["Episode"];?>"> <br>
                </div>

                <div class="col-9">
                    <label for="theme">Thème :</label>
                    <input type="text" class="form-control" name="theme" id="theme" value="<?php echo $podcast["Theme"];?>"> <br>
                </div>
            </div>

            <label for="description">Description :</label>
            <textarea class="form-control" name="description" rows="5" cols="30"><?php echo $podcast["Description"];?></textarea><br>

            <div class="row">
                <div class="col-4">
                    <label for="idFilm1">Film 1</label>
                    <select class="form-control" name="idFilm1">
                        <?php 
                        foreach ($films as $film) :
                            if($podcast['IdFilm1'] == $film['IdFilm']) $s="selected"; else $s = "";
                                echo "<option value=".$film["IdFilm"]." ".$s.">".$film["Titre"]."</option>";
                        endforeach;
                        ?>
                    </select>
                </div>
                <div class="col-4">
                    <label for="idFilm2">Film 2</label>
                    <select class="form-control" name="idFilm2">	
                        <?php 
                        foreach ($films as $film) :
                            if($podcast['IdFilm2'] == $film['IdFilm']) $s="selected"; else $s = "";
                                echo "<option value=".$film["IdFilm"]." ".$s.">".$film["Titre"]."</option>";
                        endforeach;
                        ?>
                    </select>
                </div>
                <div class="col-4">
                    <label for="idFilm3">Film 3</label>
                    <select class="form-control" name="idFilm3">	
                        <?php 
                        foreach ($films as $film) :
                            if($podcast['IdFilm3'] == $film['IdFilm']) $s="selected"; else $s = "";
                                echo "<option value=".$film["IdFilm"]." ".$s.">".$film["Titre"]."</option>";
                        endforeach;
                        ?>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-4">
                    <label for="video1">Lien Youtube 1ère vidéo</label>
                    <input type="text" class="form-control" name="video1" id="video1" value="<?php echo $podcast["Video1"];?>"> <br>
                </div>
                <div class="col-4">
                    <label for="video2">Lien Youtube 2ème vidéo</label>
                    <input type="text" class="form-control" name="video2" id="video2" value="<?php echo $podcast["Video2"];?>"> <br>
                </div>
                <div class="col-4">
                    <label for="video3">Lien Youtube 3ème vidéo</label>
                    <input type="text" class="form-control" name="video3" id="video3" value="<?php echo $podcast["Video3"];?>"> <br>
                </div>
            </div>

            <button type=submit name="idPodcast" value=<?php echo $podcast["IdPodcast"];?>> Modifier</button>

        </div>

    </form>    

</div>

</main>

</body>
</html>
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

<?php
$critique = getCritique($_POST["idCritique"]);
$films = getFilms();
?>

<div class="bdElement">

    <form action="modifyCritique.php" method="POST">

        <h1>Modification de la critique</h1>

        <div class="bdElement2">

            <div class="row">
                <div class="col-3">
                    <label for="note">Note :</label> 
                    <input type="number" class="form-control" name="note" id="note" value="<?php echo $critique["Note"];?>"> <br>
                </div>
                <div class="col-4">
                    <label for="idFilm">Film :</label>
                    <select class="form-control" name="idFilm">
                        <?php 
                        foreach ($films as $film) :
                            if($critique['IdFilm'] == $film['IdFilm']) $s="selected"; else $s = "";
                                echo "<option value=".$film["IdFilm"]." ".$s.">".$film["Titre"]."</option>";
                        endforeach;
                        ?>
                    </select>
                </div>
            </div>

            <label for="critique">Texte de la critique :</label>
            <textarea class="form-control" name="critique" rows="5" cols="30"><?php echo $critique["Critique"];?></textarea><br>

            <button type=submit name="idCritique" value=<?php echo $critique["IdCritique"];?>> Modifier</button>

        </div>

    </form>    

</div>

</main>

</body>
</html>
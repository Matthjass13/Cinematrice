<?php include "layout/header.php";?>

<?php 
$podcasts = getPodcasts();
foreach ($podcasts as $podcast) :
    displayPodcast($podcast, $_SESSION['admin']);
endforeach;



if(isset($_SESSION['admin'])) {?>


<!-- Formulaire d'ajout de podcast-->
<div class="bdElement">

    <h1> <button class="btn btn-light btn-lg" onclick="toggleElement('formAjoutP')">+</button> Ajouter un Podcast </h1>

    <div class="bdElement2" id='formAjoutP' style="display: none;">

        <form action="cms/addPodcast.php" method="POST">

            <div class="row">
                <div class="col-3">
                    <input type="number" class="form-control" name="episode" id="episode" placeholder="No de l'épisode" required>
                </div>
                <div class="col-9">
                    <input type="text" class="form-control" name="theme" id="theme" placeholder="Thème" required> 
                </div>
            </div><br>

            <textarea class="form-control col-12" name="description" rows="5" cols="30" placeholder="Description"></textarea><br>
            <!-- Peut-être que l'utilisateur ne trouvera pas tout de suite de description pour son podcast donc le champ n'est pas required-->

            <div class="row">
                <div class="col-4">
                    <input type="text" class="form-control" name="film1" id="film1" placeholder="Titre du 1er film">
                </div>
                <div class="col-4">
                    <input type="text" class="form-control" name="film2" id="film2" placeholder="Titre du 2ème film">
                </div>
                <div class="col-4">
                    <input type="text" class="form-control" name="film3" id="film3" placeholder="Titre du 3ème film">
                </div>
            </div>

            <div class="row">
                <div class="col-4">
                    <input type="text" class="form-control" name="video1" id="video1" placeholder="Lien Youtube 1ère vidéo">
                </div>
                <div class="col-4">
                    <input type="text" class="form-control" name="video2" id="video2" placeholder="Lien Youtube 2ème vidéo"> 
                </div>
                <div class="col-4">
                    <input type="text" class="form-control" name="video3" id="video3" placeholder="Lien Youtube 3ème vidéo">
                </div>
            <!--Aucun de ces 6 champs n'est requis car le client n'est pas obligé de remplir toutes les données du podcast en une fois :
            par exemple, s'il n'a sorti que la première vidéo à un temps t-->
            </div><br>

            <input type="submit" value="Ajouter">

        </form>

    </div>

</div>

<?php } displayModifyFilmForm($_SESSION['admin']); ?>

</main>

</body>
</html>
<?php include "layout/header.php";?>

<?php 
$critiques = getCritiques();
foreach ($critiques as $critique) :
    displayCritique($critique, $_SESSION['admin']);
endforeach;


if(isset($_SESSION['admin'])) {?>


<div class="bdElement">

    <h1> <button class="btn btn-light btn-lg" onclick="toggleElement('formAjoutC')">+</button> Ajouter une critique </h1>

    <div class="bdElement2" id='formAjoutC' style="display: none;">

        <form action="cms/addCritique.php" method="POST">
            <div class="row">
                <div class="col-3">
                    <input type="number" min="0" max="5" class="form-control" name="note" id="note" placeholder="Note" required>
                </div>
                <div class="col-4">
                    <input type="text" class="form-control" name="film" id="film" placeholder="Film" required>
                </div>
            </div> <br>
            <textarea class="form-control col-12" name="critique" rows="5" cols="30" placeholder="Texte de la critique"></textarea><br>
            <input type="submit" value="Ajouter">
        </form>

    </div>

</div>

<?php } 
displayModifyFilmForm($_SESSION['admin']); ?>

</main>

</body>
</html>
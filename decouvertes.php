<?php include "layout/header.php";?>

<?php 
$decouvertes = getDecouvertes();
foreach ($decouvertes as $decouverte) :
    displayDecouverte($decouverte, $_SESSION['admin']);
endforeach;


if(isset($_SESSION['admin'])) {?>


<div class="bdElement">

    <h1> <button class="btn btn-light btn-lg" onclick="toggleElement('formAjoutD')">+</button> Ajouter une découverte </h1>

    <div class="bdElement2" id='formAjoutD' style="display: none;">

        <form action="cms/addDecouverte.php" method="POST">
            <div class="row">
                <div class="col-4">
                    <input type="text" class="form-control" name="film" id="film" placeholder="Film" required>
                </div>
            </div> <br>
            <textarea class="form-control col-12" name="decouverte" rows="5" cols="30" placeholder="Texte de la découverte"></textarea><br>
            <input type="submit" value="Ajouter">
        </form>

    </div>

</div>
  
<?php } 
displayModifyFilmForm($_SESSION['admin']); ?>

</main>

</body>
</html>
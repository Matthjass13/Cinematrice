<?php include "layout/header.php";?>

<h1>Les films analysés dans notre site !</h1>

<p>Cliquez sur un film pour en savoir plus à son sujet.</p>

    <form action='#', method='GET'>
   
        <p>Trier par :
   
        <?php 
        $films= getFilms();
        if(isset($_GET['tri'])) {
            $tri = $_GET['tri'];
            if($tri=="titre") $films= getFilms();
            if($tri=="annee") $films= getFilmsByYear();
            if($tri=="real") $films= getFilmsByReal();
        }
        ?>

        <select name="tri">
            <option value="titre">Titre</option>
            <option value="annee">Année</option>
            <option value="real">Réalisateur</option>
        </select>

        <input type="submit" value="Trier"></p>

    </form>


<div class='bdElement'>

    <?php
    foreach ($films as $film) :
        if($film['Affiche']!="") {?>

    <a class='pave' onclick="toggleElement('f<?php echo $film['IdFilm'] ?>')"> <img class='pave' src='images/affiches/<?php echo $film['Affiche'] ?>'> </img></a>

    <div id='f<?php echo $film['IdFilm'] ?>' style='display: none;'>
        <?php displayInfosFilm($film['IdFilm']);?>
    </div>
	<?php } endforeach; echo '</div>';

displayModifyFilmForm($_SESSION['admin']); ?>


</main>


</body>
</html>
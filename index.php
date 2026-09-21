<?php include "layout/header.php";?>

<div class="row container-mobile">

    <div class="col">
        <h1>Qu'est-ce que Cinématrice ?</h1>
	  	<p>Podcast d'analyse/critique cinéma tenu par Seb et Rita, deux passionnés par du blabla cinématographique.</p>
        <p>Imaginez… Si le monde faisait face à la fin des temps, et que tout ce qui subsistait de l’humanité résidait dans le cinéma, qu’est-ce que les extra-terrestres diraient de nous ? Dans cette capsule perdue dans l’espace, que constateraient-ils de notre art, de notre société et de notre manière de voir le monde ?</p>
        <p>Si cette question te passionne également, dans ce cas …</p>
        <p>Bienvenue dans Cinématrice !</p> <br>
    </div>

    <div class="col">
        <img src="images/body/backgroundMainVert.jpg" class="illustration">
    </div>

</div>

<h1>Nouveautés</h1>

<?php 
echo '<h2>Podcasts</h2>';
displayPodcast(getNouveauPodcast(), $_SESSION['admin']);
echo '<h2>Critiques</h2>';
displayCritique(getNouvelleCritique(), $_SESSION['admin']);
echo '<h2>Découvertes</h2>';
displayDecouverte(getNouvelleDecouverte(), $_SESSION['admin']);
?>

</main>

</body>
</html>
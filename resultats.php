<?php include "layout/header.php";?>

<?php $recherche = $_GET["recherche"];?>

    <h1>Voici les résultats de la recherche pour "<?php echo $recherche?>" :</h1>

    <?php 
  
    $links = searchVideos($recherche);
 	$critiques = searchCritiques($recherche);
	$decouvertes = searchDecouvertes($recherche);

	if(!empty($links)) {
		  echo "<br><div class='bdElement'>";
		  echo "<h1>Podcasts :</h1>";
		  foreach ($links as $link) :
			  displayVideo($link);
			  echo '<br>';
		  endforeach;
		  echo "</div>";
	}
  
	if(!empty($critiques)) {
		  echo "<br><div class='bdElement'>";
		  echo "<h1>Critiques :</h1>";
		  foreach ($critiques as $critique) :
			  displayCritique($critique, $_SESSION['admin']);
			  echo '<br>';
		  endforeach;
		  echo "</div>";
	}
	  
	if(!empty($decouvertes)) {
		  echo "<br><div class='bdElement'>";
		  echo "<h1>Découvertes :</h1>";
		  foreach ($decouvertes as $decouverte) :
			  displayDecouverte($decouverte, $_SESSION['admin']);
			  echo '<br>';
		  endforeach; 
		echo "</div>";
	}

    ?>

</main>

</body>
</html>
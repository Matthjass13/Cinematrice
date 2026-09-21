<?php 

include "../modele/modele.php";

deletePodcast($_POST["idPodcast"]);

header("Location: ../podcasts.php");
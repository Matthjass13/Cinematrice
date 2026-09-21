<?php 

include "../modele/modele.php";

deleteCritique($_POST["idCritique"]);

header("Location: ../critiques.php");
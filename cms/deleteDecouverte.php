<?php 

include "../modele/modele.php";

deleteDecouverte($_POST["idDecouverte"]);

header("Location: ../decouvertes.php");
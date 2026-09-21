<?php 

include "../modele/modele.php";

$idDecouverte = $_POST["idDecouverte"];
$decouverte = $_POST["decouverte"];
$idFilm = $_POST["idFilm"];

modifyDecouverte($idDecouverte, $decouverte, $idFilm);

header("Location: ../decouvertes.php");

exit;
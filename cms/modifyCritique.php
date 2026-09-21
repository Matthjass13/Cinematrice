<?php 

include "../modele/modele.php";

$idCritique = $_POST["idCritique"];
$note = $_POST["note"];
$critique = $_POST["critique"];
$idFilm = $_POST["idFilm"];

modifyCritique($idCritique, $critique, $note, $idFilm);

header("Location: ../critiques.php");

exit;
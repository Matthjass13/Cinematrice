<?php 

include "../modele/modele.php";

$idPodcast = $_POST["idPodcast"];
$episode = $_POST["episode"];
$theme = $_POST["theme"];
$desc = $_POST["description"];
$idFilm1 = $_POST["idFilm1"];
$idFilm2 = $_POST["idFilm2"];
$idFilm3 = $_POST["idFilm3"];
$video1 = $_POST["video1"];
$video2 = $_POST["video2"];
$video3 = $_POST["video3"];

modifyPodcast($idPodcast, $episode, $theme, $desc, $video1, $video2, $video3, $idFilm1, $idFilm2, $idFilm3);

header("Location: ../podcasts.php");

exit;
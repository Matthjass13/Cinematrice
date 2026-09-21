<?php 

session_start();

include "../modele/modele.php";

$critique = $_POST["critique"];
$note = $_POST["note"];
$film = $_POST["film"];

addFilm($film);

$connect = connect_bd();

$rq = $connect->prepare("SELECT IdFilm FROM tblFilms ORDER BY IdFilm DESC LIMIT 0,1");
$rq->execute();
$film = $rq->fetch();

addCritique($critique, $note, $film["IdFilm"], $_SESSION['user']['IdUser']);

header("Location: ../critiques.php");
exit;
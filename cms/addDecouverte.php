<?php 

session_start();

include "../modele/modele.php";

$decouverte = $_POST["decouverte"];
$film = $_POST["film"];

addFilm($film);

$connect = connect_bd();

$rq = $connect->prepare("SELECT IdFilm FROM tblFilms ORDER BY IdFilm DESC LIMIT 0,1");
$rq->execute();
$film = $rq->fetch();

addDecouverte($decouverte, $film["IdFilm"], $_SESSION['user']['IdUser']);

header("Location: ../decouvertes.php");
exit;
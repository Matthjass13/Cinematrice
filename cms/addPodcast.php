<?php 

include "../modele/modele.php";

$episode = $_POST["episode"];
$theme = $_POST["theme"];
$desc = $_POST["description"];
$film1 = $_POST["film1"];
$film2 = $_POST["film2"];
$film3 = $_POST["film3"];
$video1 = $_POST["video1"];
$video2 = $_POST["video2"];
$video3 = $_POST["video3"];

$Film1Vide = false;
$Film2Vide = false;
$Film3Vide = false;

if($film1!="") addFilm($film1); else $Film1Vide = true;
if($film2!="") addFilm($film2); else $Film2Vide = true;
if($film3!="") addFilm($film3); else $Film3Vide = true;

$connect = connect_bd();

$rq = $connect->prepare("SELECT IdFilm FROM tblFilms ORDER BY IdFilm DESC LIMIT 0,3");
$rq->execute();
$derniersFilms = $rq->fetchAll();

$idFilm1=146;
$idFilm2=146;
$idFilm3=146;

if(!$Film1Vide) {
    if($Film2Vide) {
        $idFilm1=$derniersFilms[0]["IdFilm"];
    } else {
        if($film3Vide) {
            $idFilm1=$derniersFilms[1]["IdFilm"];
            $idFilm2=$derniersFilms[0]["IdFilm"];
        } else {
                $idFilm1=$derniersFilms[2]["IdFilm"];
                $idFilm2=$derniersFilms[1]["IdFilm"];
                $idFilm3=$derniersFilms[0]["IdFilm"];
            }
    }

}

addPodcast($episode, $theme, $desc, $video1, $video2, $video3, $idFilm1, $idFilm2, $idFilm3);

// Si l'on voulait être plus rigoureux, il aurait fallu que les données du film soient enregistrées dans tblFilms par le biais d'un formulaire,
// puis qu'un nouveau formulaire soit créé pour enregistrer les nouveaux podcasts, avec des listes déroulantes pour les films associés.
// Mais je suis parti du principe que le client n'aura pas envie de passer par deux formulaires pour entrer un nouveau podcast...
// Plus de détails à ce sujet dans modele.php (fonction addFilm())

// Le traitement d'ajout des films dans tblFilms est stupidement compliqué car cela dépend de ce qu'entre l'user.
// Avec le code initial, des films "vides" sont créés à chaque fois que l'user laisse vide un champ titre.
// Ce n'est pas idéal...
// Mais je ne peux pas simplement ne pas mettre de films pour film1 par exemple, car une clé étrangère idFilm1 est liée à la table podcasts.
// Ma solution : n'ajouter que les films non vides dans tblFilms, et pour les champs vides, ajouter un film (id 146) vide par défaut déjà présent dans la table
// Pour simplifier les algorithmes, je suppose que si l'entrée d'un film est laissée vide, les suivantes sont vides aussi.

header("Location: ../podcasts.php");
exit;
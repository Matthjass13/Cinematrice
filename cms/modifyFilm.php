<?php 

include "../modele/modele.php";

$idFilm = $_POST["idFilm"];

$connect = connect_bd();
$rq = "UPDATE tblFilms SET ";




if (isset($_POST['duree']) and $_POST['duree']!="") {
  echo $_POST['duree'];
    list($heures, $minutes) = explode(':', $_POST['duree']);
    $dureeFormatee = $heures . ':' . $minutes;
    // On doit formater la durée sinon impossible de mettre à jour la table avec
    $rq.="Duree = '$dureeFormatee', ";
}

if ($_POST['nom']!="" or $_POST['prenom']!="") {
  	$nom = $_POST['nom'];
  	$prenom = $_POST['prenom'];
    $rq2 = "INSERT INTO tblReals(Nom, Prenom) VALUES(:nom, :prenom)";
    $enreg = $connect->prepare($rq2);
    $enreg->execute(array("nom"=>$nom, "prenom"=>$prenom));
    $rq2 = $connect->prepare("SELECT IdReal FROM tblReals ORDER BY IdReal DESC LIMIT 0,1");
    $rq2->execute();
    $idDernierReal = $rq2->fetch();
    $rq.="IdReal = '$idDernierReal[0]', ";
}

if (isset($_POST['annee']) and $_POST['annee']!="") {
  	$annee= $_POST['annee'];
    $rq.="Annee = '$annee', ";
}

if ($_POST["idGenre"] != 9) {
    $idGenre = $_POST['idGenre'];
    $rq.="IdGenre = '$idGenre', ";
}
// L'idGenre 9 correspond au genre par défaut "Inconnu"

if (isset($_FILES["affiche"]) and $_FILES["affiche"]["name"]!="") {
    $affiche = $_FILES["affiche"];
    $nomAffiche = $affiche["name"];
    $targetPath = "../images/affiches/".$nomAffiche;
    move_uploaded_file($affiche["tmp_name"], $targetPath);
  	$rq.="Affiche = '$nomAffiche', ";
}


$rq = rtrim($rq, ', ');
// Supprimer la virgule finale et ajouter la condition WHERE

// Tous ces ifs permettent au client de ne pas écraser les données des tables s'il n'entre rien dans un champ

if (strpos($rq, 'Duree') or strpos($rq, 'IdReal') or strpos($rq, 'Annee') 
	or strpos($rq, 'IdGenre') or strpos($rq, 'Affiche')) {
  
// Inutile de poursuivre le traitement si aucun champ n'est entré...
// C'est techniquement possible donc ce code sert à éviter une erreur de syntaxe sql
  
	$rq.= " WHERE IdFilm = $idFilm";

	$enreg = $connect->prepare($rq);
	$enreg->execute();
}

header("Location: ../films.php");
exit;
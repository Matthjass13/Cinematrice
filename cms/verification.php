<?php

session_start();

$maxAttempts = 5;
$blockDuration = 300;

// Vérifier si l'utilisateur est déjà bloqué
if (isset($_SESSION['blocked']) && time() < $_SESSION['blocked']) {
    $remainingTime = $_SESSION['blocked'] - time();
    echo "Vous êtes temporairement bloqué. Réessayez dans $remainingTime secondes.";
    exit;
}

include "../modele/modele.php";

$connect = connect_bd();
$user = $_POST['login'];

$query= "SELECT * FROM tblUsers WHERE User = :user";
$rq = $connect->prepare($query);
$rq->bindParam(':user', $user);
$rq->execute();
$user = $rq->fetch(PDO::FETCH_ASSOC);
	
if (password_verify($_POST['password'], $user['MotDePasse'])) {
	$_SESSION['admin'] = true; // Permettra de déterminer si l'utilisateur est identifié sur toutes les pages
	$_SESSION['user'] = $user; // Récupérer le nom de l'admin pour l'afficher sur la page d'accueil et l'enregistrer en tant qu'auteur des critiques
	header('Location: ../index.php');
	unset($_SESSION['attempts']);
} else {
	
	if (!isset($_SESSION['attempts'])) {
		$_SESSION['attempts'] = 1;
	} else {
		$_SESSION['attempts']++;
	}

	// Vérifier si l'utilisateur a atteint le nombre maximal de tentatives
	if ($_SESSION['attempts'] >= $maxAttempts) {
		// Bloquer l'utilisateur pendant un certain temps
		$_SESSION['blocked'] = time() + $blockDuration;
		echo "Trop de tentatives de connexion. Vous êtes temporairement bloqué.";
	} else {
		echo "Nom d'utilisateur ou mot de passe incorrect. Tentatives restantes : " . ($maxAttempts - $_SESSION['attempts']);
	}


}


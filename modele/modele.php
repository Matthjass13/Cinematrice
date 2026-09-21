<?php

function connect_bd() {
  $servername = "3b2wc.myd.infomaniak.com";
  $username = "3b2wc_webmaster";
  $password = "Layton4Smash!";
  $bdd = "3b2wc_cinematrice";
  try {
      $connect = new PDO("mysql:host=$servername;dbname=$bdd", $username, $password);
      $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $connect;
  } catch (PDOException $e) {
      die('Erreur de connexion : ' . $e->getMessage());
  }
}


//------------- Getters -------------

function getPodcasts() {
  $connect = connect_bd();
  $rq = $connect->prepare("SELECT * FROM tblPodcasts ORDER BY IdPodcast DESC"); 
  // Les clients souhaitent que les contenus plus récents s'affichent en premier
  $rq->execute();
  $podcasts = $rq->fetchAll();
  return $podcasts;
}

function getPodcast($id) {
  $connect = connect_bd();
  $rq = $connect->prepare("SELECT * FROM tblPodcasts WHERE IdPodcast = ?");
  $rq->execute(array($id));
  $podcast = $rq->fetch();
  return $podcast;
}


//Récupérer le dernier podcast sorti, et l'afficher dans index.php
function getNouveauPodcast() {
  $connect = connect_bd();
  $rq = $connect->prepare("SELECT * FROM tblPodcasts ORDER BY Episode DESC LIMIT 0,1");
  $rq->execute();
  $podcast = $rq->fetch();
  return $podcast;
}

function getFilms(){
  $connect = connect_bd();
  $rq = $connect->prepare("SELECT * FROM tblFilms ORDER BY Titre");
  $rq->execute();
  $films = $rq->fetchAll();
  return $films;
}

function getFilmsByYear(){
  $connect = connect_bd();
  $rq = $connect->prepare("SELECT * FROM tblFilms ORDER BY Annee");
  $rq->execute();
  $films = $rq->fetchAll();
  return $films;
}

function getFilmsByReal(){
  $connect = connect_bd();
  $rq = $connect->prepare("SELECT * FROM tblFilms, tblReals WHERE tblFilms.IdReal = tblReals.IdReal ORDER BY Nom");
  $rq->execute();
  $films = $rq->fetchAll();
  return $films;
}

function getFilm($id) {
  $connect = connect_bd();
  $rq = $connect->prepare("SELECT * FROM tblFilms WHERE IdFilm = ?");
  $rq->execute(array($id));
  $film = $rq->fetch();
  return $film;
}

function getCritiques() {
  $connect = connect_bd();
  $rq = $connect->prepare("SELECT * FROM tblCritiques ORDER BY IdCritique DESC");
  $rq->execute();
  $critiques = $rq->fetchAll();
  return $critiques;
}

function getCritique($id) {
  $connect = connect_bd();
  $rq = $connect->prepare("SELECT * FROM tblCritiques WHERE IdCritique = ?");
  $rq->execute(array($id));
  $critique = $rq->fetch();
  return $critique;
}

function getNouvelleCritique() {
  $connect = connect_bd();
  $rq = $connect->prepare("SELECT * FROM tblCritiques ORDER BY IdCritique DESC LIMIT 0,1");
  $rq->execute();
  $critique = $rq->fetch();
  return $critique;
}

function getDecouvertes() {
  $connect = connect_bd();
  $rq = $connect->prepare("SELECT * FROM tblDecouvertes ORDER BY IdDecouverte DESC");
  $rq->execute();
  $decouvertes = $rq->fetchAll();
  return $decouvertes;
}

function getDecouverte($id) {
  $connect = connect_bd();
  $rq = $connect->prepare("SELECT * FROM tblDecouvertes WHERE IdDecouverte = ?");
  $rq->execute(array($id));
  $decouverte = $rq->fetch();
  return $decouverte;
}

function getNouvelleDecouverte() {
  $connect = connect_bd();
  $rq = $connect->prepare("SELECT * FROM tblDecouvertes ORDER BY IdDecouverte DESC LIMIT 0,1");
  $rq->execute();
  $decouverte = $rq->fetch();
  return $decouverte;
}

function getUser($id) {
  $connect = connect_bd();
  $rq = $connect->prepare("SELECT * FROM tblUsers WHERE IdUser = ?");
  $rq->execute(array($id));
  $user = $rq->fetch();
  return $user;
}

function getReal($id) {
  $connect = connect_bd();
  $rq = $connect->prepare("SELECT * FROM tblReals WHERE IdReal = ?");
  $rq->execute(array($id));
  $real = $rq->fetch();
  return $real;
}

function getGenres(){
  $connect = connect_bd();
  $rq = $connect->prepare("SELECT * FROM tblGenres ORDER BY Genre");
  $rq->execute();
  $genres = $rq->fetchAll();
  return $genres;
}

function getGenre($id) {
  $connect = connect_bd();
  $rq = $connect->prepare("SELECT * FROM tblGenres WHERE IdGenre = ?");
  $rq->execute(array($id));
  $genre = $rq->fetch();
  return $genre;
}


//------------- Modifications -------------

function deletePodcast($id) {
  $connect = connect_bd();
  $rq = $connect->prepare("DELETE FROM tblPodcasts WHERE IdPodcast = $id");
  $rq->execute();
}

function modifyPodcast($idPodcast, $episode, $theme, $desc, $video1, $video2, $video3, $idFilm1, $idFilm2, $idFilm3) {
  $connect = connect_bd();
  $rq = "UPDATE tblPodcasts SET Episode = '$episode', Theme = '$theme', Description = '$desc',
  Video1 = '$video1', Video2 = '$video2', Video3 = '$video3',
  IdFilm1 = '$idFilm1', IdFilm2 = '$idFilm2', IdFilm3 = '$idFilm3' WHERE IdPodcast = '$idPodcast'";
  $modif = $connect->prepare($rq);
  $modif->execute();
}

function addPodcast($episode, $theme, $desc, $video1, $video2, $video3, $idFilm1, $idFilm2, $idFilm3) {
  $connect = connect_bd();
  $rq = "INSERT INTO tblPodcasts(Episode, Theme, Description, IdFilm1, IdFilm2, IdFilm3, Video1, Video2, Video3) 
  VALUES(:episode, :theme, :desc, :idFilm1, :idFilm2, :idFilm3, :video1, :video2, :video3)";
  $add = $connect->prepare($rq);
  $add->execute(array("episode"=>$episode, "theme"=>$theme, "desc"=>$desc, 
  "idFilm1"=>$idFilm1, "idFilm2"=>$idFilm2, "idFilm3"=>$idFilm3,
  "video1"=>$video1, "video2"=>$video2, "video3"=>$video3));
}

function addFilm($titre, $idGenre = 9, $idReal = 10, $idType = 1) {
  $connect = connect_bd();
  $rq = "INSERT INTO tblFilms(Titre, IdGenre, IdReal, IdType) VALUES(:titre, :idGenre, :idReal, :idType)";
  $add = $connect->prepare($rq);
  $add->execute(array(":titre"=>$titre, ":idGenre"=>$idGenre, ":idReal"=>$idReal, ":idType"=>$idType));
}
// L'utilisateur ne peut pas ajouter directement de film, mais les films seront ajoutés une fois le formulaire d'ajout de podcast rempli.
// Le champ titre sera rempli, les champs d'id remplis par défaut pour ne pas faire bugger la bdd et les autres seront laissés vides.
// Mais tous les champs seront modifiables ultérieurement par un formulaire de modification de film.

function deleteCritique($id) {
  $connect = connect_bd();
  $rq = $connect->prepare("DELETE FROM tblCritiques WHERE IdCritique = $id");
  $rq->execute();
}

function modifyCritique($idCritique, $critique, $note, $idFilm) {
  $connect = connect_bd();
  $rq = "UPDATE tblCritiques SET Critique = '$critique', Note = '$note', IdFilm = $idFilm WHERE IdCritique = $idCritique";
  $modif = $connect->prepare($rq);
  $modif->execute();
}

function addCritique($critique, $note, $idFilm, $idUser) {
  $connect = connect_bd();
  $rq = "INSERT INTO tblCritiques(Critique, Note, IdFilm, IdUser) VALUES (:critique, :note, :idFilm, :idUser)";
  $add = $connect->prepare($rq);
  $add->execute(array("critique"=>$critique, "note"=>$note, "idFilm"=>$idFilm, "idUser"=>$idUser));
}

function deleteDecouverte($id) {
  $connect = connect_bd();
  $rq = $connect->prepare("DELETE FROM tblDecouvertes WHERE IdDecouverte = $id");
  $rq->execute();
}

function modifyDecouverte($idDecouverte, $decouverte, $idFilm) {
  $connect = connect_bd();
  $rq = "UPDATE tblDecouvertes SET Decouverte = '$decouverte', IdFilm = $idFilm WHERE IdDecouverte = $idDecouverte";
  $modif = $connect->prepare($rq);
  $modif->execute();
}

function addDecouverte($decouverte, $idFilm, $idUser) {
  $connect = connect_bd();
  $rq = "INSERT INTO tblDecouvertes(Decouverte, IdFilm, IdUser) VALUES (:decouverte, :idFilm, :idUser)";
  $add = $connect->prepare($rq);
  $add->execute(array("decouverte"=>$decouverte, "idFilm"=>$idFilm, "idUser"=>$idUser));
}

//------------- Recherches -------------

function searchVideos($recherche) {

  $connect = connect_bd();
  $links = []; // Contiendra tous les liens des vidéos à afficher
  
  // Recherche de toutes les vidéos en rapport avec un titre de film
  $rq = $connect->prepare("SELECT * FROM tblFilms WHERE Titre LIKE '%$recherche%' ");
  $rq->execute();
  $film = $rq->fetch();
  $rq = $connect->prepare("SELECT * FROM tblPodcasts WHERE IdFilm1 = '$film[IdFilm]' OR IdFilm2 = '$film[IdFilm]' OR IdFilm3 = '$film[IdFilm]'");
  $rq->execute();
  $podcasts = $rq->fetchAll();
  foreach ($podcasts as $podcast) {
  if($podcast['IdFilm1']==$film['IdFilm']) array_push($links, $podcast['Video1']);
  else if($podcast['IdFilm2']==$film['IdFilm']) array_push($links, $podcast['Video2']);
  else if($podcast['IdFilm3']==$film['IdFilm']) array_push($links, $podcast['Video3']);
  }

  //Recherche de toutes les vidéos en rapport avec un réalisateur
  $rq = $connect->prepare("SELECT * FROM tblReals WHERE Nom LIKE '%$recherche%' OR Prenom LIKE '%$recherche%'");
  $rq->execute();
  $real = $rq->fetch();
  $rq = $connect->prepare("SELECT * FROM tblPodcasts");
  $rq->execute();
  $podcasts = $rq->fetchAll();
  foreach ($podcasts as $podcast) {
    if (getFilm($podcast['IdFilm1'])['IdReal']==$real['IdReal']) array_push($links, $podcast['Video1']);
    else if(getFilm($podcast['IdFilm2'])['IdReal']==$real['IdReal']) array_push($links, $podcast['Video2']);
    else if(getFilm($podcast['IdFilm3'])['IdReal']==$real['IdReal']) array_push($links, $podcast['Video3']);
	}

  //Recherche de toutes les vidéos en rapport avec un genre
  $rq = $connect->prepare("SELECT * FROM tblGenres WHERE Genre LIKE '%$recherche%'");
  $rq->execute();
  $genre = $rq->fetch();
  $rq = $connect->prepare("SELECT * FROM tblPodcasts");
  $rq->execute();
  $podcasts = $rq->fetchAll();
  foreach ($podcasts as $podcast) {
    if (getFilm($podcast['IdFilm1'])['IdGenre']==$genre['IdGenre']) array_push($links, $podcast['Video1']);
    else if(getFilm($podcast['IdFilm2'])['IdGenre']==$real['IdGenre']) array_push($links, $podcast['Video2']);
    else if(getFilm($podcast['IdFilm3'])['IdGenre']==$real['IdGenre']) array_push($links, $podcast['Video3']);
  }

  return array_unique($links); // Permet d'éviter d'afficher 2x la même vidéo
  // Quoique je doute que ce soit techniquement possible ?
  // Sans doute non vu que l'utilisateur ne peut pas rechercher un réal et un genre en même temps par exemple,
  // mais sait-on jamais...
}

function searchCritiques($recherche) {

  $connect = connect_bd();
  $critiquesAAfficher = [];

  $rq = $connect->prepare("SELECT * FROM tblFilms WHERE Titre LIKE '%$recherche%'");
  $rq->execute();
  $film = $rq->fetch();
  $rq = $connect->prepare("SELECT * FROM tblCritiques");
  $rq->execute();
  $critiques = $rq->fetchAll();
  foreach ($critiques as $critique) {
    if($critique['IdFilm']==$film['IdFilm']) array_push($critiquesAAfficher, $critique);
  }
  
  $rq = $connect->prepare("SELECT * FROM tblReals WHERE Nom LIKE '%$recherche%' OR Prenom LIKE '%$recherche%'");
  $rq->execute();
  $real = $rq->fetch();
  $rq = $connect->prepare("SELECT * FROM tblCritiques");
  $rq->execute();
  $critiques = $rq->fetchAll();
  foreach ($critiques as $critique) {
    if (getFilm($critique['IdFilm'])['IdReal']==$real['IdReal']) array_push($critiquesAAfficher, $critique);
	}

  $rq = $connect->prepare("SELECT * FROM tblGenres WHERE Genre LIKE '%$recherche%'");
  $rq->execute();
  $genre = $rq->fetch();
  $rq = $connect->prepare("SELECT * FROM tblCritiques");
  $rq->execute();
  $critiques = $rq->fetchAll();
  foreach ($critiques as $critique) {
    if (getFilm($critique['IdFilm'])['IdGenre']==$genre['IdGenre']) array_push($critiquesAAfficher, $critique);
  }

  return $critiquesAAfficher;
}

function searchDecouvertes($recherche) {

  $connect = connect_bd();
  $decouvertesAAfficher = [];

  $rq = $connect->prepare("SELECT * FROM tblFilms WHERE Titre LIKE '%$recherche%'");
  $rq->execute();
  $film = $rq->fetch();
  $rq = $connect->prepare("SELECT * FROM tblDecouvertes");
  $rq->execute();
  $decouvertes = $rq->fetchAll();
  foreach ($decouvertes as $decouverte) {
    if($decouverte['IdFilm']==$film['IdFilm']) array_push($decouvertesAAfficher, $decouverte);
  }
  
  $rq = $connect->prepare("SELECT * FROM tblReals WHERE Nom LIKE '%$recherche%' OR Prenom LIKE '%$recherche%'");
  $rq->execute();
  $real = $rq->fetch();
  $rq = $connect->prepare("SELECT * FROM tblDecouvertes");
  $rq->execute();
  $decouvertes = $rq->fetchAll();
  foreach ($decouvertes as $decouverte) {
    if (getFilm($decouverte['IdFilm'])['IdReal']==$real['IdReal']) array_push($decouvertesAAfficher, $decouverte);
	}

  $rq = $connect->prepare("SELECT * FROM tblGenres WHERE Genre LIKE '%$recherche%'");
  $rq->execute();
  $genre = $rq->fetch();
  $rq = $connect->prepare("SELECT * FROM tblDecouvertes");
  $rq->execute();
  $decouvertes = $rq->fetchAll();
  foreach ($decouvertes as $decouverte) {
    if (getFilm($decouverte['IdFilm'])['IdGenre']==$genre['IdGenre']) array_push($decouvertesAAfficher, $decouverte);
  }
  
  return $decouvertesAAfficher;
}


//------------- Affichage -------------

function displayInfosFilm($idFilm) {
  $nom = getReal(getFilm($idFilm)['IdReal'])['Nom'];
  $prenom = getReal(getFilm($idFilm)['IdReal'])['Prenom'];
  $duree = substr(getFilm($idFilm)['Duree'], 0, -3); // Enlever les secondes
  $duree = substr($duree, 0, 2).'h'.substr($duree, 3); // Remplace : par h
  $annee = getFilm($idFilm)['Annee'];
  $genre = getGenre(getFilm($idFilm)['IdGenre'])['Genre'];
  if($nom != "Inconnu") echo "<p class='InfosFilmsMobileP'><b>Réalisateur : </b><br>".$prenom.' '.$nom.'</p>';
  if($duree != "00h00") echo "<p class='InfosFilmsMobileP'><b>Durée : </b><br>".$duree.'</p>';
  if($annee != "0000") echo "<p class='InfosFilmsMobileP'><b>Année de sortie : </b><br>".$annee.'</p>';
  if($genre != "Inconnu") echo "<p class='InfosFilmsMobileP'><b>Genre : </b><br>".$genre.'</p>';
}

function displayVideo($link) {
  echo "<div class='video-container'><iframe width='560' height='315' src='".correctLink($link)."' title='YouTube video player' frameborder='0' 
  allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share' allowfullscreen></iframe></div>";
}
//Code obtenu grâce à Youtube lorsqu'on demande à intégrer une vidéo à notre site


function displayPartie($podcast, $partie) {
  if($podcast["Video{$partie}"]!="") { // La partie n'est pas affichée si la vidéo n'est pas encore publiée
  echo "<div class='bdElement2'>";
  echo "<h2><button class='btn btn-light' onclick=\"toggleElement('p{$podcast['IdPodcast']}v{$partie}')\">+</button>";
  echo " Partie {$partie} : ".getFilm($podcast["IdFilm{$partie}"])["Titre"]."</h2>";
  echo "<div class='bdElement2' id='p{$podcast['IdPodcast']}v{$partie}' style='display: none;'>";
  echo "<div class='row container-mobile'>";
  echo "<div class='col element-mobile'>";
  displayVideo($podcast["Video{$partie}"]);
  echo "</div>";
  echo "<div class='col element-mobile'>";
  displayInfosFilm($podcast["IdFilm{$partie}"]);
  echo "</div></div></div></div>";
  }
}
// Affiche la partie 1, 2 ou 3 du podcast
// Le code est... verbeux mais au moins cela permet de diminuer la répétition de code

function displayPodcast($podcast, $admin) { // Contrairement aux parties individuelles, l'affichage du podcast dépend de si l'user est connecté ou non

  echo "<div class='bdElement'><div class='row'><div class='col'>";
  echo "<h1><button class='btn btn-light btn-lg' onclick=\"toggleElement('p{$podcast['IdPodcast']}')\">+</button>";
  echo " Episode ".$podcast['Episode']." : ".$podcast['Theme']."</h1></div>";

  if(isset($admin)) {
    echo "<div class='col-auto ml-auto'>";
    echo "<form onsubmit='return showConfirmation()' action='cms/deletePodcast.php' method='post'>";
    echo "<h1><button class='btn btn-danger btn-lg btn-block' type='submit' name='idPodcast' value='".$podcast['IdPodcast']."'>x</button></h1></form></div>";
  }

  echo "</div><p>".$podcast['Description']."</p>";
  echo "<div id='p{$podcast['IdPodcast']}' style='display: none;'>";
  displayPartie($podcast, 1);
  displayPartie($podcast, 2);
  displayPartie($podcast, 3);
  echo "</div>";

  if(isset($admin)) {
    echo "<div class='row'>";
    echo "<div class='text-right'>"; // AAAAAAARGHHHHH ce bouton ne veut pas s'afficher plus à droite......
    echo "<form class='text-right' action='cms/modifyPodcastForm.php' method='post'>";
    echo "<button class='btn btn-secondary d-inline-block ml-auto' type='submit' name='idPodcast' value='".$podcast['IdPodcast']."'>Modifier</button></h1></form>";
    echo "</div>";
    echo "</div>";
  }
  
  echo "</div> <br>";
}
// Fonction très horrible mais elle fonctionne comme displayPartie


function displayCritique($critique, $admin) {

  echo "<div class='bdElement'><div class='row'><div class='col'>";
  echo "<h1><button class='btn btn-light btn-lg' onclick=\"toggleElement('c{$critique['IdCritique']}')\">+</button> ";
  echo getFilm($critique['IdFilm'])['Titre']." : ".$critique['Note']."/5</h1></div>";

  if(isset($admin)) {
    echo "<div class='col-auto ml-auto'>";
    echo "<form onsubmit='return showConfirmation()' action='cms/deleteCritique.php' method='post'>";
    echo "<h1><button class='btn btn-danger btn-lg btn-block' type='submit' name='idCritique' value='".$critique['IdCritique']."'>x</button></h1></form></div>";
  }

  echo "</div><p>Critique écrite par ".getUser($critique['IdUser'])['User']."</p>";

  echo "<div id='c{$critique['IdCritique']}' style='display: none;'>";
  echo "<div class='row container-mobile'><div class='element-mobile col'>";
  displayInfosFilm($critique['IdFilm']);
  echo "<br><p class=>".$critique['Critique']."</p></div>"; 
  if(getFilm($critique['IdFilm'])['Affiche']!="") {
	echo "<div class='element-mobile col'>";
	echo "<img class='illustration' src='images/affiches/".getFilm($critique['IdFilm'])['Affiche']."'></img>";
	echo "</div>";
  }
  echo "</div></div>";

  if(isset($admin)) {
    echo "<div class='row'>";
    echo "<div class='text-right'>";
    echo "<form class='text-right' action='cms/modifyCritiqueForm.php' method='post'>";
    echo "<button class='btn btn-secondary d-inline-block ml-auto' type='submit' name='idCritique' value='".$critique['IdCritique']."'>Modifier</button></h1></form>";
    echo "</div>";
    echo "</div>";
  }
  
  echo "</div> <br>";

}

function displayDecouverte($decouverte, $admin) {

  echo "<div class='bdElement'><div class='row'><div class='col'>";
  echo "<h1><button class='btn btn-light btn-lg' onclick=\"toggleElement('d{$decouverte['IdDecouverte']}')\">+</button> ";
  echo getFilm($decouverte['IdFilm'])['Titre']."</h1></div>";

  if(isset($admin)) {
    echo "<div class='col-auto ml-auto'>";
    echo "<form onsubmit='return showConfirmation()' action='cms/deleteDecouverte.php' method='post'>";
    echo "<h1><button class='btn btn-danger btn-lg btn-block' type='submit' name='idDecouverte' value='".$decouverte['IdDecouverte']."'>x</button></h1></form></div>";
  }

  echo "</div><p>Découverte écrite par ".getUser($decouverte['IdUser'])['User']."</p>";

  echo "<div id='d{$decouverte['IdDecouverte']}' style='display: none;'>";
  echo "<div class='row container-mobile'><div class='element-mobile col'>";
  displayInfosFilm($decouverte['IdFilm']);
  echo "<br><p>".$decouverte['Decouverte']."</p></div>";
  if(getFilm($decouverte['IdFilm'])['Affiche']!="") {
	echo "<div class='element-mobile col'>";
	echo "<img class='illustration' src='images/affiches/".getFilm($decouverte['IdFilm'])['Affiche']."'></img>";
	echo "</div>";
  }
  echo "</div></div>";

  if(isset($admin)) {
    echo "<div class='row'>";
    echo "<div class='text-right'>";
    echo "<form class='text-right' action='cms/modifyDecouverteForm.php' method='post'>";
    echo "<button class='btn btn-secondary d-inline-block ml-auto' type='submit' name='idDecouverte' value='".$decouverte['IdDecouverte']."'>Modifier</button></h1></form>";
    echo "</div>";
    echo "</div>";
  }

  echo "</div> <br>";

}

function displayModifyFilmForm($admin) {

    if($admin) {

        echo "<div class='bdElement'><h1><button class='btn btn-light btn-lg' onclick=\"toggleElement('formModif')\">+</button> Modifier un film</h1>";
        echo "<div class='bdElement2' id='formModif' style='display: none;'>";
        echo "<form action='cms/modifyFilm.php' method='POST' enctype='multipart/form-data'>";
        // L'enctype permet à l'utilisateur d'envoyer une image d'affiche pour son film

        echo "<div class='row'><div class='col-2'><label for='idFilm'>Titre du film :</label></div>";
        echo "<div class='col-3'><select class='form-control' name='idFilm'>";
        
        $films=getFilms();
        foreach ($films as $film) :
            echo "<option value=".$film["IdFilm"].">".$film["Titre"]."</option>";
        endforeach;

        echo "</select></div><div class='col-1'><label for='duree'>Durée :</label></div>";
        echo "<div class='col-2'><input type='time' class='form-control' name='duree' id='duree' placeholder='Durée'></div>";
        echo "<div class='col-2'><label for='annee'>Année :</label></div>";
        echo "<div class='col-2'><input type='year' class='form-control' name='annee' id='annee' placeholder='Année'></div></div><br>";
        echo "<div class='row'><div class='col-2'><label>Réalisateur :</label></div>";
        echo "<div class='col-3'><input type='text' class='form-control' name='nom' id='nom' placeholder='Nom'></div>";
        echo "<div class='col-3'><input type='text' class='form-control' name='prenom' id='prenom' placeholder='Prénom'></div>";
        echo "<div class='col-2'><label for='idGenre'>Genre :</label></div>";
        echo "<div class='col-2'><select class='form-control' name='idGenre'>";
            
        $genres=getGenres();
        foreach ($genres as $genre) :
	  		if($genre["Genre"]=="Inconnu") $s='selected'; else $s = "";
            echo "<option value=".$genre["IdGenre"]." ".$s." >".$genre["Genre"]."</option>";
        endforeach;

        echo "</select></div></div><br>";
        echo "<div class='row'><div class='col-2'><label for='affiche'>Affiche / Image :</label></div>";
        echo "<div class='col-6'><input type='file' class='form-control' name='affiche' id='affiche'></div></div><br>";
        echo "<input type='submit' value='Modifier'></form></div></div>";
    
    }
}


//------------- Autres -------------

function correctLink($link) { 
  return substr($link, 0, 8)."www.youtube.com/embed".substr($link, 16);
}
// Il faut ajouter le mot embed aux liens des vidéos youtube pour qu'elles s'affichent bien sur le site, 
// cette fonction met le lien sous la bonne forme
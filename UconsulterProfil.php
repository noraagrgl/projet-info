<?php

    session_start();

    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
        header("location: acceuil.html");
        exit;
    }



    if (isset($_GET['email'])) {
        $email = $_GET['email'];
        $userFound = false;

        $fichier = fopen("data/utilisateurs.txt", "r");
        while (($ligne = fgets($fichier)) !== false) {
            $ligne = explode(";", trim($ligne));
            if ($ligne[0] === $email) {
                $userFound = true;
                // Récupération des informations de l'utilisateur depuis le fichier
                $num = $ligne[1];
                $pseudo = $ligne[2];
                $mdp = $ligne[3];
                $sexe = $ligne[4];
                $naissance = $ligne[5];
                $profession = $ligne[6];
                $lieu_residence = $ligne[7];
                $type_relation = $ligne[8];
                $description = $ligne[9];
                $photo = $ligne[10];
                $abonnement = $ligne[11];
                $date_inscription = $ligne[12];
                break;
            }
        }
        fclose($fichier);

    }

?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CY-Rencontres</title>
    <link rel="stylesheet" type="text/css" href="js-css/Autilisateur.css">
    
</head>
<body>
    <div id="containerA">
        
      <div class="bouton">
        <img src="image/accueil.png" alt="image d'accueil" class="imageSelection"/>
        <span id="Accueil" class="bouton"> <a href="utilisateur.php" class="a">Accueil</a></span>
      </div>

      <div class="bouton">
        <img src="image/loupe.jpg" alt="image recherhce" class="imageSelection"/>
        <span id="Profil" class="bouton"> <a href="Urecherche.php">Recherche</a></span>
      </div>

      <div class="bouton">
        <img src="image/profil.png" alt="image profil" class="imageSelection"/>
        <span id="Profil" class="bouton"> <a href="Uprofil.php" class="a">Profil</a></span>
      </div>

      <div class="bouton">
        <img src="image/messagerieIcone.png" alt="image messagerie" class="imageSelection"/>
        <span id="Messagerie" class="bouton"> <a href="Umessagerie.php" class="a">Messagerie</a></span>
      </div>

      <div class="bouton">
        <img src="image/parametre.png" alt="image parametre" class="imageSelection"/>
        <span id="Parametres" class="bouton"> <a href="Uparametre.php" class="a">Paramètres</a></span>
      </div>

      <div class="bouton" id="adminDIV"></div>

      <div class="bouton">       
        <img src="image/deconnexion.png" alt="image deconnexion" class="imageSelection"/> 
        <span id="Deconnexion" class="bouton"> <a href="deconnexion.php" class="a">Déconnexion</a></span>
      </div>
        
    </div>



    <h1>Profil de <?= htmlspecialchars($pseudo) ?></h1>
    <img src="image/<?= htmlspecialchars($photo) ?>" alt="Photo de profil" class="image">
    <p><b>Email:</b> <?= htmlspecialchars($email) ?></p>
    <p><b>Numéro de téléphone:</b> <?= htmlspecialchars($num) ?></p>
    <p><b>Pseudo:</b> <?= htmlspecialchars($pseudo) ?></p>
    <p><b>Mot de passe:</b> <?= htmlspecialchars($mdp) ?></p>
    <p><b>Sexe:</b> <?= htmlspecialchars($sexe) ?></p>
    <p><b>Âge:</b> <?= htmlspecialchars($naissance) ?></p>
    <p><b>Profession:</b> <?= htmlspecialchars($profession) ?></p>
    <p><b>Lieu de résidence:</b> <?= htmlspecialchars($lieu_residence) ?></p>
    <p><b>Type de relation recherché:</b> <?= htmlspecialchars($type_relation) ?></p>
    <p><b>Description:</b> <?= htmlspecialchars($description) ?></p>
    <p><b>Abonnement:</b> <?= htmlspecialchars($abonnement) ?></p>
    <p><b>Date d'inscription:</b> <?= htmlspecialchars($date_inscription) ?></p>

</body>
</html>

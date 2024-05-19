<?php
    session_start();

    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: acceuil.html");
        exit;
    }
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CY-Rencontres</title>
    <link rel="stylesheet" type="text/CSS" href="js-css/Ugestion.css">
    <!-- <script src="js-css/Ugestion.js"></script> -->
</head>
<body>

    <div id="containerA">
        <div class="bouton">
            <img src="image/accueil.png" alt="image d'accueil" class="imageSelection"/>
            <span id="Accueil" class="bouton"> <a href="utilisateur.php" class="a">Accueil</a></span>
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
        <div class="bouton">
            <img src="image/deconnexion.png" alt="image deconnexion" class="imageSelection"/> 
            <span id="Deconnexion" class="bouton"> <a href="deconnexion.php" class="a">Déconnexion</a></span>
        </div>
    </div>

    <div id="listeUtilisateur">
        <h2>Liste des utilisateurs:</h2><br><br><br>
        <ul>
            <?php
                $fichier = fopen("data/utilisateurs.txt", "r");

                while (($ligne = fgets($fichier)) !== false) {
                    $ligne = explode(";", trim($ligne));
                    ?>
                    <li>
                        <p><img src="image/<?= $ligne[10] ?>" class="image"><b>Pseudo:</b> <?= $ligne[2] ?> <b>Adresse mail:</b> <?= $ligne[0] ?>
                        <a href="Autilisateur.php?email=<?= urlencode($ligne[0]) ?>">Consulter le profil</a></p>
                    </li>
                    <?php
                }
                fclose($fichier);
            ?>
        </ul>
    </div>

    <script src="js-css/Ugestion.js"></script>
</body>
</html>

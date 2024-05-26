<?php
    session_start();

    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: acceuil.html");
    exit;
    }

    $abonnement = $_SESSION['abonnement'];

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CY-Rencontres</title>
    <link rel="stylesheet" type="text/CSS" href="js-css/utilisateur.css">
    <!-- <script src="js-css/utilisateur.js"></script> -->
    <link rel="icon" type="image/png" href="image/LOGOCY.png">
</head>
<body>

    <div id="containerA">
        
      <div class="bouton">
        <img src="image/accueil.png" alt="image d'accueil" class="imageSelection"/>
        <span id="Accueil" class="bouton"> <a href="utilisateur.php" class="a">Accueil</a></span>
      </div>

      <div class="bouton">
        <img src="image/loupe.jpg" alt="image recherhce" class="imageSelection"/>
        <span id="Profil" class="bouton"> <a href="Urecherche.php" class="a">Recherche</a></span>
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

    

    <div id="gestionDiv"></div>

      <h1>Bienvenue <?= $_SESSION['pseudo'] ?> </h1>
      <br><br><br>

      <div id="messageConsulte">

        <?php

            $emailSession = trim($_SESSION['email']);
            $fichierConsultations = "data/consulterProfil.txt";
            $fichierBannissement = "data/bannissement.txt";
            $fichierUtilisateurs = "data/utilisateurs.txt";

            $consultations = [];
            $contenuFichier = [];

            // Lire le fichier pour trouver les consultations et conserver les lignes non pertinentes
            $handle = fopen($fichierConsultations, "r");
            if ($handle) {
                while (($ligne = fgets($handle)) !== false) {
                    $colonnes = explode(";", trim($ligne));
                    if (count($colonnes) == 2) {
                        if ($colonnes[0] === $emailSession) {
                            $consultations[] = $colonnes[1];
                        } else {
                            $contenuFichier[] = $ligne; // Conserver les lignes qui ne correspondent pas
                        }
                    }
                }
                fclose($handle);
            } else {
                echo "<p class=\"message\">Impossible d'ouvrir le fichier des consultations.</p>";
                exit;
            }

            if (!empty($consultations)) {
                echo "<h2 class=\"message\">Pendant votre absence, les utilisateurs suivants ont consulté votre profil :</h2>";
                foreach ($consultations as $emailConsultant) {
                    echo "<p class=\"message\">$emailConsultant a consulté votre profil.</p>";
                }

                // Réécrire le fichier sans les lignes affichées
                $handle = fopen($fichierConsultations, "w");
                if ($handle) {
                    foreach ($contenuFichier as $ligne) {
                        fwrite($handle, $ligne);
                    }
                    fclose($handle);
                } else {
                    echo "<p class=\"message\">Impossible de mettre à jour le fichier des consultations.</p>";
                }
            } else {
                echo "<p class=\"message\">Personne n'a consulté votre profil pendant votre absence.</p>";
            }
        ?>

        </div>

        <?php


            // Lire le fichier de bannissement
            $handle = fopen($fichierBannissement, "r");
            $bannis = [];
            if ($handle) {
                while (($email = fgets($handle)) !== false) {
                    $bannis[] = trim($email);
                }
                fclose($handle);
            } else {
                echo "<p>Impossible d'ouvrir le fichier de bannissement.</p>";
                exit;
            }

            // Lire le fichier des utilisateurs
            $handle = fopen($fichierUtilisateurs, "r");
            if ($handle) {
                while (($ligne = fgets($handle)) !== false) {
                    $ligne = explode(";", trim($ligne));

                    // Vérification des indices et != sexe et == type_relation
                    if (isset($ligne[4]) && isset($ligne[8])) {
                        if ($_SESSION["sexe"] != $ligne[4] && $_SESSION["type_relation"] == $ligne[8]) {
                            // Vérification si l'utilisateur est banni
                            if (!in_array($ligne[0], $bannis)) {
                                ?>
                                <div id="user_print">
                                    <p><img src="image/<?= $ligne[10] ?>" class="image"><b><?= $ligne[2] ?></b></p>
                                    <p><?= $ligne[9] ?></p>
                                    <a href="Umessagerie.php">Envoyer un message</a>
                                </div>
                                <?php
                            }
                        }
                    }
                }
                fclose($handle);
            } else {
                echo "<p>Impossible d'ouvrir le fichier des utilisateurs.</p>";
                exit;
            }
        ?>
 

    <script>
        var abonnement = "<?php echo $abonnement; ?>";
    </script>
    <script src="js-css/utilisateur.js"></script>
</body>
</html>

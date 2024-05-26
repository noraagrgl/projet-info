<?php
session_start();
// Verif pour la déconnexion
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: acceuil.html");
    exit;
}
// Pour savoir si on est en mode modification ou nn
if (isset($_GET['edit']) && $_GET['edit'] == "true") {
    $_SESSION['edit_mode'] = true;
} else {
    $_SESSION['edit_mode'] = false;
}
// Recupere toutes les informations d'une personne pour es afficher
if (isset($_GET['email'])) {
    $email = $_GET['email'];
    $userFound = false;

    $fichier = fopen("data/utilisateurs.txt", "r");
    while (($ligne = fgets($fichier)) !== false) {
        $ligne = explode(";", trim($ligne));
        if ($ligne[0] === $email) {
            $userFound = true;
            // Récupération des informations de l'utilisateur depuis le fichier
            $email = $ligne[0];
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
    
    if (!$userFound) {
        echo "Utilisateur non trouvé.";
        exit;
    }
    } else {
        echo "Aucun utilisateur spécifié.";
        exit;
    }


    
    $_SESSION["AdminConvEmail"] = $email;



    


?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CY-Rencontres</title>
    <link rel="stylesheet" type="text/css" href="js-css/Autilisateur.css">
    <link rel="icon" type="image/png" href="image/LOGOCY.png">
    
</head>
<body>
    <!-- barre séléction -->
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

    <div id="containerB">
        <div id="Lprofil"><!-- mode modification profil -->
            <?php if($_SESSION['edit_mode']): ?>
                <form action="Amodifier_profil.php" method="POST">

                    <input type="file" id="photo_profil" name="photo_profil"><br>

                    <label for="pseudo">Pseudo:</label>
                    <input type="text" id="pseudo" name="pseudo" value="<?= htmlspecialchars($pseudo) ?>"><br><br>

                    <label for="description">Description:</label>
                    <textarea id="description" name="description"><?= htmlspecialchars($description) ?></textarea><br><br>

                    <label for="mdp">Mot de passe:</label>
                    <input type="password" id="mdp" name="mdp" value="<?= htmlspecialchars($mdp) ?>"><br><br>

                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?= htmlspecialchars($email) ?>"><br><br>

                    <label for="num">Numéro de téléphone:</label>
                    <input type="text" id="num" name="num" value="<?= htmlspecialchars($num) ?>"><br><br>

                    <label for="naissance">Âge:</label>
                    <input type="text" id="naissance" name="naissance" value="<?= htmlspecialchars($naissance) ?>"><br><br>

                    <label for="type_relation">Type de relation recherché:</label>
                    <input type="text" id="type_relation" name="type_relation" value="<?= htmlspecialchars($type_relation) ?>"><br><br>

                    <label for="profession">Profession:</label>
                    <input type="text" id="profession" name="profession" value="<?= htmlspecialchars($profession) ?>"><br><br>

                    <label for="lieu_residence">Lieu de résidence:</label>
                    <input type="text" id="lieu_residence" name="lieu_residence" value="<?= htmlspecialchars($lieu_residence) ?>"><br><br>

                    <?php $_SESSION['emailUtilisateur'] = htmlspecialchars($email); ?>

                    <input type="submit" value="Enregistrer">
                </form>
            <?php else: ?>
                <a href="Autilisateur.php?email=<?= htmlspecialchars($email) ?>&edit=true">(Modifier le profil)</a>
                <h2>Profil de <?= htmlspecialchars($pseudo) ?></h2>
                <img src="image/<?= htmlspecialchars($photo) ?>" alt="Photo de profil" class="Pimage">
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
            <?php endif; ?><!-- mode non modification -->
        </div> 

    <div id="Amessagerie"></div>


    <div id="boxMessagerie">
        <div id="containerMessagerie">
            <div id="contacts">
                <h2>CONTACTS</h2>
                <div id="contactErreur"></div>



                    <?php
                        //n'affiche pas en cas de banissement
                        $fichier2 = fopen("data/bannissement.txt", "r");
                        $bannis = [];
                        while (($Email = fgets($fichier2)) !== false) {
                            $bannis[] = trim($Email);
                        }
                        fclose($fichier2);

                        $fichier = fopen("data/utilisateurs.txt", "r");

                        //Lecture du fichier Ligne par Ligne
                        while (($Ligne = fgets($fichier)) !== false) {
                            $Ligne = explode(";", trim($Ligne));

                            //Vérification des indices et !=sexe et ==type_relation
                            if (isset($Ligne[4]) && isset($Ligne[8])) {
                                if ( htmlspecialchars($sexe) != $Ligne[4] && htmlspecialchars($type_relation) == $Ligne[8]) {
                                    //Verification si l'utilisateur est banni
                                    if (!in_array($Ligne[0], $bannis)) { 
                                  ?>
                                  <!--<div id="user_print" onclick="contact(this)">-->
                                  <div class="user_print active" data-id="<?= $Ligne[0] ?>"><!--On peut rajouter d'autres champs si on le souhaite -->
                                      <p><img src="image/<?= $Ligne[10] ?>" class="image"><b><?= $Ligne[2] ?></b></p>
                                  </div>
                                  <?php
                                    }
                                }
                            }
                        }
                        fclose($fichier);
                    ?>

                </div>

                <div id="conversation">
                    <h2>CONVERSATION</h2>
                    
                    <div id="zone_message">
                    <div id="destinataireChoisi">
                        <p>Bienvenue sur la messagerie de CY-Rencontres, et voici les contacts que vous pouvez sélectionner</p>
                        <div id="containerlogo"><img id="logoMessagerie" src="image/messagerie.png" alt="Logo de la messagerie"></div>
                    </div>

                    <div id="messagesContainer">
                        
                    </div>


                </div>
            </div>
        </div>
   </div>

    <div>
        <div id="containerBouton">
            <span class="boutonUtilisateur"><a href="Ugestion.php">Page utilisateurs</a></span>
            <span class="boutonUtilisateur"><button id="bannirProfil">Bannir l'utilisateur</button></span>
            <span class="boutonUtilisateur"><button id="debannirProfil">Débannir l'utilisateur</button></span>
            <span  class="boutonUtilisateur"><button id="supprimerProfil">Supprimer le compte</button></span>
        </div>
    </div>


   <script type="text/javascript">
        var emailUtilisateur = "<?php echo htmlspecialchars($email); ?>"; //envoie de la variable a fichier externe Autilisateur.js
    </script>

   
    <script src="js-css/Autilisateur.js"></script>
</body>
</html>

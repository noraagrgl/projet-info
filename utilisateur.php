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

    <a href="Urecherche.php">Recherche</a>

    <div id="gestionDiv"></div>

      <h1>Bienvenue <?= $_SESSION['pseudo'] ?> </h1>
      <br><br><br>



      <?php

      $fichier=fopen("data/utilisateurs.txt", "r");

      //lecture du fichier ligne par ligne et s'arrete a la fin quand fgetcsv renvoie faux
      while (($ligne = fgets($fichier)) !== false) {

            $ligne = explode(";", trim($ligne));

            if(isset($ligne[4]) && isset($ligne[8])) {

                //Verification pour presenter le sexe oppose
                if($_SESSION["sexe"] != $ligne[4]){
                    //Verification pour presenter le meme type de relation
                    if($_SESSION["type_relation"] == $ligne[8]){
                        //Afficher cet utilisateur pseudo + description

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

      ?>

      <!--<p><b><?= $user_print['pseudo'] ?></b></p>-->

    <script>
        var abonnement = "<?php echo $abonnement; ?>";
    </script>
    <script src="js-css/utilisateur.js"></script>
</body>
</html>

<?php
    session_start();

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CY-Rencontres</title>
    <link rel="stylesheet" type="text/CSS" href="utilisateur.css">
    <script src="utilisateur.js"></script>
</head>
<body>

    <div id="containerA">
        <span id="Accueil" class="bouton"> <a href="utilisateur.php">Accueil</a></span>
        <span id="Profil" class="bouton"> <a href="Uprofil.php">Profil</a></span>
        <span id="Messagerie" class="bouton"> <a href="Umessagerie.php">Messagerie</a></span>
        <span id="Parametres" class="bouton"> <a href="Uparametre.php">Paramètres</a></span>
        <span id="Deconnexion" class="bouton"> <a href="deconnexion.php">Déconnexion</a></span>
    </div>





      <h1>Bienvenue <?= $_SESSION['pseudo'] ?> </h1>

    
    

      <?php
      /*
      //lecture du fichier ligne par ligne et s'arrete a la fin quand fgetcsv renvoie faux
      while (($ligne = fgetcsv($fichier)) !== false) {

            //Verification pour presenter le sexe oppose
            if($_SESSION["sexe"] != $ligne[4]){
              //Afficher cet utilisateur pseudo + description
              //Crer un "dictionnaire" ou on va mettre ces personnes pour les recuperer plus tard dans la page
              global $user_print = (
                "pseudo" => $ligne[2];
                "description" => $ligne[9];
              );
          }
      }
      */  
      ?>

      <!--<p><b><?= $user_print['pseudo'] ?></b></p>-->

</body>
</html>

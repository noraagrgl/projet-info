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
      <h1>Bienvenue <?= $_SESSION['pseudo'] ?> </h1>

      <h2>Profil</h2>

      <p>Pseudo: <?= $_SESSION['pseudo'] ?></p>
      <p>Email: <?= $_SESSION['email'] ?></p>
      <p>Date d'inscription: <?= $_SESSION['date_inscription'] ?></p>
      <p>Sexe: <?= $_SESSION['sexe'] ?></p>

      <h2>Vous pouvez rencontrer: </h2>

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

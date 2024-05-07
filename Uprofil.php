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
    <link rel="stylesheet" type="text/CSS" href="Uprofil.css">
    <script src="Uprofil.js"></script>
</head>
<body>
     <div id="containerA">
        <span id="Accueil" class="bouton"> <a href="utilisateur.php">Accueil</a></span>
        <span id="Profil" class="bouton"> <a href="Uprofil.php">Profil</a></span>
        <span id="Messagerie" class="bouton"> <a href="Umessagerie.php">Messagerie</a></span>
        <span id="Parametres" class="bouton"> <a href="Uparametre.php">Paramètres</a></span>
        <span id="Deconnexion" class="bouton"> <a href="acceuil.html">Déconnexion</a></span>
    </div>

      <h1>Profil</h1>





      <div id="main">
          <p><b>Photo de profil:</b> <?= $_SESSION['photo_profil'] ?></p>
          <p><b>Pseudo:</b> <?= $_SESSION['pseudo'] ?></p>
          <p><b>Description:</b> <?= $_SESSION['description'] ?></p>
          <p><b>Mot de passe:</b> <?= $_SESSION['mdp'] ?></p>
          <p><b>Email:</b> <?= $_SESSION['email'] ?></p>
          <p><b>Numéro de téléphone:</b> <?= $_SESSION['num'] ?></p>
          <p><b>Age:</b> <?= $_SESSION['naissance'] ?></p>
          <p><b>Type de relation recherché:</b> <?= $_SESSION['type_relation'] ?></p>
          <p><b>Profession:</b> <?= $_SESSION['profession'] ?></p>
          <p><b>Lieu de résidence:</b> <?= $_SESSION['lieu_residence'] ?></p>
          <p><b>Date d'inscription:</b> <?= $_SESSION['date_inscription'] ?></p>
          
     </div>



</body>
</html>

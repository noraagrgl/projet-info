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
 
</body>
</html>

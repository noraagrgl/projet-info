<?php
session_start();

// Vérifie si l'utilisateur a cliqué sur le lien "Modifier"
if(isset($_GET['edit']) && $_GET['edit'] === 'true') {
    $_SESSION['edit_mode'] = true;
} else {
    $_SESSION['edit_mode'] = false;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CY-Rencontres</title>
    <link rel="stylesheet" type="text/CSS" href="js-css/Uprofil.css">
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

    <h1>Profil</h1>

    <div id="main">
        <?php if($_SESSION['edit_mode']): ?>
            <form action="modifier_profil.php" method="POST">
                <label for="pseudo">Pseudo:</label>
                <input type="text" id="pseudo" name="pseudo" value="<?= $_SESSION['pseudo'] ?>"><br>

                <label for="description">Description:</label>
                <textarea id="description" name="description"><?= $_SESSION['description'] ?></textarea><br>

                <label for="mdp">Mot de passe:</label>
                <input type="password" id="mdp" name="mdp" value="<?= $_SESSION['mdp'] ?>"><br>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?= $_SESSION['email'] ?>"><br>

                <label for="num">Numéro de téléphone:</label>
                <input type="text" id="num" name="num" value="<?= $_SESSION['num'] ?>"><br>

                <label for="naissance">Âge:</label>
                <input type="text" id="naissance" name="naissance" value="<?= $_SESSION['naissance'] ?>"><br>

                <label for="type_relation">Type de relation recherché:</label>
                <input type="text" id="type_relation" name="type_relation" value="<?= $_SESSION['type_relation'] ?>"><br>

                <label for="profession">Profession:</label>
                <input type="text" id="profession" name="profession" value="<?= $_SESSION['profession'] ?>"><br>

                <label for="lieu_residence">Lieu de résidence:</label>
                <input type="text" id="lieu_residence" name="lieu_residence" value="<?= $_SESSION['lieu_residence'] ?>"><br>

                <input type="submit" value="Enregistrer">
            </form>
        <?php else: ?>
            <p><b>Pseudo:</b> <?= $_SESSION['pseudo'] ?> <a href="Uprofil.php?edit=true">(Modifier)</a></p>
            <p><b>Description:</b> <?= $_SESSION['description'] ?></p>
            <p><b>Mot de passe:</b> <?= $_SESSION['mdp'] ?></p>
            <p><b>Email:</b> <?= $_SESSION['email'] ?></p>
            <p><b>Numéro de téléphone:</b> <?= $_SESSION['num'] ?></p>
            <p><b>Âge:</b> <?= $_SESSION['naissance'] ?></p>
            <p><b>Type de relation recherché:</b> <?= $_SESSION['type_relation'] ?></p>
            <p><b>Profession:</b> <?= $_SESSION['profession'] ?></p>
            <p><b>Lieu de résidence:</b> <?= $_SESSION['lieu_residence'] ?></p>
            <p><b>Date d'inscription:</b> <?= $_SESSION['date_inscription'] ?></p>
        <?php endif; ?>
    </div>
</body>
</html>

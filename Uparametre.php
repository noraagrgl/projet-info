<?php
    session_start();
   // Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Récupère les données du formulaire
    $id = $_POST['pseudo']; // Identifiant de la ligne à modifier
    $new_data = array(
        $_POST['pseudo']
        // Ajoutez ici autant de colonnes que nécessaire
    );

    // Lit le fichier CSV
    $fichier = 'utilisateurs.csv';
    $csv_data = array_map('str_getcsv', file($fichier));

    // Modifie la ligne appropriée
    if (isset($csv_data[$id])) {
        $csv_data[$id] = $new_data;
    } else {
        // Gérer le cas où l'ID spécifié n'existe pas
    }

    // Réécrit le fichier CSV
    $file = fopen($fichier, 'w');
    foreach ($csv_data as $ligne) {
        fputcsv($file, $ligne);
    }
    fclose($file);

    echo "Modification effectuée avec succès.";
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
        <span id="Deconnexion" class="bouton"> <a href="deconnexion.php">Déconnexion</a></span>
    </div>

      <h1>Profil</h1>





      <div id="main">

        <p><b>Email:</b> <?= $_SESSION['email'] ?></p>

         <form action="Uprofil.php" method="post">
            <label for="email">Pseudo : </label>
            <input type="text" id="pseudo" name="pseudo" required><br>
            <input id="boutonEnvoie" type="submit" value="Modifier">
        </form>




        <p><b>Photo de profil:</b> <?= $_SESSION['photo_profil'] ?></p>
        <p><b>Pseudo:</b> <?= $_SESSION['pseudo'] ?></p>
        <p><b>Description:</b> <?= $_SESSION['description'] ?></p>
        <p><b>Mot de passe:</b> <?= $_SESSION['mdp'] ?></p>
     
        <p><b>Numéro de téléphone:</b> <?= $_SESSION['num'] ?></p>
        <p><b>Age:</b> <?= $_SESSION['naissance'] ?></p>
        <p><b>Type de relation recherché:</b> <?= $_SESSION['type_relation'] ?></p>
        <p><b>Profession:</b> <?= $_SESSION['profession'] ?></p>
        <p><b>Lieu de résidence:</b> <?= $_SESSION['lieu_residence'] ?></p>
        <p><b>Date d'inscription:</b> <?= $_SESSION['date_inscription'] ?></p>

     </div>



</body>
</html>

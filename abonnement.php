<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupère les données du formulaire
    $email = $_POST["email"];
    $num = $_POST["num"];
    $pseudo = $_POST["pseudo"];
    $mdp = $_POST["mdp"];
    $sexe = $_POST["sexe"];
    $naissance = $_POST["naissance"];
    $profession = $_POST["profession"];
    $lieu_residence = $_POST["lieu_residence"];
    $type_relation = $_POST["type_relation"];
    $description = $_POST["description"];
    $photo_profil = $_POST["photo_profil"];
    $abonnement = $_POST["abonnement"];
    $date_inscription = date("Y-m-d");

    // Vérification de l'âge
    $today = new DateTime();
    $birthDate = new DateTime($naissance);
    $age = $today->diff($birthDate)->y;

    // Vérifie l'âge de la personne
    if ($age < 18) {
        echo "Erreur : Vous devez avoir au moins 18 ans pour vous inscrire.";
        exit;
    }
    // Vérifie la longueur du pseudo
    if (strlen($pseudo) < 3){
        echo "Erreur : Le pseudo doit contenir minimum 3 caractères." ;
        exit;
    }
    // Date d'abonnement
    $date_abonnement = ""; // Initialisation de la date d'abonnement
    if (in_array($abonnement, ["mensuel", "trimestriel", "annuel"])) {
        $date_abonnement = date("Y-m-d"); // Date de souscription à l'abonnement
    }

    $fichier = "data/utilisateurs.txt";
    // Vérifie si le fichier existe
    if (!file_exists($fichier)) {
        echo ("Erreur : Le fichier txt n'existe pas.");
        exit;
    }

    $utilisateurs = file($fichier, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    
    // Parcourt tous les utilisateurs pour vérifier les doublons
    foreach ($utilisateurs as $utilisateur) {
        $fields = explode(';', $utilisateur);
        $savedEmail = $fields[0];
        $savedNum = $fields[1];
        $savedPseudo = $fields[2];
        
        // Vérifie si l'email est déjà utilisé        
        if ($savedEmail == $email) {
            echo "Erreur : L'email est déjà utilisé.";
            exit;
        }
        // Vérifie si le numéro est déjà utilisé
        if ($savedNum == $num) {
            echo "Erreur : Le numéro de téléphone est déjà utilisé.";
            exit;
        }
        // Vérifie si le pseudo est déjà utilisé
        if ($savedPseudo == $pseudo) {
            echo "Erreur : Le pseudo est déjà utilisé.";
            exit;
        }
    }

    // Création de la chaîne de données à enregistrer dans le fichier utilisateurs.txt
    $data = "$email;$num;$pseudo;$mdp;$sexe;$naissance;$profession;$lieu_residence;$type_relation;$description;$photo_profil;$abonnement;$date_inscription;$date_abonnement\n";

    // Écriture des données dans le fichier
    $fichierHandle = fopen($fichier, "a");

    // Vérifie si l'ouverture du fichier est réussie
    if ($fichierHandle) {
        fwrite($fichierHandle, $data);
        fclose($fichierHandle);
        echo ("Les informations ont été enregistrées avec succès.");
        header("Location: acceuil.html"); // Correction de la redirection
        exit; // Terminer le script après la redirection
    } else {
        echo ("Erreur : Impossible d'ouvrir le fichier txt.");
    }
} else {
    echo "Erreur : Le formulaire n'a pas été soumis.";
}

?>

<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: acceuil.html");
    exit;
}

// Recuperation des variables $_POST

if ($_SERVER["REQUEST_METHOD"] == "POST"){

    $nouveauPseudo = isset($_POST['pseudo']) ? $_POST['pseudo'] : "";
    $nouvelleDescription = isset($_POST['description']) ? $_POST['description'] : "";
    $nouveauMotDePasse = isset($_POST['mdp']) ? $_POST['mdp'] : "";
    $nouveauEmail = isset($_POST['email']) ? $_POST['email'] : "";
    $nouveauNum = isset($_POST['num']) ? $_POST['num'] : "";
    $nouveauNaissance = isset($_POST['naissance']) ? $_POST['naissance'] : "";
    $nouveauTypeRelation = isset($_POST['type_relation']) ? $_POST['type_relation'] : "";
    $nouvelleProfession = isset($_POST['profession']) ? $_POST['profession'] : "";
    $nouveauLieuResidence = isset($_POST['lieu_residence']) ? $_POST['lieu_residence'] : "";
    $nouvellePhoto = isset($_POST['photo_profil']) ? $_POST['photo_profil'] : "";

    error_log("nouveauPseudo = ".$nouveauPseudo);
    error_log("nouvelleDescription = ".$nouvelleDescription);




    $emailCible = $_SESSION['emailUtilisateur'];
    error_log("emailCible = ".$emailCible);


    $fichier = file("data/utilisateurs.txt");
    $nouveauFichier = "";

    //Modification du fichier "data/utilisateurs.txt"
    foreach ($fichier as $ligne) {
        $donnees = explode(";", trim($ligne));
        if ($donnees[0] == $emailCible) {
            // Remplacer l'ancienne ligne par la nouvelle ligne mise à jour
            $donnees[2] = ($nouveauPseudo !== "") ? $nouveauPseudo : $donnees[2];
            $donnees[9] = ($nouvelleDescription !== "") ? $nouvelleDescription : $donnees[9];
            $donnees[3] = ($nouveauMotDePasse !== "") ? $nouveauMotDePasse : $donnees[3];
            $donnees[0] = ($nouveauEmail !== "") ? $nouveauEmail : $donnees[0];
            $donnees[1] = ($nouveauNum !== "") ? $nouveauNum : $donnees[1];
            $donnees[5] = ($nouveauNaissance !== "") ? $nouveauNaissance : $donnees[5];
            $donnees[8] = ($nouveauTypeRelation !== "") ? $nouveauTypeRelation : $donnees[8];
            $donnees[6] = ($nouvelleProfession !== "") ? $nouvelleProfession : $donnees[6];
            $donnees[7] = ($nouveauLieuResidence !== "") ? $nouveauLieuResidence : $donnees[7];
            $donnees[10] = ($nouvellePhoto !== "") ? $nouvellePhoto : $donnees[10];
            // Reconstruire la ligne et ajouter au nouveau fichier
            $nouveauFichier .= implode(";", $donnees) . "\n";
        } else {
            // Ajouter les autres lignes sans modification
            $nouveauFichier .= $ligne;
        }
    }

    // Réécriture du fichier avec les données mises à jour
    file_put_contents("data/utilisateurs.txt", $nouveauFichier);
    
    // Redirige l'utilisateur vers la page de profil
    header("Location: Autilisateur.php?email=" . urlencode($emailCible));
    exit;
} else {
    header("Location: acceuil.html");
    exit;
}
?>

<?php
session_start();

if(isset($_POST['pseudo']) || isset($_POST['description']) || isset($_POST['mdp']) || isset($_POST['email']) || isset($_POST['num']) || isset($_POST['naissance']) || isset($_POST['type_relation']) || isset($_POST['profession']) || isset($_POST['lieu_residence'])) {

    $nouveauPseudo = isset($_POST['pseudo']) ? $_POST['pseudo'] : "";
    $nouvelleDescription = isset($_POST['description']) ? $_POST['description'] : "";
    $nouveauMotDePasse = isset($_POST['mdp']) ? $_POST['mdp'] : "";
    $nouveauEmail = isset($_POST['email']) ? $_POST['email'] : "";
    $nouveauNum = isset($_POST['num']) ? $_POST['num'] : "";
    $nouveauNaissance = isset($_POST['naissance']) ? $_POST['naissance'] : "";
    $nouveauTypeRelation = isset($_POST['type_relation']) ? $_POST['type_relation'] : "";
    $nouvelleProfession = isset($_POST['profession']) ? $_POST['profession'] : "";
    $nouveauLieuResidence = isset($_POST['lieu_residence']) ? $_POST['lieu_residence'] : "";

    // Ouvrir le fichier txt en mode lecture et écriture
    $fichier = file("data/utilisateurs.txt");
    $nouveauFichier = "";

    foreach ($fichier as $ligne) {
        $donnees = explode(";", trim($ligne));
        if ($donnees[0] == $_SESSION['email']) {
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
            // Reconstruire la ligne et ajouter au nouveau fichier
            $nouveauFichier .= implode(";", $donnees);
        } else {
            // Ajouter les autres lignes sans modification
            $nouveauFichier .= $ligne;
        }
    }

    // Réécrire le fichier avec les données mises à jour
    file_put_contents("data/utilisateurs.txt", $nouveauFichier);

    // Mettre à jour la session avec les nouvelles informations
    $_SESSION['pseudo'] = $nouveauPseudo;
    $_SESSION['description'] = $nouvelleDescription;
    $_SESSION['mdp'] = $nouveauMotDePasse;
    $_SESSION['email'] = $nouveauEmail;
    $_SESSION['num'] = $nouveauNum;
    $_SESSION['naissance'] = $nouveauNaissance;
    $_SESSION['type_relation'] = $nouveauTypeRelation;
    $_SESSION['profession'] = $nouvelleProfession;
    $_SESSION['lieu_residence'] = $nouveauLieuResidence;

    // Rediriger l'utilisateur vers la page de profil
    header("Location: Uprofil.php");
    exit;
} else {
    header("Location: acceuil.html");
    exit;
}
?>

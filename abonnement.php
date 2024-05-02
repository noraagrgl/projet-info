<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    



    $fichier_csv = "utilisateurs.csv";
    
    $fichier = fopen($fichier_csv, "a");

    if ($fichier) {

        fputcsv($fichier, array($email, $num, $pseudo, $mdp, $sexe, $naissance, $profession, $lieu_residence, $type_relation, $description, $photo_profil, $abonnement, $date_inscription));
        
        fclose($fichier);
        
        echo "Les informations ont été enregistrées avec succès.";
        header("location: acceuil.html");
    } else {
        echo "Erreur : Impossible d'ouvrir le fichier CSV.";
    }
} else {
    echo "Erreur : Le formulaire n'a pas été soumis.";
}
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $num = $_POST["num"];
    $pseudo = $_POST["pseudo"];
    $mdp = $_POST["mdp"];
    $sexe = $_POST["sexe"];
    $naissance = $_POST["naissance"];
    $nbEnfants = $_POST["nbEnfants"];
    $profession = $_POST["profession"];
    $lieu_residence = $_POST["lieu_residence"];
    $situation_amoureuse = $_POST["situation_amoureuse"];
    $description = $_POST["description"];
    $photo_profil = $_POST["photo_profil"];
    $abonnement = $_POST["abonnement"];
    
 
    $fichier_csv = "utilisateurs.csv";
    
    $fichier = fopen($fichier_csv, "a");
    
  
    if ($fichier) {
     
        fputcsv($fichier, array($email, $num, $pseudo, $mdp, $sexe, $naissance, $nbEnfants, $profession, $lieu_residence, $situation_amoureuse, $description, $photo_profil, $abonnement));
        
        // Fermer le fichier
        fclose($fichier);
        
        echo "Les informations ont été enregistrées avec succès.";
    } else {
        echo "Erreur : Impossible d'ouvrir le fichier CSV.";
    }
} else {
    echo "Erreur : Le formulaire n'a pas été soumis.";
}
?>

<?php
session_start();

// Activez les rapports d'erreurs pour le débogage
error_reporting(E_ALL);
ini_set('display_errors', 1);

// En-tête JSON
header('Content-Type: application/json');

// Vérifiez que le pseudo est défini et qu'il contient au moins 3 lettres
if (isset($_POST['recherchePseudo']) && strlen($_POST['recherchePseudo']) >= 3) {
    $pseudoRecherche = $_POST['recherchePseudo'];
} else {
    echo json_encode(array('success' => false, 'message' => 'Le pseudo doit contenir au moins 3 lettres.'));
    exit;
}

// Ouvrir le fichier txt
$utilisateurs = array();
if (($fichier = fopen("data/utilisateurs.txt", "r")) !== false) {
    while (($ligne = fgets($fichier)) !== false) {

        $ligne = explode(";", trim($ligne));
        
        if (stripos($ligne[2], $pseudoRecherche) === 0) {
            // Vérifiez que la session contient une photo de profil
            $photoProfil = isset($_SESSION['photo_profil']) && !empty($_SESSION['photo_profil']) ? 'image/'.$ligne[10] : 'image/default_photo.jpg';
            $utilisateurs[] = array(
                'pseudo' => $ligne[2],
                'photo_profil' => $photoProfil,
                'profile_url' => 'profile.php?user=' . urlencode($ligne[2]) // Assuming the URL format
            );
        }
    }
    fclose($fichier);
}

// Si des utilisateurs ont été trouvés, les renvoyer
if (count($utilisateurs) > 0) {
    echo json_encode(array('success' => true, 'utilisateurs' => $utilisateurs));
} else {
    echo json_encode(array('success' => false, 'message' => 'Aucun pseudos de ce type ne figurent dans les données.'));
}
?>

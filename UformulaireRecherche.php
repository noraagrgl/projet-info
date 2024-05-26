<?php
session_start();

// Rapports d'erreurs pour le débogage
error_reporting(E_ALL);
ini_set('display_errors', 1);

// En-tête JSON
header('Content-Type: application/json');

// Vérifie que le pseudo est défini et qu'il contient au moins 3 lettres
if (isset($_POST['recherchePseudo']) && strlen($_POST['recherchePseudo']) >= 3) {
    $pseudoRecherche = $_POST['recherchePseudo'];
} else {
    echo json_encode(array('success' => false, 'message' => 'Le pseudo doit contenir au moins 3 lettres.'));
    exit;
}



// N'affiche pas s'il est banni
$fichier2 = fopen("data/bannissement.txt", "r");
$bannis = [];
while (($email = fgets($fichier2)) !== false) {
    $bannis[] = trim($email);
}
fclose($fichier2);




// Ouvrir le fichier txt
$utilisateurs = array();
if (($fichier = fopen("data/utilisateurs.txt", "r")) !== false) {
    while (($ligne = fgets($fichier)) !== false) {

        $ligne = explode(";", trim($ligne));

        if (!in_array($ligne[0], $bannis)) {
        
            if (stripos($ligne[2], $pseudoRecherche) === 0) {
                // Vérifiez que la session contient une photo de profil
                $photoProfil = isset($_SESSION['photo_profil']) && !empty($_SESSION['photo_profil']) ? 'image/'.$ligne[10] : 'image/default_photo.jpg';
                $utilisateurs[] = array(
                    'pseudo' => $ligne[2],
                    'photo_profil' => $photoProfil,
                    'email' => $ligne[0]
                );
            }
        }
    }
    fclose($fichier);
}

// Si des utilisateurs ont été trouvés, les renvoyer au fichier Urecherche.php
if (count($utilisateurs) > 0) {
    echo json_encode(array('success' => true, 'utilisateurs' => $utilisateurs));
} else {
    echo json_encode(array('success' => false, 'message' => 'Aucun pseudos de ce type ne figurent dans les données.'));
}
?>

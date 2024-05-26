<?php

// Vérifie si les données POST sont définies
if (isset($_POST["email"]) && isset($_POST["mot_de_passe"])) {

    $fichier = fopen("data/utilisateurs.txt", "r");
    $utilisateurTrouve = false;

    // Lecture du fichier ligne par ligne
    while (($ligne = fgets($fichier)) !== false) {
        $ligne = explode(";", trim($ligne));

        // Vérification de l'email
        if ($_POST["email"] == $ligne[0]) {
            // Vérification du mot de passe (utilisez password_verify si les mots de passe sont hachés)
            if ($_POST["mot_de_passe"] == $ligne[3]) {

                session_start();

                // Stocke les données de l'utilisateur dans la session
                $_SESSION['email'] = $ligne[0];
                $_SESSION['num'] = $ligne[1];
                $_SESSION['pseudo'] = $ligne[2];
                $_SESSION['mdp'] = $ligne[3];
                $_SESSION['sexe'] = $ligne[4];
                $_SESSION['naissance'] = $ligne[5];
                $_SESSION['profession'] = $ligne[6];
                $_SESSION['lieu_residence'] = $ligne[7];
                $_SESSION['type_relation'] = $ligne[8];
                $_SESSION['description'] = $ligne[9];
                $_SESSION['photo_profil'] = $ligne[10];
                $_SESSION['abonnement'] = $ligne[11];
                $_SESSION['date_inscription'] = $ligne[12];

                if (isset($ligne[13])) {
                    $_SESSION['date_abonnement'] = $ligne[13];
                }

                $_SESSION['loggedin'] = true;

                // Les identifiants sont corrects
                $utilisateurTrouve = true;
                break;
            } else {
                // Le mot de passe est incorrect
                echo json_encode(array('success' => false, 'message' => 'Mot de passe incorrect'));
                exit;
            }
        }
    }

    fclose($fichier);

    // Si l'email n'a pas été trouvé dans le fichier
    if (!$utilisateurTrouve) {
        echo json_encode(array('success' => false, 'message' => 'Adresse email incorrecte'));
        exit;
    }
} else {
    // Si les données POST ne sont pas définies
    echo json_encode(array('success' => false, 'message' => 'Erreur lors de la soumission du formulaire'));
    exit;
}

// Si tout s'est bien passé, les identifiants sont corrects
echo json_encode(array('success' => true));

?>

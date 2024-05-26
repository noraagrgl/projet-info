<?php

//___________________________________________________________________________
//                        BANNISSEMENT D'UN COMPTE
//___________________________________________________________________________

if (isset($_POST['email'])) {
    $email = trim($_POST['email']);
    $fichier = "data/bannissement.txt";

    // Lire le fichier pour vérifier si l'email existe déjà
    $handle = fopen($fichier, "r");
    $emailExistant = false;

    if ($handle) {
        while (($email_fichier = fgets($handle)) !== false) {
            if ($email == trim($email_fichier)) {
                $emailExistant = true;
                break;
            }
        }
        fclose($handle);
    } else {
        echo "Impossible d'ouvrir le fichier.";
        exit;
    }

    if (!$emailExistant) {
        // Ajouter l'email au fichier
        $handle = fopen($fichier, "a");
        if ($handle) {
            fwrite($handle, $email . "\n");
            fclose($handle);
            echo "L'utilisateur avec l'email $email a bien été enregistré.";
        } else {
            echo "Impossible d'ouvrir le fichier.";
        }
    } else {
        echo "L'utilisateur avec l'email $email est déjà banni.";
    }
} else {
    echo "L'email n'a pas été correctement récupéré.";
}
?>

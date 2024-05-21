<?php

//___________________________________________________________________________
//                        DEBANNISSEMENT D'UN COMPTE
//___________________________________________________________________________

// Création d'un autre fichier temporaire pour recopier tout du fichier original hormis le compte qu'on souhaite supprimer

if (isset($_POST['email'])) {

    $email = trim($_POST['email']); //Utilisation de trim pour supprimer les espaces inutiles

    $fichier = "data/bannissement.txt";
    $fichierTemp = "data/bannissement_temp.txt"; 

    $handle = fopen($fichier, "r");
    $handleTemp = fopen($fichierTemp, "w"); 

    if ($handle && $handleTemp) {
        while (($ligne = fgets($handle)) !== false) {           
            
            error_log("L'email est " . $email . " et la ligne est " . $ligne);
            if ($email != trim($ligne)) { // Utilisation de trim pour chaque ligne lue
                fwrite($handleTemp, $ligne);
            }

        }
        fclose($handle);
        fclose($handleTemp);

        unlink($fichier);
        rename($fichierTemp, $fichier);

        echo "Le compte avec l'email $email a bien été débanni.";
    } else {
        echo "Impossible d'ouvrir les fichiers.";
    }
} else {
    echo "L'email n'a pas été correctement récupéré.";
}

?>

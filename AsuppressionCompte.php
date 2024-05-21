<?php

//___________________________________________________________________________
//                        SUPPRESSION D'UN COMTPE
//___________________________________________________________________________

//Creation d'un autre fichier temporaire pour recopier tout du fichier origial hormis le compte qu'on souhaite supprimer 

if(isset($_POST['email'])) {

    $email = $_POST['email'];

    $fichier = "data/utilisateurs.txt";
    $fichierTemp = "data/utilisateurs_temp.txt"; 

    $handle = fopen($fichier, "r");
    $handleTemp = fopen($fichierTemp, "w"); 

    if ($handle && $handleTemp) {
        while (($ligne = fgets($handle)) !== false) {           
            $elements = explode(";", $ligne);
            
            error_log($email.$ligne[0]);
            if ($email != $elements[0]) {
                fwrite($handleTemp, $ligne);
            }

        }
        fclose($handle);
        fclose($handleTemp);

        unlink($fichier);
        rename($fichierTemp, $fichier);

        echo "Le compte avec l'email $email a été supprimée.";
    } 
    else {
        echo "Impossible d'ouvrir les fichiers.";
    }
}
else {
    echo "l'email n'a pas été correctement récupéré.";
}

?>

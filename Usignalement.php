<?php

//___________________________________________________________________________
//                        ENREGISTREMENT DES SIGNALEMENTS
//___________________________________________________________________________

$messageSignalement=$_POST['messageSignalement'];

error_log("messageSignalement = ".$messageSignalement);


if(isset($_POST['messageSignalement'])) {

    $messageSignalement = $_POST['messageSignalement'];

    $fichier = "signalement.txt";
 

    $handle = fopen($fichier, "a");


    if ($handle) {
        fwrite($handle, $messageSignalement);
        fclose($handle);
        echo ("Les informations ont été enregistrées avec succès.");
    }
    else {
        echo "Impossible d'ouvrir les fichiers.";
    }
}

else {
    echo "Le messageSignalement n'a pas été correctement récupéré.";
}

?>

<?php

//___________________________________________________________________________
//                        BLOCAGE D'UN COMTPE
//___________________________________________________________________________
session_start();

error_log("formulaire ?______________________") ;

$emmetteur = $_SESSION['email'];

if(isset($_POST['UserId'])) {

    $destinataire = $_POST['UserId'];

    $fichier = "data/blocage.txt"; 

    $handle = fopen($fichier, "a");
     

    if ($handle) {

        fwrite($handle, $emmetteur.";"."$destinataire\n");

        fclose($handle);

        echo "L'utilisateur avec l'email $destinataire a bien été enregistré.";
    } 
    else {
        echo "Impossible d'ouvrir le fichier.";
    }
}
else {
    echo "L'email n'a pas été correctement récupéré.";
}

?>

<?php

//___________________________________________________________________________
//                        BANNISSEMENT D'UN COMTPE
//___________________________________________________________________________



if(isset($_POST['email'])) {

    $email = $_POST['email'];

    $fichier = "data/bannissement.txt"; 

    $handle = fopen($fichier, "a");
     

    if ($handle) {

        fwrite($handle, $email."\n");

        fclose($handle);

        echo "L'utilisateur avec l'email $email a bien été enregistré.";
    } 
    else {
        echo "Impossible d'ouvrir le fichier.";
    }
}
else {
    echo "L'email n'a pas été correctement récupéré.";
}

?>

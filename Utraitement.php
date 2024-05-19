<?php

//___________________________________________________________________________
//                    CREATION DU FICHIER CONVERSATION.TXT
//___________________________________________________________________________

session_start();

    $_SESSION['destinataire'] = $_POST['userId'];


    if ($_SERVER["REQUEST_METHOD"] == "POST") { 
        $emmeteur = $_SESSION["email"];
        $destinataire = $_POST["userId"];
        $message = $_POST["message"];
        $date_envoie = date("Y-m-d H:i:s");

        $data = "$emmeteur;$destinataire;$message;$date_envoie\n";

        $fichier = "data/conversation.txt";

        if (!file_exists($fichier)) {
            echo ("Erreur : Le fichier txt n'existe pas.");
        } 
        else {
            $fichierHandle = fopen($fichier, "a");

            if ($fichierHandle) {
                fwrite($fichierHandle, $data);
                fclose($fichierHandle);
                echo ("Les informations ont été enregistrées avec succès.");
            }                
            else {
                echo ("Erreur : Impossible d'ouvrir le fichier txt.");
            }                    
        }   
    }

    


?>

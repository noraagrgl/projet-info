<?php

//___________________________________________________________________________
//                    CREATION DU FICHIER CONVERSATION.TXT
//___________________________________________________________________________

session_start();
    // Stocke l'identifiant du destinataire dans la session
    $_SESSION['destinataire'] = $_POST['userId'];


    if ($_SERVER["REQUEST_METHOD"] == "POST") { 
        // Récupère les données du formulaire
        $emmeteur = $_SESSION["email"];
        $destinataire = $_POST["userId"];
        $message = $_POST["message"];
        $date_envoie = date("Y-m-d H:i:s");

        // Crée une chaîne de données à enregistrer dans le fichier de conversation
        $data = "$emmeteur;$destinataire;$message;$date_envoie\n";

        $fichier = "data/conversation.txt";

        // Vérifie si le fichier existe
        if (!file_exists($fichier)) {
            echo ("Erreur : Le fichier txt n'existe pas.");
        } 
        else {
            $fichierHandle = fopen($fichier, "a");

            if ($fichierHandle) {
                // Écrit les données dans le fichier
                fwrite($fichierHandle, $data);
                fclose($fichierHandle);
                // Affiche un message de succès
                echo ("Les informations ont été enregistrées avec succès.");
            }  
            // Message d'erreur si non réussi
            else {
                echo ("Erreur : Impossible d'ouvrir le fichier txt.");
            }                    
        }   
    }

    


?>

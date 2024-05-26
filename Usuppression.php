<?php

//___________________________________________________________________________
//                        SUPPRESSION D'UNE LIGNE
//___________________________________________________________________________

//Creation d'un autre fichier temporaire pour recopier tout du fichier origial hormis la ligne qu'on souhaite supprimer 

if(isset($_POST['messageId'])) {
    // Récupère l'identifiant du message à supprimer
    $messageId = $_POST['messageId'];
    // Chemins des fichiers de conversation original et temporaire
    $fichier = "data/conversation.txt";
    $fichierTemp = "data/conversation_temp.txt"; 
    // Ouvre les fichiers en lecture et écriture respectivement
    $handle = fopen($fichier, "r");
    $handleTemp = fopen($fichierTemp, "w"); 

    if ($handle && $handleTemp) {
        // Parcours chaque ligne du fichier original
        while (($ligne = fgets($handle)) !== false) {           
            $elements = explode(";", $ligne);
            // Convertit la date d'envoi du message en objet DateTime pour comparaison
            $dateEnvoie = new DateTime($elements[3]);//$element[3] correspond a la 4eme colonne du fichier conversation.txt (date_envoie)
            // Convertit l'identifiant du message en objet DateTime pour comparaison
            $messageDate = new DateTime($messageId);

            // Compare les dates d'envoi du message et messageId sous le meme format de date
            if ($dateEnvoie->format('Y-m-d H:i:s') != $messageDate->format('Y-m-d H:i:s')) {
                fwrite($handleTemp, $ligne);
            }
        }
        fclose($handle);
        fclose($handleTemp);

        unlink($fichier);//Supression du fichier original
        rename($fichierTemp, $fichier);//Renome le fichier temporaire en fichier original

        echo "La ligne contenant le message avec l'id $messageId a été supprimée.";
    } 
    else {
        echo "Impossible d'ouvrir les fichiers.";
    }
}
else {
    echo "messageId n'a pas été correctement récupéré.";
}

?>

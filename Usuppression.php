<?php
if(isset($_POST['messageId'])) {

    //On recupere messageId sous forme de chaine de caractere
    $messageId = strval($_POST['messageId']);

    $fichier = "conversation.txt";
    $fichierTemp = "conversation_temp.txt"; 

    $handle = fopen($fichier, "r");
    $handleTemp = fopen($fichierTemp, "w"); 

    if ($handle && $handleTemp) {
        while (($ligne = fgets($handle)) !== false) {	        
            $elements = explode(";", $ligne);

            $dateEnvoie = strval($elements[3]);

            //error_log("messageId = ".$messageId);
            //error_log("dateEnvoie = ".$dateEnvoie);

            if (isset($elements[3]) && $messageId != $dateEnvoie) {
                fwrite($handleTemp, $ligne); 
            }
        }
        fclose($handle);
        fclose($handleTemp);

        //unlink($fichier);
        rename($fichierTemp, $fichier);

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

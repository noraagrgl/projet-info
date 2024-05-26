<?php
    session_start();

    $email = $_SESSION["AdminConvEmail"];

    // Initialise un tableau vide
    $messages = array();

    // Vérifie si le fichier existe avant de lire
    if(file_exists("data/conversation.txt")) {
        // Lecture du fichier texte ligne par ligne
        $messages = file("data/conversation.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        if(!empty($messages)) {
            foreach ($messages as &$message) {
                // Ajoute l'email à la fin de chaque message
                $message .= ";" . $email;
            }

            // Envoie le contenu JSON au client
            header('Content-Type: application/json');
            echo json_encode(array('messages' => $messages));
        } else {
            // Retourne un tableau vide si aucun message
            header('Content-Type: application/json');
            echo json_encode(array('messages' => array()));
        }
    } else {
        // Retourne un tableau vide si le fichier n'existe pas
        header('Content-Type: application/json');
        echo json_encode(array('messages' => array()));
    }


?>

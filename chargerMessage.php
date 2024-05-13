<?php

//___________________________________________________________________________
//                      ENVOIE DES DONNEES JSON
//___________________________________________________________________________

session_start();

$emailSession = $_SESSION['email'];

//Initialise un tableau vide
$messages = array();

//Lecture du fichier texte ligne par ligne
$messages = file("conversation.txt");

if(!empty($messages)) {

    foreach ($messages as &$message) {
        //Retire le saut de ligne
        $message = rtrim($message); 
        //Ajoute l'email à la fin de chaque message
        $message .= ";" . $emailSession;
    }

    header('Content-Type: application/json');
    echo json_encode(array('messages' => $messages));
} 
else {
    //Retourne un tableau vide si aucun messages
    header('Content-Type: application/json');
    echo json_encode(array());
}
?>

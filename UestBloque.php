<?php

// Vérifie si l'ID utilisateur est défini dans les données POST
if (isset($_POST["UserId"])) {
    $destinataire = $_POST["UserId"];
    error_log("UserId reçu : " . $destinataire);
} else {
    // Si l'ID utilisateur n'est pas défini dans les données POST, retourne une erreur JSON
    echo json_encode(["bloqueSuccess" => false, "error" => "UserId non défini"]);
    exit;
}
// Ouvre le fichier contenant la liste des utilisateurs bloqués en mode lecture
$fichierBlocage = fopen("data/blocage.txt", "r");

$bloqueSuccess = false;

// Vérifie si le fichier a été ouvert avec succès
if ($fichierBlocage) {
    while (($ligne = fgets($fichierBlocage)) !== false) {
        // Sépare les éléments de la ligne
        $utilisateurBloque = explode(";", trim($ligne));
        // Compare l'ID de l'utilisateur à bloquer avec celui de la ligne actuelle
        if ($destinataire === $utilisateurBloque[0]) {
            $bloqueSuccess = true;
            break;
        }
    }
    fclose($fichierBlocage);
} else {
    error_log("Erreur lors de l'ouverture du fichier de blocage.");
}

// Retourner la réponse JSON
header('Content-Type: application/json');
echo json_encode(["bloqueSuccess" => $bloqueSuccess]);
?>

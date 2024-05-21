<?php

error_log("_______________________________________");

// Vérifiez si l'ID utilisateur est défini dans les données POST
if (isset($_POST["UserId"])) {
    $destinataire = $_POST["UserId"];
    error_log("UserId reçu : " . $destinataire);
} else {
    // Vous pouvez définir un comportement par défaut ou retourner une erreur
    error_log("UserId non défini dans les données POST");
    echo json_encode(["bloqueSuccess" => false, "error" => "UserId non défini"]);
    exit;
}

$fichierBlocage = fopen("data/blocage.txt", "r");

$bloqueSuccess = false;

if ($fichierBlocage) {
    while (($ligne = fgets($fichierBlocage)) !== false) {
        $utilisateurBloque = explode(";", trim($ligne));

        error_log("destinataire = ".$destinataire."  utilisateurBloque = ".$utilisateurBloque[0]);

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

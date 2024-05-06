<?php


// Vérifie si les données POST sont définies
//var_dump($_POST);
if(isset($_POST["email"]) && isset($_POST["mot_de_passe"])) {
    
    $fichier=fopen("utilisateurs.csv", "r");
    $tmp=0;



    //lecture du fichier ligne par ligne et s'arrete a la fin quand fgetcsv renvoie faux
    while (($ligne = fgetcsv($fichier)) !== false) {
        //Verification email
        if($_POST["email"] == $ligne[0]){
            //Verification mot de passe
            if($_POST["mot_de_passe"] == $ligne[3]){
                //Ouverture de la session
                session_start();

                //Stocke les données de l'utilisateur dans la session
                $_SESSION['email'] = $ligne[0];
                $_SESSION['num'] = $ligne[1];
                $_SESSION['pseudo'] = $ligne[2];
                $_SESSION['mdp'] = $ligne[3];
                $_SESSION['sexe'] = $ligne[4];
                $_SESSION['naissance'] = $ligne[5];
                $_SESSION['profession'] = $ligne[6];
                $_SESSION['lieu_residence'] = $ligne[7];
                $_SESSION['type_relation'] = $ligne[8];
                $_SESSION['description'] = $ligne[9];
                $_SESSION['photo_profil'] = $ligne[10];
                $_SESSION['abonnement'] = $ligne[11];
                $_SESSION['date_inscription'] = $ligne[12];
                $_SESSION['loggedin'] = true;

                //Les identifiants sont corrects
                $tmp ++;
                break;
            }

            else {
            // Le mot de passe est incorrect
            echo json_encode(array('success' => false, 'message' => 'Mot de passe incorrect'));
            exit;
        }   
        }
        
    }
    //Si l'email n'a pas ete trouve dans le fichier
    if($tmp == 0){
        echo json_encode(array('success' => false, 'message' => 'Adresse email incorrecte'));
        exit;
    }
    fclose($fichier);
}

else {
    // Si les données POST ne sont pas définies
    echo json_encode(array('success' => false, 'message' => 'Erreur lors de la soumission du formulaire'));
    exit;
}

// Si tout s'est bien passé, les identifiants sont corrects
echo json_encode(array('success' => true));





?>

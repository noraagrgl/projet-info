<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: acceuil.html");
    exit;
}

function updateAbonnement($email, $newAbonnement) {
    $file = 'data/utilisateurs.txt';

    if (!file_exists($file)) {
        return false;
    }

    $lines = file($file);

    if ($lines === false) {
        return false;
    }

    $updatedLines = array_map(function($line) use ($email, $newAbonnement) {
        $data = explode(';', $line);
        if ($data[0] === $email) {
            $data[11] = $newAbonnement;
        }
        return implode(';', $data);
    }, $lines);

    $result = file_put_contents($file, implode('', $updatedLines));

    if ($result === false) {
        return false;
    }

    return true;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['abonnement'])) {
    $newAbonnement = $_POST['abonnement'];

    if ($newAbonnement === 'mensuel' || $newAbonnement === 'trimestriel' || $newAbonnement === 'annuel') {
        if (updateAbonnement($_SESSION['email'], $newAbonnement)) {
            echo 'success';
            exit;
        } else {
            header("HTTP/1.1 500 Internal Server Error");
            exit;
        }
    } else {
        header("HTTP/1.1 400 Bad Request");
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>CY-Rencontres</title>
    <link rel="stylesheet" type="text/css" href="js-css/Uprofil.css">
    <script src="js-css/upgradeSubscription.js" defer></script>
    <link rel="icon" type="image/png" href="image/LOGOCY.png">
</head>
<body>
    <div id="containerA">
        
      <div class="bouton">
        <img src="image/accueil.png" alt="image d'accueil" class="imageSelection"/>
        <span id="Accueil" class="bouton"> <a href="utilisateur.php" class="a">Accueil</a></span>
      </div>

      <div class="bouton">
        <img src="image/loupe.jpg" alt="image recherhce" class="imageSelection"/>
        <span id="Profil" class="bouton"> <a href="Urecherche.php" class="a">Recherche</a></span>
      </div>

      <div class="bouton">
        <img src="image/profil.png" alt="image profil" class="imageSelection"/>
        <span id="Profil" class="bouton"> <a href="Uprofil.php" class="a">Profil</a></span>
      </div>

      <div class="bouton">
        <img src="image/messagerieIcone.png" alt="image messagerie" class="imageSelection"/>
        <span id="Messagerie" class="bouton"> <a href="Umessagerie.php" class="a">Messagerie</a></span>
      </div>

      <div class="bouton">
        <img src="image/parametre.png" alt="image parametre" class="imageSelection"/>
        <span id="Parametres" class="bouton"> <a href="Uparametre.php" class="a">Paramètres</a></span>
      </div>

      <div class="bouton" id="adminDIV"></div>

      <div class="bouton">       
        <img src="image/deconnexion.png" alt="image deconnexion" class="imageSelection"/> 
        <span id="Deconnexion" class="bouton"> <a href="deconnexion.php" class="a">Déconnexion</a></span>
      </div>
        
    </div>

    <h1>Paramètres</h1>

    <?php
    if ($_SESSION['abonnement'] === 'gratuit') {
        // Contenu pour les utilisateurs avec un abonnement gratuit
        echo '<h3>Vous avez un abonnement gratuit. Vous pouvez choisir un abonnement payant :</h3>';
        echo '<div id="abonnement">';
        echo '<input type="radio" id="mensuel" name="abonnement" value="mensuel"> <label for="mensuel">Abonnement mensuel (9€/mois)</label><br>';
        echo '<input type="radio" id="trimestriel" name="abonnement" value="trimestriel"> <label for="trimestriel">Abonnement trimestriel (50€/six mois)</label><br>';
        echo '<input type="radio" id="annuel" name="abonnement" value="annuel"> <label for="annuel">Abonnement annuel (80€/an)</label><br>';
        echo '</div>';
        echo '<button id="payerButton">Payer</button>';
        echo '<button id="changeAbonnementButton" style="display: none;">Changer l\'abonnement</button>';
        echo '<div id="paymentFields" style="display: none;">';
        echo '<label for="cardNumber">Numéro de carte :</label>';
        echo '<input type="text" id="cardNumber" name="cardNumber" maxlength="16"><br>';
        echo '<label for="expiryDate">Date d\'expiration (MM/AA) :</label>';
        echo '<input type="text" id="expiryDate" name="expiryDate" maxlength="5"><br>';
        echo '<label for="cvc">CVC :</label>';
        echo '<input type="text" id="cvc" name="cvc" maxlength="3"><br>';
        echo '</div>';
    } else {
        // Contenu pour les utilisateurs avec un abonnement payant
        echo '<h3>Vous avez un abonnement payant. Voici les détails de votre abonnement :</h3>';
        echo '<p>Type d\'abonnement : ' . $_SESSION['abonnement'] . '</p>';


        error_log('___________________________SESSION[date_abonnement] = '.$_SESSION['date_abonnement']);


        
        // Calcul de la date d'expiration de l'abonnement
        $dateDebutAbonnement = new DateTime($_SESSION['date_abonnement']);
        
        $dureeAbonnement = null;

        switch ($_SESSION['abonnement']) {
            case 'mensuel':
                $dureeAbonnement = new DateInterval('P1M');
                break;
            case 'trimestriel':
                $dureeAbonnement = new DateInterval('P3M');
                break;
            case 'annuel':
                $dureeAbonnement = new DateInterval('P1Y');
                break;
            default:
                // Gérer les autres cas d'abonnement si nécessaire
                break;
        }

        $dateExpirationAbonnement = $dateDebutAbonnement->add($dureeAbonnement);
        $dateExpirationFormattee = $dateExpirationAbonnement->format('d/m/Y');

        echo '<p>Votre abonnement expire le : ' . $dateExpirationFormattee . '</p>';

        // Vous pouvez ajouter d'autres détails de l'abonnement payant ici...
        
        $_SESSION['dateExpiration'] = $dateExpirationFormattee;
    }
    ?>
</body>
</html>


<?php
    session_start();
    

    // Verification de la déconnexion
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: acceuil.html");
    exit;
   
    }
    // Accès seulement pour les gens qui ont un abononement payant
    if($_SESSION['abonnement']=='gratuit'){
      header("location: utilisateur.php");
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CY-Rencontres</title>
    <link rel="stylesheet" type="text/CSS" href="js-css/Umessagerie.css">
    <!-- <sript src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></sript> -->
    <!--<script type="text/javascript" src="js-css/Umessagerie.js"></script>-->
    <link rel="icon" type="image/png" href="image/LOGOCY.png">
</head>
<body>
  <div id="containerA"><!-- Barre de sélection -->
        
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

    <div id="containerMessagerie">
      <div id="contacts">
        <h2>CONTACTS</h2>
        <div id="contactErreur"></div>
          <!-- <form action="UformulaireBlocage.php" method="POST"> -->



            <?php
            // N'affiche pas les banni
              $fichier2 = fopen("data/bannissement.txt", "r");
              $bannis = [];
              while (($email = fgets($fichier2)) !== false) {
                  $bannis[] = trim($email);
              }
              fclose($fichier2);

              $fichier = fopen("data/utilisateurs.txt", "r");

              //Lecture du fichier ligne par ligne
              while (($ligne = fgets($fichier)) !== false) {
                  $ligne = explode(";", trim($ligne));

                  //Vérification des indices et !=sexe et ==type_relation
                  if (isset($ligne[4]) && isset($ligne[8])) {
                      if ($_SESSION["sexe"] != $ligne[4] && $_SESSION["type_relation"] == $ligne[8]) {
                          //Verification si l'utilisateur est banni
                          if (!in_array($ligne[0], $bannis)) {
                        ?>
                        <!--<div id="user_print" onclick="contact(this)">-->
                        <div class="user_print active" data-id="<?= $ligne[0] ?>"><!--On peut rajouter d'autres champs si on le souhaite -->
                            <p><img src="image/<?= $ligne[10] ?>" class="image"><b><?= $ligne[2] ?>   <span class="boutonBloquer" ></b></p></span>
                        </div>
                        <?php
                          }
                      }
                  }
              }
              fclose($fichier);

            ?>



      <!-- </form> -->
      </div>

        
      <div id="conversation">
        <h2>CONVERSATION</h2>
        
        <div id="zone_message"><!-- Zone de conversation avant d'avoir cliqué sur un contact -->
          <div id="destinataireChoisi">
            <p>Bienvenue sur la messagerie de CY-Rencontres, et voici les contacts que vous pouvez sélectionner</p>
            <div id="containerlogo"><img id="logoMessagerie" src="image/messagerie.png" alt="Logo de la messagerie"></div>
          </div>

          <div id="messagesContainer">
            
          </div>


        <!-- </div> -->



        <div id="text">
          <form method="POST">
            <textarea id="zone_text" name="message" rows="3" cols="155"></textarea>        
            <button type="submit" id="envoyer" class="active"><b>Envoyer</b></button>
          </form>
        </div>
      </div>
   </div>



   <div>

  </div>


  
  <sript src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></sript>
  <script type="text/javascript" src="js-css/Umessagerie.js"></script>



</body>
</html>

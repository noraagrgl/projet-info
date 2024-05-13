<?php
    session_start();
    
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: acceuil.html");
    exit;
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CY-Rencontres</title>
    <link rel="stylesheet" type="text/CSS" href="Umessagerie.css">
    <!-- <sript src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></sript> -->
    <!--<script type="text/javascript" src="Umessagerie.js"></script>-->
</head>
<body>
  <div id="containerA">
        <span id="Accueil" class="bouton"> <a href="utilisateur.php">Accueil</a></span>
        <span id="Profil" class="bouton"> <a href="Uprofil.php">Profil</a></span>
        <span id="Messagerie" class="bouton"> <a href="Umessagerie.php">Messagerie</a></span>
        <span id="Parametres" class="bouton"> <a href="Uparametre.php">Paramètres</a></span>
        <span id="Deconnexion" class="bouton"> <a href="deconnexion.php">Déconnexion</a></span>
    </div>

    <div id="containerMessagerie">
      <div id="contacts">
        <h2>CONTACTS</h2>
        <div id="contactErreur"></div>



      <?php
      
      $fichier=fopen("utilisateurs.csv", "r");
      //lecture du fichier ligne par ligne et s'arrete a la fin quand fgetcsv renvoie faux
      while (($ligne = fgetcsv($fichier)) !== false) {
            if(isset($ligne[4]) && isset($ligne[8])) {
               //Verification pour presenter le sexe oppose
                if($_SESSION["sexe"] != $ligne[4]){
                    //Verification pour presenter le meme type de relation
                    if($_SESSION["type_relation"] == $ligne[8]){
                        //Afficher cet utilisateur pseudo + description
                        ?>
                        <!--<div id="user_print" onclick="contact(this)">-->
                        <div class="user_print active" data-id="<?= $ligne[0] ?>"><!--On peut rajouter d'autres champs si on le souhaite -->
                            <p><img src="image/<?= $ligne[10] ?>" class="image"><b><?= $ligne[2] ?></b></p>
                        </div>
                        <?php
                    }
                }
            }
      }
      
      ?>




      </div>

        
      <div id="conversation">
        <h2>CONVERSATION</h2>
        
        <div id="zone_message">
          <div id="destinataireChoisi">
            <p>Bienvenue sur la messagerie de CY-Rencontres, et voici les contacts que vous pouvez sélectionner</p>
            <div id="containerlogo"><img id="logoMessagerie" src="image/messagerie.png" alt="Logo de la messagerie"></div>
          </div>

          <div id="messagesContainer">
            
          </div>


        </div>



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
  <script type="text/javascript" src="Umessagerie.js"></script>



</body>
</html>

<?php
    session_start();
    
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: acceuil.html");
    exit;
    }

    $abonnement = $_SESSION['abonnement'];
    error_log("______________________________________________Session abonnement = ".$abonnement);
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CY-Rencontres</title>
    <link rel="stylesheet" type="text/CSS" href="js-css/Urecherche.css">
    <!-- <script src="Urecherche.js"></script> -->
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







    <div id="pageRecherche">

        <div id="sectionGauche">
            <!-- <h1>SECTION GAUCHE</h1> -->
            <div id="logoDiv">
                <img id="logoImage" src="image/logoCYrencontre.png" alt="logo du site">
            </div>

            <div id="critere">
                <form action="UformulaireRecherche.php" method="POST" id="rechercheForm">
                    <label for="couleur_cheveux">Choisissez la couleur de cheveux recherché:</label><br>
                    <select id="couleur_cheveux" name="couleur_cheveux">
                        <option value="vide"></option>
                        <option value="blond">Blond(e)</option>
                        <option value="brun">Brun(ne)</option>
                        <option value="chatain">Châtain</option>
                    </select>
                    <br><br>
                    <label for="couleur_yeux">Choisissez la couleur des yeux recherché:</label><br>
                    <select id="couleur_yeux" name="couleur_yeux">
                        <option value="vide"></option>
                        <option value="marron">Marron</option>
                        <option value="bleu">Bleu</option>
                        <option value="vert">Vert</option>
                    </select>  
                    <br><br>
                    <label for="age">Choisissez la tranche d'âge recherché:</label><br>
                    <select id="age" name="age">
                        <option value="vide"></option>  
                        <option value="18-25">18-25 ans</option>
                        <option value="26-35">26-35 ans</option>
                        <option value="36-45">36-45 ans</option>
                        <option value="46-55">46-55 ans</option>
                        <option value="56-65">56-65 ans</option>
                        <option value="65+">65 ans et plus</option>
                    </select>
                    <br><br>
                    <label for="taille">Choisissez la tranche de taille recherché:</label><br>
                    <select id="taille" name="taille">
                        <option value="vide"></option>   
                        <option value="150-">Moins de 150 cm</option>
                        <option value="151-160">151-160 cm</option>
                        <option value="161-170">161-170 cm</option>
                        <option value="171-180">171-180 cm</option>
                        <option value="181-190">181-190 cm</option>
                        <option value="191+">Plus de 191 cm</option>
                    </select>
                
            </div>

            <div id="containerPub1">
                <img id="pub1" src="image/pub1.png" alt="publicité1" class="pub">
            </div>
        </div>



        <div id="sectionDroite">
            <!-- <h1>SECTION DROITE</h1> -->
            <div id="rechercheDiv">


                <div id="containerRechercheBarre">

                    <div id="inputBarreDiv">
                        
                            <input type="text" name="recherchePseudo" id="recherchePseudo" size="30" placeholder="Entrer un pseudo" />   
                      
                    </div>
                    <div id="loupeDiv">
                           
                            <button type="submit" id="boutonSubmit">
                                <img id="imageLoupe" src="image/loupe.jpg" alt="loupe">
                            </button>
                        </form>
                        
                    </div>     
                </div>

                

            </div>

            <div id="containerPub2" >
                <span class="pub"> <img src="image/pub2.jpg" alt="publicité2netlix" class="pubSection2" > </span>
                <span class="pub" > <img src="image/pub3.jpg" alt="publicité3coca" class="pubSection2" > </span>
                <span class="pub" > <img src="image/pub4.jpg" alt="publicité4vinted" class="pubSection2" > </span>
                <span class="pub"> <img src="image/pub5.jpg" alt="publicité4addidas" class="pubSection2" > </span>

            </div>

            <div id="listeProfil">
                <h1>Liste des profils recherchés:</h1>
                <ul>

            </ul>
            </div>

        </div>

    
    </div>

    <script>
        var abonnement = "<?php echo $abonnement; ?>";
    </script>

    <script src="js-css/Urecherche.js"></script>

</body>
</html>

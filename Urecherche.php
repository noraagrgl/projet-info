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
    <link rel="stylesheet" type="text/CSS" href="Urecherche.css">
    <!-- <script src="Urecherche.js"></script> -->
</head>
<body>

    <div id="containerA">
        <span id="Accueil" class="bouton"> <a href="utilisateur.php">Accueil</a></span>
        <span id="Profil" class="bouton"> <a href="Uprofil.php">Profil</a></span>
        <span id="Messagerie" class="bouton"> <a href="Umessagerie.php">Messagerie</a></span>
        <span id="Parametres" class="bouton"> <a href="Uparametre.php">Paramètres</a></span>
        <span id="Deconnexion" class="bouton"> <a href="deconnexion.php">Déconnexion</a></span>
    </div>







    <div id="pageRecherche">

        <div id="sectionGauche">
            <!-- <h1>SECTION GAUCHE</h1> -->
            <div id="logoDiv">
                <img id="logoImage" src="image/logo.png" alt="logo du site">
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

            <div id="containerPub1"class="pub">
                <img id="pub1" src="image/pub1.png" alt="publicité1">
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

            <div id="containerPub2" class="pub">
                <img src="image/pub2.jpg" alt="publicité2netlix" class="pubSection2">
                <img src="image/pub3.jpg" alt="publicité3coca" class="pubSection2">
                <img src="image/pub4.jpg" alt="publicité4vinted" class="pubSection2">
                <img src="image/pub5.jpg" alt="publicité4addidas" class="pubSection2">

            </div>

            <div id="listeProfil">
                <h1>Liste des profils recherchés:</h1>
                <ul>

                    <?php
                       /* 

                        if($_SESSION["liste_profil"]==1){
                            $fichier=fopen("utilisateurs.csv", "r");
                            //lecture du fichier ligne par ligne et s'arrete a la fin quand fgetcsv renvoie faux
                            while (($ligne = fgetcsv($fichier)) !== false) {

                                if(isset($ligne[4]) && isset($ligne[8])) {

                                    //Verification pour presenter le sexe oppose
                                    if($_SESSION["sexe"] != $ligne[4]){
                                        //Verification pour presenter le meme type de relation
                                        if($_SESSION["type_relation"] == $ligne[8]){
                                            //Afficher cet utilisateur pseudo + description
                            
                        }

                        

                        

                                        ?>

                                        <li>
                                            <div id="user_print">
                                                <p><img src="image/<?= $ligne[10] ?>" class="imageProfil"><b><?= $ligne[2] ?></b><a href="Umessagerie.php">     Consulter le profil</a></p>      
                                            </div>
                                        </li>


                                        <?php



                                    }
                                 
                                }
                            }
                      }
                       */
                    ?>
            </ul>
            </div>

        </div>

    
    </div>

   

    <script src="Urecherche.js"></script>

</body>
</html>

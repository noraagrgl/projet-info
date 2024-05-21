


//___________________________________________________________________________
//                        FONCTION DE SIGNALEMENT AJAX
//___________________________________________________________________________

function signalerMessage(emetteur, destinataire, messageContent, dateEnvoie, critereSignalement){



var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
        }
    };


    var messageSignalement =  encodeURIComponent(emetteur) +";"+
                 encodeURIComponent(destinataire) +";"+
                 encodeURIComponent(messageContent) +";"+
                 encodeURIComponent(dateEnvoie) +";"+
                 encodeURIComponent(critereSignalement)+"\n";

    xhttp.open("POST", "Usignalement.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("messageSignalement=" + messageSignalement);

    console.log("Fonction JS END - messageSignalement = "+messageSignalement);

}




//___________________________________________________________________________
//                    FONCTION DE SUPPRESSION MESSAGE AJAX
//___________________________________________________________________________

function supprimerMessage(messageId){

var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
        }
    };

    console.log("messageId = "+messageId);

    xhttp.open("POST", "Usuppression.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("messageId=" + messageId);

}




//___________________________________________________________________________
//                    FONCTION BLOQUER UTILISATEUR AJAX
//___________________________________________________________________________

function bloquerUtilisateur(UserId){

var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
        }
    };



    xhttp.open("POST", "UformulaireBlocage.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("UserId=" + UserId);

}


//Gere le click du bouton bloquer
function handleClick() {
    if (lastClickedUserId !== null) {
        bloquerUtilisateur(lastClickedUserId);
        alert("L'utilisateur à bien été bloqué.");
    }
}




//___________________________________________________________________________
//                    FONCTION estBLOQUER UTILISATEUR AJAX
//___________________________________________________________________________
function estBloque(UserId) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log("Réponse reçue du serveur: " + this.responseText);
            var response = JSON.parse(this.responseText);
            console.log(response);
            // Utilisez la réponse pour mettre à jour l'interface utilisateur ou pour toute autre logique
        }
    };

    console.log("FONCTION ESTBLOQUE ACTIVE et userid = " + UserId);

    xhttp.open("POST", "UestBloque.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("UserId=" + encodeURIComponent(UserId));
}








var UserId; // Déclarez une variable globale pour stocker l'userId du dernier contact cliqué

//___________________________________________________________________________
//                          FONCTION SEND MESSAGE
//___________________________________________________________________________


// Gérez l'envoi du message en utilisant la variable UserId
function sendMessage(UserId) {
    var message = document.getElementById("zone_text").value;
    console.log("Contenu du message :", message);

    if(UserId==null){
        var messageErreur = document.getElementById("contactErreur");
        messageErreur.innerHTML = "<h2 style='font-size: 20px; color: red;'>Veuillez sélectionner un contact</h2>";
        console.log("ERREUR: aucun contact selectionner");
        return;
    }

    var messageTextArea = document.getElementById("zone_text");

    if(messageTextArea.value==""){
        console.log("Erreur, vous ne pouvez pas envoyer de message vide.");
        return;
    }

    //___________________________________________________________________________
    //                              REQUETE AJAX
    //___________________________________________________________________________

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
        }
    };
    //var messageTextArea = document.getElementById("zone_text");
    messageTextArea.value = "";
    
    xhttp.open("POST", "Utraitement.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("message=" + encodeURIComponent(message) + "&userId=" + encodeURIComponent(UserId));
}





















//___________________________________________________________________________
//                            SELECTION CONTACT
//___________________________________________________________________________

var lastClickedUserId = null;
var nePasEnvoyer = 0;

document.querySelectorAll('.user_print').forEach(item => {
    item.addEventListener('click', function() {
        var userId = this.getAttribute('data-id'); // Stockez l'userId du dernier contact cliqué

        lastClickedUserId = userId;

        estBloque(lastClickedUserId);
        
        var h2 = document.getElementById("destinataireChoisi");
        h2.innerHTML = "<h2 style='font-size: 20px;'>" + userId + "</h2>";
        //___________________________________________________________________________
        //                      RECUPERATION DES DONNEES JSON
        //___________________________________________________________________________
        fetch('chargerMessage.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
           
        })

        .then(response => {
            if (!response.ok) {
                throw new Error('Erreur lors de la requête');
            }
            return response.json();

        })
        .then(data => {
            //console.log('Données reçues :', data);

            var emailSession = data[0];

            // Afficher les messages dans l'interface utilisateur
            var messagesContainer = document.getElementById("messagesContainer");
            messagesContainer.innerHTML = ""; // Effacer les anciens messages
            
            data.messages.forEach(message => {
                // Diviser la ligne en éléments en utilisant le délimiteur approprié
                var messageData = message.split(";");
                var emmeteur = messageData[0];
                var destinataire = messageData[1];  
                var messageContent = messageData[2];       
                var dateEnvoie = messageData[3];
                var emailSession = messageData[4];             

                
                //___________________________________________________________________________
                //              RECUPERATION DE LA CONVERSATION + AFFICHAGE
                //___________________________________________________________________________

                var messageElement = document.createElement("div");

                var messageClicked = false;

                if((userId==emmeteur&&emailSession==destinataire)||(userId==destinataire&&emailSession==emmeteur)){
                    messageElement.textContent =/* emmeteur + " - " + destinataire + " - " + */messageContent + "   "/* + dateEnvoie*/;
                    messagesContainer.appendChild(messageElement);

                    
                    messageElement.style.display = "inline-block";                   
                    messageElement.style.border = "1px solid black";
                    messageElement.style.borderRadius = "20px";
                    messageElement.style.witdh = "800px";
                    messageElement.style.marginTop = "10px";
                    messageElement.style.padding = "15px";     

                    if(userId==emmeteur){
                        messageElement.style.float = "left";
                        messageElement.style.marginRight = "600px";
                        messageElement.style.marginLeft = "125px";
                        messageElement.style.backgroundColor="hotpink"


                    }
                    else{
                        messageElement.style.float = "right"; 
                        messageElement.style.marginLeft = "600px";
                        messageElement.style.marginRight = "125px";
                        messageElement.style.backgroundColor="white"

                    }
       
                }
                

                messageElement.addEventListener("click", function() {

                    if (!messageClicked) { // Vérifie si le message n'a pas encore été cliqué
                        //___________________________________________________________________________
                        //                          POUR AFFICHER LA DATE
                        //___________________________________________________________________________
                        var dateElement = document.createElement("div");
                        dateElement.textContent = dateEnvoie;
                        dateElement.style.fontSize = "12px"; 
                        dateElement.style.float = "right"; 
                        dateElement.style.color = "gray"; 
                        dateElement.style.marginTop = "5px"; 
                        dateElement.style.padding = "5px";
                        messageElement.appendChild(dateElement); //Ajout de la div
                        //___________________________________________________________________________
                        //                          POUR AFFICHER SIGNALER
                        //___________________________________________________________________________

                        if(userId==emmeteur){
                            //BOUTON
                            var bouton = document.createElement("button");
                            bouton.innerHTML = "Signaler ce message";
                            messageElement.appendChild(bouton);


                            //MODAL
                            var modal = document.createElement("div");
                            modal.classList.add("modal");

                            var modalContent = document.createElement("div");
                            modalContent.classList.add("modal-content");
                            modal.appendChild(modalContent);

                            var closeButton = document.createElement("span");
                            closeButton.classList.add("close");
                            closeButton.innerHTML = "&times;";
                            modalContent.appendChild(closeButton);

                            var modalText = document.createElement("p");
                            modalText.innerHTML = "Vous signalez ce message: \""+messageContent+"\" pour ?";
                            modalContent.appendChild(modalText);


                            //OPTIONS
                            var signalementOptions = ["Contenu inapproprié", "Spam", "Harcelement"];
                            signalementOptions.forEach(function(option) {
                              var optionDiv = document.createElement("div");
                              optionDiv.innerHTML = option;
                              modalContent.appendChild(optionDiv);          
                              optionDiv.addEventListener("click", function() {                              
                                modalContent.querySelectorAll(".modal-content div").forEach(function(div) {
                                  div.style.color = "black";
                                }); 
                                optionDiv.style.color = "red";
                                critereSignalement = option;
                              });
                            });


                            //BOUTON ENVOIE
                            var envoyerButton = document.createElement("button");
                            envoyerButton.innerHTML = "Envoyer un signalement";
                            modalContent.appendChild(envoyerButton);

                            document.body.appendChild(modal);

                            //BOUTON CLIQUE
                            bouton.addEventListener("click", function() {
                              modal.style.display = "block";
                            });

                            //FERME MODAL CLIQUE
                            closeButton.addEventListener("click", function() {
                              modal.style.display = "none";
                            });

                            //FERME MODAL CLIQUE EN DEHORS DIV
                            window.addEventListener("click", function(event) {
                              if (event.target == modal) {
                                modal.style.display = "none";
                              }
                            });

                            //Vide le critere
                            var critereSignalement = "";

                            //BOUTON ENVOIE CLIQUE
                            envoyerButton.addEventListener("click", function() {
                              
                              //CRITERE SIGNALEMENT SELECTIONNE OU NON
                              if (critereSignalement) {
                                alert("Nous vous remercions de votre aide.\nVous avez signaler un message pour : " + critereSignalement);
                                signalerMessage(emmeteur, destinataire, messageContent, dateEnvoie, critereSignalement);
                                modal.style.display = "none";
                              } else {
                                alert("Veuillez sélectionner un critère de signalement.");
                              }
                            });


                            messageClicked = true;


                        

                        }

                        //___________________________________________________________________________
                        //                          POUR AFFICHER SUPPRIMER
                        //___________________________________________________________________________

                        else{
                            var suppr = document.createElement("img");
                            suppr.src = "image/poubelle.png"; 
                            suppr.alt = "logo d'une poubelle";
                            suppr.style.objectFit= "cover";
                            suppr.style.witdh="25px";
                            suppr.style.height="25px";
                            suppr.style.borderRadius="50%";
                            suppr.style.cursor = "pointer"; 

                            messageElement.appendChild(suppr); //Ajout de la div

                            
                            //BOUTON 
                            suppr.addEventListener("click", function(event) {
                                event.stopPropagation(); //Empeche la propagation de l'événement de clic vers le message parent
                                console.log("dateEnvoie = "+dateEnvoie);
                                supprimerMessage(dateEnvoie);
                                
                            });


                            messageClicked = true;

                        }


                    



                        
                    }
                });






                //___________________________________________________________________________
                //                        BOUTON BLOQUÉ UTILISATEUR
                //___________________________________________________________________________

                var boutonBloquer = document.getElementById("boutonBloquer");

                document.querySelectorAll(".boutonBloquer button").forEach(button => {
                    // Supprimer tous les écouteurs d'événements existants sur le bouton
                    button.removeEventListener("click", handleClick);

                    // Ajouter un nouvel écouteur d'événements
                    button.addEventListener("click", handleClick);
                });

               
               
            });
        })
        .catch(error => {
            console.error('Erreur:', error);
        });




        fetch('UestBloque.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ UserId: lastClickedUserId }) // Envoyer les données nécessaires à la deuxième requête
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Erreur lors de la deuxième requête');
            }
            return response.json();
        })
        .then(data => {
            // Traitement des données de la deuxième réponse
            console.log('Réponse de la deuxième requête :', data);
            // Maintenant vous pouvez vérifier si l'utilisateur est bloqué ou non

            if (data.bloqueSuccess === true) {
                nePasEnvoyer = 1;
            }
        })
        .catch(error => {
            console.error('Erreur lors de la deuxième requête :', error);
        });
        
       





        //___________________________________________________________________________
        //                          BOUTON ENVOYER
        //___________________________________________________________________________
        var envoyerBtn = document.getElementById("envoyer");
        envoyerBtn.addEventListener("click", function(event) {
            event.preventDefault();

        console.log("nePasEnvoyer = "+nePasEnvoyer);
            
        if(nePasEnvoyer==0){

            if(lastClickedUserId !== null) {
                sendMessage(lastClickedUserId);
            }
        }
        else{
            alert("L'utilisateur vous a bloqué, vous ne pouvez pas envoyer de message.");
        }
       

            
        });


    });;
});









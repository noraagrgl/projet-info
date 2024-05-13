/*
// Fonction pour rafraîchir les messages en temps réel
function rafraichirMessages() {
    // Effectuer une requête AJAX pour récupérer les nouveaux messages
    $.ajax({
        type: 'POST',
        url: 'Umessagerie.php', // URL du script PHP qui récupère les messages
        dataType: 'json',
        success: function(data) {
            // Effacer les anciens messages
            $('#messagesContainer').empty();

            // Afficher les nouveaux messages
            data.messages.forEach(function(message) {
                $('#messagesContainer').append('<div>' + message + '</div>');
            });
        },
        error: function(xhr, status, error) {
            console.error('Erreur lors de la récupération des messages:', error);
        }
    });
}

// Appeler la fonction pour rafraîchir les messages toutes les X secondes
setInterval(rafraichirMessages, 3000); // Par exemple, toutes les 3 secondes
*/

//___________________________________________________________________________
//                        FONCTION DE SUPPRESSION AJAX
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

document.querySelectorAll('.user_print').forEach(item => {
    item.addEventListener('click', function() {
        var userId = this.getAttribute('data-id'); // Stockez l'userId du dernier contact cliqué

        lastClickedUserId = userId;

        
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
                    messageElement.style.witdh = "800px";

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
                messageElement.style.display = "inline-block";
                messageElement.style.padding = "15px";
                messageElement.style.border = "1px solid black";
                messageElement.style.borderRadius = "20px";
                messageElement.style.transparency="0.6";
                messageElement.style.marginTop = "10px";     

                messageElement.addEventListener("click", function() {

                    if (!messageClicked) { // Vérifier si le message n'a pas encore été cliqué
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
                        messageElement.appendChild(dateElement); // Ajout de la div
                        //___________________________________________________________________________
                        //                          POUR AFFICHER SUPPRIMER
                        //___________________________________________________________________________
                        var suppr = document.createElement("div");
                        suppr.style.backgroundColor="whitesmoke" ;
                        suppr.textContent = " Supprimer";
                        suppr.style.fontSize = "12px";
                        suppr.style.display="inline-block"; 
                        suppr.style.border="1px solid black";
                        suppr.style.borderRadius="10px";
                        suppr.style.color = "black"; 
                        suppr.style.marginTop = "5px"; 
                        suppr.style.padding = "5px";


                        suppr.style.cursor = "pointer"; // Ajouter un style de curseur pointer pour indiquer que c'est un élément cliquable
                        messageElement.appendChild(suppr); // Ajout de la div

                        // Ajouter un écouteur d'événements au bouton de suppression
                        
                        suppr.addEventListener("click", function(event) {
                            event.stopPropagation(); // Empêcher la propagation de l'événement de clic vers le message parent
                            console.log("dateEnvoie = "+dateEnvoie);
                            supprimerMessage(dateEnvoie);
                            
                        });

                        messageClicked = true;
                    }
                });


               
            });
        })
        .catch(error => {
            console.error('Erreur:', error);
        });





        //___________________________________________________________________________
        //                          BOUTON ENVOYER
        //___________________________________________________________________________
        var envoyerBtn = document.getElementById("envoyer");
        envoyerBtn.addEventListener("click", function(event) {
        event.preventDefault();

         if (lastClickedUserId !== null) {
                sendMessage(lastClickedUserId);
            }
        });


    });;
});








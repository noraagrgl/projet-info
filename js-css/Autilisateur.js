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

/*
//___________________________________________________________________________
//               ENVOIE EMAIL ACHARGERMESSAGE.PHP MESSAGE AJAX
//___________________________________________________________________________

function envoieChargeMessage(emailUtilisateur){

var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
        }
    };

    

    xhttp.open("POST", "AchargerMessage.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("email=" + emailUtilisateur);

}

*/





//___________________________________________________________________________
//                            SELECTION CONTACT
//___________________________________________________________________________

var lastClickedUserId = null;

document.querySelectorAll('.user_print').forEach(item => {
    item.addEventListener('click', function() {
        var userId = this.getAttribute('data-id'); // Stockez l'userId du dernier contact cliqué

        console.log("userId = " + userId);

        lastClickedUserId = userId;

        var h2 = document.getElementById("destinataireChoisi");
        h2.innerHTML = "<h2 style='font-size: 20px;'>" + userId + "</h2>";
        
        // Récupération de l'email de l'utilisateur de la session (à adapter selon votre méthode de récupération)
        var emailUtilisateur; // Remplacez par le véritable email

        fetch('AchargerMessage.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                'email': emailUtilisateur
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Erreur lors de la requête');
            }
            return response.json();
        })
        .then(data => {
            var messagesContainer = document.getElementById("messagesContainer");
            messagesContainer.innerHTML = ""; // Effacer les anciens messages
            
            data.messages.forEach(message => {
                var messageData = message.split(";");
                var emmeteur = messageData[0];
                var destinataire = messageData[1];
                var messageContent = messageData[2];
                var dateEnvoie = messageData[3];
                var emailSession = messageData[4]; // Email de la session

                if ((userId == emmeteur && emailSession == destinataire) || (userId == destinataire && emailSession == emmeteur)) {
                    var messageElement = document.createElement("div");

                    messageElement.textContent = messageContent;

                    messagesContainer.appendChild(messageElement);

                    messageElement.style.display = "inline-block";
                    messageElement.style.border = "1px solid black";
                    messageElement.style.borderRadius = "20px";
                    messageElement.style.width = "800px";
                    messageElement.style.marginTop = "10px";
                    messageElement.style.padding = "15px";

                    if (userId == emmeteur) {
                        messageElement.style.float = "left";
                        messageElement.style.marginRight = "600px";
                        messageElement.style.marginLeft = "125px";
                        messageElement.style.backgroundColor = "hotpink";
                    } else {
                        messageElement.style.float = "right";
                        messageElement.style.marginLeft = "600px";
                        messageElement.style.marginRight = "125px";
                        messageElement.style.backgroundColor = "white";
                    }

                    messageElement.addEventListener("click", function() {
                        var dateElement = document.createElement("div");
                        dateElement.textContent = dateEnvoie;
                        dateElement.style.fontSize = "12px";
                        dateElement.style.float = "right";
                        dateElement.style.color = "gray";
                        dateElement.style.marginTop = "5px";
                        dateElement.style.padding = "5px";
                        messageElement.appendChild(dateElement);

                        if (userId == destinataire) {
                            var suppr = document.createElement("img");
                            suppr.src = "image/poubelle.png";
                            suppr.alt = "logo d'une poubelle";
                            suppr.style.objectFit = "cover";
                            suppr.style.width = "25px";
                            suppr.style.height = "25px";
                            suppr.style.borderRadius = "50%";
                            suppr.style.cursor = "pointer";

                            messageElement.appendChild(suppr);

                            suppr.addEventListener("click", function(event) {
                                event.stopPropagation();
                                console.log("dateEnvoie = " + dateEnvoie);
                                supprimerMessage(dateEnvoie);
                            });
                        }
                    });
                }
            });
        })
        .catch(error => {
            console.error('Erreur:', error);
        });
    });
});








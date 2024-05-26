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
//                         SUPRESSION COMPTE AJAX
//___________________________________________________________________________

function supprimerCompte(emailUtilisateur){

var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
        }
    };

    

    xhttp.open("POST", "AsuppressionCompte.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("email=" + emailUtilisateur);

}

//___________________________________________________________________________
//                         BANISSEMENT COMPTE AJAX
//___________________________________________________________________________

function bannirCompte(emailUtilisateur){

var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
        }
    };

    

    xhttp.open("POST", "Abannissement.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("email=" + emailUtilisateur);

}



//___________________________________________________________________________
//                         ESTBANNI COMPTE AJAX
//___________________________________________________________________________

function estBanni(emailUtilisateur){

var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
        }
    };

    

    xhttp.open("POST", "AutilisateurBanni.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("email=" + emailUtilisateur);

}

//___________________________________________________________________________
//                         BANISSEMENT COMPTE AJAX
//___________________________________________________________________________

function debannirCompte(emailUtilisateur){

var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
        }
    };

    

    xhttp.open("POST", "Adebannissement.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("email=" + emailUtilisateur);

}









//___________________________________________________________________________
//                            SELECTION CONTACT
//___________________________________________________________________________

var lastClickedUserId = null;

document.querySelectorAll('.user_print').forEach(item => {
    item.addEventListener('click', function() {
        var userId = this.getAttribute('data-id'); // Stocke l'userId du dernier contact cliqué

        lastClickedUserId = userId;

        var h2 = document.getElementById("destinataireChoisi");
        h2.innerHTML = "<h2 style='font-size: 20px;'>" + userId + "</h2>";
        
        
        var emailUtilisateur; 

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

                
                //Trie tous les messages pour la conversation du userId
                if ((userId == emmeteur && emailSession == destinataire) || (userId == destinataire && emailSession == emmeteur)) {
                    var messageElement = document.createElement("div");

                    //Creation des messages
                    messageElement.textContent = messageContent;
                    messagesContainer.appendChild(messageElement);
                    messageElement.style.display = "inline-block";
                    messageElement.style.border = "1px solid black";
                    messageElement.style.borderRadius = "20px";
                    messageElement.style.width = "520px";
                    messageElement.style.marginTop = "10px";
                    messageElement.style.padding = "15px";

                    if (userId == emmeteur) {
                        messageElement.style.float = "right";
                        messageElement.style.marginRight = "100px";
                        messageElement.style.marginLeft = "125px";
                        messageElement.style.backgroundColor = "hotpink";
                    } else {
                        messageElement.style.float = "left";
                        messageElement.style.marginLeft = "100px";
                        messageElement.style.marginRight = "125px";
                        messageElement.style.backgroundColor = "white";
                    }

                    messageElement.messageClicked = false;

                    messageElement.addEventListener("click", function() {


                        if(!messageElement.messageClicked){

                            //creation de la date
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

                            messageElement.messageClicked = true;

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


//option supprimer un profil
var supprimerProfil = document.getElementById("supprimerProfil");
supprimerProfil.addEventListener("click", function(event) {
    
    var ok;
    ok = confirm("Etes vous sûr de vouloir supprimer le compte de l'email "+emailUtilisateur+" ?");
    if(ok==true){
        supprimerCompte(emailUtilisateur);
        alert("Le compte de "+emailUtilisateur+" à bien été supprimé.");
        window.location.href = "Ugestion.php";
    }


});







//option banni utilisateur
var bannirProfil = document.getElementById("bannirProfil");
bannirProfil.addEventListener("click", function(event) {

    var ok;
    ok = confirm("Etes vous sûr de vouloir bannir le compte de l'email "+emailUtilisateur+" ?");
    if(ok==true){
        bannirCompte(emailUtilisateur);
        alert("Le compte de "+emailUtilisateur+" à bien été banni.");
    }

});

//option debanni utilisateur
var debannirProfil = document.getElementById("debannirProfil");
debannirProfil.addEventListener("click", function(event) {

    var ok;
    ok = confirm("Etes vous sûr de vouloir débannir le compte de l'email "+emailUtilisateur+" ?");
    if(ok==true){
        debannirCompte(emailUtilisateur);
        alert("Le compte de "+emailUtilisateur+" à bien été débanni.");
    }

});


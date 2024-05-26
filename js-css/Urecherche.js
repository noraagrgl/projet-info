document.addEventListener("DOMContentLoaded", function() {

    // Vérifie si l'abonnement n'est pas gratuit, puis masque les publicités
    if (abonnement !== "gratuit") {
        var pubs = document.querySelectorAll(".pub");
        pubs.forEach(function(pub) {
            pub.style.display = "none";
        });
    }





    document.getElementById("rechercheForm").addEventListener("submit", function(event) {
        event.preventDefault();
        // Récupère la valeur saisie dans le champ de recherche
        var pseudo = document.getElementById("recherchePseudo").value;
        console.log("bonjour " + pseudo);
        // Sélectionne la liste des profils pour ajouter les résultats de la recherche
        var liste = document.getElementById("listeProfil");

        // Réinitialiser la div "listeProfil" en supprimant tous les enfants
        liste.innerHTML = '';

        var formData = new FormData();
        formData.append('recherchePseudo', pseudo);

        fetch('UformulaireRecherche.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text()) // Utilisez text() pour déboguer la réponse brute
        .then(text => {
            console.log("Réponse brute:", text); // Affichez la réponse brute pour le débogage
            try {
                var data = JSON.parse(text); // Essayez d'analyser la réponse en JSON
                if (data.success) {
                    // Si la recherche est réussie, affiche les profils correspondants
                    data.utilisateurs.forEach(utilisateur => {
                        var profil = document.createElement("div");
                        profil.style.display = "inline-block";                   
                        profil.style.border = "2px solid black";
                        profil.style.borderRadius = "20px";
                        profil.style.width = "400px";
                        profil.style.height = "200px";
                        profil.style.marginTop = "25px";
                        profil.style.marginLeft = "25px";
                        profil.style.padding = "15px";
                        profil.style.textAlign = "center";
                        profil.style.fontSize = "25px";
                        // Ajoute le pseudo de l'utilisateur avec des styles
                        var pseudoElement = document.createElement("p");
                        pseudoElement.textContent = utilisateur.pseudo;
                        pseudoElement.style.marginBottom = "10px";
                        pseudoElement.style.borderBottom = "2px solid black";
                        pseudoElement.style.padding = "10px";
                        pseudoElement.style.borderRadius = "20px";
                        profil.appendChild(pseudoElement);

                        var photoElement = document.createElement("img");
                        photoElement.src = utilisateur.photo_profil;
                        photoElement.alt = "Photo de profil";
                        photoElement.style.width = "100px";
                        photoElement.style.height = "100px";
                        photoElement.style.border = "2px solid black";
                        photoElement.style.borderRadius = "50%";
                        photoElement.style.objectFit = "cover";
                        profil.appendChild(photoElement);
                        // Crée un lien pour consulter le profil de l'utilisateur
                        var linkElement = document.createElement("a");
                        linkElement.href = "UconsulterProfil.php?email=" + encodeURIComponent(utilisateur.email);
                        linkElement.textContent = "Consulter le profil";
                        linkElement.style.display = "inline-block";
                        linkElement.style.marginTop = "10px";
                        profil.appendChild(linkElement);

                        liste.appendChild(profil);
                    });
                } else {
                    // Si la recherche échoue, affiche un message d'erreur
                    var messageElement = document.createElement("p");
                    messageElement.textContent = data.message;
                    messageElement.style.color = "red"; 
                    messageElement.style.fontSize = "30px"; 
                    messageElement.style.fontWeight = "bold";
                    messageElement.style.textAlign = "center"; 
                    liste.appendChild(messageElement);
                }
            } catch (error) {
                console.error("Erreur lors de l'analyse JSON:", error);
                var errorElement = document.createElement("p");
                errorElement.textContent = "Erreur lors de la réponse du serveur. Voir la console pour plus de détails.";
                errorElement.style.color = "red"; 
                errorElement.style.fontSize = "30px"; 
                errorElement.style.fontWeight = "bold";
                errorElement.style.textAlign = "center"; 
                liste.appendChild(errorElement);
            }
        })
        .catch(error => console.error('Erreur lors de la requête:', error));
    });
});

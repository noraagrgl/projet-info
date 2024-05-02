// Attends que le DOM soit complètement chargé
document.addEventListener("DOMContentLoaded", function() {
    // Ajoute un écouteur d'événements pour la soumission du formulaire
    document.getElementById("connexionForm").addEventListener("submit", function(event) {
        // Empêche l'envoi du formulaire par défaut
        event.preventDefault();
        
        // Récupère les valeurs des champs email et mot de passe
        var email = document.getElementById("email").value;
        var motDePasse = document.getElementById("mot_de_passe").value;
        
        // Crée un objet FormData pour envoyer les données du formulaire
        var formData = new FormData();
        formData.append('email', email);
        formData.append('mot_de_passe', motDePasse);

        // Effectue la requête AJAX
        fetch('connexion.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json()) // Convertit la réponse en JSON
        .then(data => {
            // Traite la réponse renvoyée par PHP
            if (data.success) {
                // Redirige l'utilisateur vers une autre page
                window.location.href = 'utilisateur.php'; // Remplace 'utilisateur.php' par l'URL de la page vers laquelle tu veux rediriger
            } else {
                // Affiche un message d'erreur
                document.getElementById("errorMessage").textContent = "Votre adresse email ou votre mot de passe est incorrect.";
                document.getElementById("errorMessage").style.display = "inline"; // Affiche le message d'erreur
                document.getElementById("errorMessage").style.color = "red";
            

                // Modifie le style du formulaire pour le rendre rouge
                document.getElementById("email").style.borderColor = "red";
                document.getElementById("mot_de_passe").style.borderColor = "red";
            }
        })
        .catch(error => console.error('Erreur lors de la requête:', error));
    });
});

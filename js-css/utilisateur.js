document.addEventListener("DOMContentLoaded", function() {
    var gestionDiv = document.getElementById("gestionDiv");
    var adminDIV = document.getElementById("adminDIV");
    // Vérifie le type d'abonnement pour afficher les fonctionnalités d'administration
    if (abonnement == "admin") {
        
        // Crée un élément image pour l'icône admin
        var imageElement = document.createElement("img");
        imageElement.src = "image/admin.png";
        imageElement.alt = "image admin";
        imageElement.classList.add("imageSelection"); // Corrected class addition
        adminDIV.appendChild(imageElement);


        // Crée un lien pour la gestion admin
        var linkElement = document.createElement("a");
        linkElement.href = "Ugestion.php"; 
        linkElement.textContent = "Gestion admin";
        linkElement.style.display = "inline-block";
        linkElement.style.marginTop = "10px";
        linkElement.id = "idGestionAdmin";
        linkElement.classList.add("a");
        adminDIV.appendChild(linkElement);
    }
});

document.addEventListener("DOMContentLoaded", function() {
    var gestionDiv = document.getElementById("gestionDiv");
    var adminDIV = document.getElementById("adminDIV");

    if (abonnement == "admin") {
        

        var imageElement = document.createElement("img");
        imageElement.src = "image/admin.png";
        imageElement.alt = "image admin";
        imageElement.classList.add("imageSelection"); // Corrected class addition
        adminDIV.appendChild(imageElement);



        var linkElement = document.createElement("a");
        linkElement.href = "Ugestion.php"; 
        linkElement.textContent = "Gestion admin";
        linkElement.style.display = "inline-block";
        linkElement.style.marginTop = "10px";
        linkElement.id = "idGestionAdmin";
        adminDIV.appendChild(linkElement);
    }
});

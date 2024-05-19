document.addEventListener("DOMContentLoaded", function() {

    var gestionDiv= document.getElementById("gestionDiv");

    if (abonnement == "admin") {

        var linkElement = document.createElement("a");
        linkElement.href = "Ugestion.php"; 
        linkElement.textContent = "Gestion admin";
        linkElement.style.display = "inline-block";
        linkElement.style.marginTop = "10px";
        gestionDiv.appendChild(linkElement);

        
    }


    
});

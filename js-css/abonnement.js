document.addEventListener('DOMContentLoaded', function() {
    const paymentFields = document.getElementById("paymentFields");
    const abonnementOptions = document.querySelectorAll("input[name='abonnement']");
    const cardNumber = document.getElementById("cardNumber");
    const expiryDate = document.getElementById("expiryDate");
    const cvc = document.getElementById("cvc");
    const numInput = document.getElementById("num");
    const naissanceInput = document.getElementById("naissance");
    const form = document.querySelector("form");

    abonnementOptions.forEach(option => {
        option.addEventListener("change", function() {
            if (this.value === "gratuit") {
                paymentFields.style.display = "none";
                cardNumber.removeAttribute("required");
                expiryDate.removeAttribute("required");
                cvc.removeAttribute("required");
            } else {
                paymentFields.style.display = "block";
                cardNumber.setAttribute("required", "required");
                expiryDate.setAttribute("required", "required");
                cvc.setAttribute("required", "required");
            }
        });
    });

    if (document.querySelector("input[name='abonnement']:checked").value === "gratuit") {
        paymentFields.style.display = "none";
        cardNumber.removeAttribute("required");
        expiryDate.removeAttribute("required");
        cvc.removeAttribute("required");
    } else {
        paymentFields.style.display = "block";
        cardNumber.setAttribute("required", "required");
        expiryDate.setAttribute("required", "required");
        cvc.setAttribute("required", "required");
    }

    var abonnementsPayants = document.querySelectorAll('input[name="abonnement"][value="mensuel"], input[name="abonnement"][value="trimestriel"], input[name="abonnement"][value="annuel"]');
    var paiement = document.getElementById('paymentFields');

    abonnementsPayants.forEach(function(abonnement) {
        abonnement.addEventListener('change', function() {
            if (this.checked) {
                paiement.style.display = 'block';
            } else {
                paiement.style.display = 'none';
            }
        });
    });

    var abonnementGratuit = document.querySelector('input[name="abonnement"][value="gratuit"]');
    abonnementGratuit.addEventListener('change', function() {
        if (this.checked) {
            paiement.style.display = 'none';
        }
    });

    var cardNumberInput = document.getElementById('cardNumber');
    var cvcInput = document.getElementById('cvc');
    var expiryDateInput = document.getElementById('expiryDate');

    cardNumberInput.addEventListener('input', function() {
        this.value = this.value.replace(/\D/g, ''); // Remplace tout caractère non numérique par une chaîne vide
        if (this.value.length > 16) {
            this.value = this.value.slice(0, 16); // Limite la saisie à 16 caractères
        }
    });

    cvcInput.addEventListener('input', function() {
        this.value = this.value.replace(/\D/g, ''); // Remplace tout caractère non numérique par une chaîne vide
        if (this.value.length > 3) {
            this.value = this.value.slice(0, 3); // Limite la saisie à 3 caractères
        }
    });

    expiryDateInput.addEventListener('input', function() {
        // Remplacer tout caractère non numérique sauf '/'
        this.value = this.value.replace(/[^\d\/]/g, ''); 

        // Vérifier si le mois est valide (compris entre 1 et 12)
        const parts = this.value.split('/');
        const month = parseInt(parts[0], 10);
        if (month < 1 || month > 12) {
            this.value = ''; // Réinitialiser le champ si le mois est invalide
        }
    });

    numInput.addEventListener('input', function() {
        let value = this.value.replace(/\D/g, ''); // Remplacer tout caractère non numérique
        if (value.length > 10) {
            value = value.slice(0, 10); // Limite à 10 caractères
        }

        if (value.length >= 2 && (value.slice(0, 2) !== "06" && value.slice(0, 2) !== "07")) {
            value = ""; // Réinitialiser si les deux premiers chiffres ne sont pas 06 ou 07
        }

        this.value = value;
    });

    form.addEventListener('submit', function(event) {
        const today = new Date();
        const birthDate = new Date(naissanceInput.value);
        const age = today.getFullYear() - birthDate.getFullYear();
        const monthDiff = today.getMonth() - birthDate.getMonth();
        const dayDiff = today.getDate() - birthDate.getDate();

        if (monthDiff < 0 || (monthDiff === 0 && dayDiff < 0)) {
            age--;
        }

        if (age < 18) {
            event.preventDefault();
            alert("Vous devez avoir au moins 18 ans pour vous inscrire.");
        }
    });
});
document.addEventListener('DOMContentLoaded', function() {
    const payerButton = document.getElementById('payerButton');
    const changeAbonnementButton = document.getElementById('changeAbonnementButton');
    const paymentFields = document.getElementById('paymentFields');
    const abonnements = document.querySelectorAll('input[name="abonnement"]');
    const cardNumberInput = document.getElementById('cardNumber');
    const cvcInput = document.getElementById('cvc');
    const expiryDateInput = document.getElementById('expiryDate');

    payerButton.addEventListener('click', function() {
        let abonnementSelected = false;
        abonnements.forEach(function(abonnement) {
            if (abonnement.checked) {
                abonnementSelected = true;
            }
        });

        if (abonnementSelected) {
            paymentFields.style.display = 'block';
            changeAbonnementButton.style.display = 'block';
        } else {
            alert('Veuillez sélectionner un abonnement avant de procéder au paiement.');
        }
    });

    changeAbonnementButton.addEventListener('click', function() {
        let newAbonnement = '';
        abonnements.forEach(function(abonnement) {
            if (abonnement.checked) {
                newAbonnement = abonnement.value;
            }
        });

        if (newAbonnement !== '') {
            fetch('Uparametre.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'abonnement=' + newAbonnement,
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Erreur lors de la mise à jour de l\'abonnement.');
                }
                return response.text();
            })
            .then(data => {
                if (data === 'success') {
                    alert('Abonnement mis à jour avec succès.');
                    window.location.reload();
                } else {
                    throw new Error('Erreur lors de la mise à jour de l\'abonnement.');
                }
            })
            .catch(error => {
                console.error('Error:', error.message);
                alert('Erreur lors de la mise à jour de l\'abonnement.');
            });
        } else {
            alert('Veuillez sélectionner un abonnement avant de procéder.');
        }
    });

    cardNumberInput.addEventListener('input', function() {
        this.value = this.value.replace(/\D/g, ''); // Autorise uniquement les chiffres
    });

    cvcInput.addEventListener('input', function() {
        this.value = this.value.replace(/\D/g, ''); // Autorise uniquement les chiffres
    });

    expiryDateInput.addEventListener('input', function() {
        this.value = this.value.replace(/[^0-9\/]/g, ''); // Autorise uniquement les chiffres et le caractère '/'
        
        // Limite le format à MM/AA
        if (this.value.length === 2 && !this.value.includes('/')) {
            this.value = this.value + '/';
        }
    });

    expiryDateInput.addEventListener('blur', function() {
        const [month, year] = this.value.split('/');
        if (parseInt(month, 10) < 1 || parseInt(month, 10) > 12 || month.length > 2 || year.length > 2) {
            alert('Veuillez entrer une date d\'expiration valide (MM/AA).');
            this.value = '';
        }
    });
});
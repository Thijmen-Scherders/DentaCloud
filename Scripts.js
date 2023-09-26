
        // Eventlistener toevoegen aan het inputveld
        document.getElementById("telefoon").addEventListener("input", function() {
          var telefoonInput = document.getElementById("telefoon").value;
          var telefoonRegex = /^\d{10}$/; // Dit voorbeeld accepteert 10 cijfers, pas aan volgens jouw eisen
          var foutmeldingElement = document.getElementById("foutmelding");

          if (telefoonInput.trim() === "") {
            // Telefoonnummerveld is leeg, dus de foutmelding verwijderen
            foutmeldingElement.textContent = "";
          } else if (!telefoonRegex.test(telefoonInput)) {
            foutmeldingElement.textContent = "Voer een geldig telefoonnummer in (bijv. 0123456789).";
          } else {
            foutmeldingElement.textContent = "";
          }
        });

          // Eventlistener toevoegen aan het inputveld
          document.getElementById("email").addEventListener("input", function() {
          var emailInput = document.getElementById("email").value;
          var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
          var foutmeldingElement = document.getElementById("foutmelding");

          if (emailInput.trim() === "") {
            // E-mailveld is leeg, dus de foutmelding verwijderen
            foutmeldingElement.textContent = "";
          } else if (!emailRegex.test(emailInput)) {
            foutmeldingElement.textContent = "Voer een geldig e-mailadres in.";
          } else {
            foutmeldingElement.textContent = "";
          }


           // Eventlistener toevoegen aan het inputveld
        document.getElementById("tijd").addEventListener("input", function() {
          // Huidige tijd ophalen
          var huidigeTijd = new Date();
          var uur = huidigeTijd.getHours();
          var minuten = huidigeTijd.getMinutes();

          // Ingevoerde datum en tijd ophalen uit de inputvelden
          var ingevoerdeDatum = document.getElementById("datum").value;
          var ingevoerdeTijd = document.getElementById("tijd").value;
          var ingevoerdDatumTijd = new Date(ingevoerdeDatum + "T" + ingevoerdeTijd);

          // Tijd vergelijken
          if (ingevoerdDatumTijd <= huidigeTijd) {
            document.getElementById("foutmelding").textContent = "Kies een tijd in de toekomst.";
            document.getElementById("tijd").value = ""; // Veld leegmaken
          } else {
            document.getElementById("foutmelding").textContent = "";
          }
        });
        });


        function showSuccessPopup() {
        alert('Het formulier is succesvol verzonden!');
    }

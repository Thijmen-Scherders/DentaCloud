
document.forms["createForm"].addEventListener("submit", function(event) {
  var firstname = document.getElementById("firstName").value;
  var lastname = document.getElementById("lastName").value;
  var email = document.getElementById("email").value;
  var phonenumber = document.getElementById("telefoon").value;
  var serviceId = document.getElementById("diensten").value;
  var datum = document.getElementById("date").value;
  var tijd = document.getElementById("tijd").value;

  // Clear previous error messages
  clearErrorMessages();

  var errors = [];

  if (firstname.trim() === "") {
    errors.push({ id: "firstName", message: "Vul uw voornaam in." });
  }

  if (lastname.trim() === "") {
    errors.push({ id: "lastName", message: "Vul uw achternaam in." });
  }

  if (email.trim() === "") {
    errors.push({ id: "email", message: "Vul uw e-mailadres in." });
  } else {
    var emailInput = document.getElementById("email").value;
    var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

    if (!emailRegex.test(emailInput)) {
      errors.push({ id: "email", message: "Voer een geldig e-mailadres in." });
    }
  }

  if (phonenumber.trim() === "") {
    errors.push({ id: "telefoon", message: "Vul uw telefoonnummer in." });
  } else {
    var telefoonInput = document.getElementById("telefoon").value;
    var telefoonRegex = /^\d{10}$/;

    if (!telefoonRegex.test(telefoonInput)) {
      errors.push({ id: "telefoon", message: "Voer een geldig telefoonnummer in (bijv. 0123456789)." });
    }
  }

  if (serviceId.trim() === "") {
    errors.push({ id: "diensten", message: "Selecteer een dienst." });
  }

  if (datum.trim() === "") {
    errors.push({ id: "date", message: "Vul een datum in." });
  }

  if (tijd.trim() === "") {
    errors.push({ id: "tijd", message: "Vul een tijd in." });
  }

  if (errors.length > 0) {
    // Display error messages for each field, if there are any
    for (var i = 0; i < errors.length; i++) {

      // get the id of the field that contains an error, and show the message under the ID
      var errorField = document.getElementById(errors[i].id);
      var errorMessage = errors[i].message;
      errorField.insertAdjacentHTML("afterend", "<p class='foutmelding' style='color: red;'>" + errorMessage + "</p>");
    }
    event.preventDefault(); // Prevent form to submit
  } else {
    showSuccessPopup();
  }
});

function clearErrorMessages() {
  var errorMessages = document.querySelectorAll(".foutmelding");
  errorMessages.forEach(function(message) {
    message.remove();
  });
}

function showSuccessPopup() {
  alert('Het formulier is succesvol verzonden!');
}





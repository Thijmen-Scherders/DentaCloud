<?php
include 'connect.php';

?>
<!DOCTYPE html>
<html lang="en">

<body>



<div class="container">
<form method ="post" action="action.php">

  <div class="form-group">
    <label>Voornaam</label>
    <input type="voornaam" class="form-control" placeholder="Vul hier uw voornaam in">
  </div>

 
  
  <div class="form-group">
    <label>Achternaam</label>
    <input type="text" class="form-control" placeholder="Vul hier uw achternaam in">
  </div>



  <div class="form-group">
  <label>Email address</label>
  <input type="email" class="form-control" id="email" placeholder="Vul hier uw email in">
  <p id="foutmelding" style="color: red;"></p>
</div>


<div class="form-group">
   <label>Telefoonnummer</label>
   <input type="text" class="form-control" id="telefoon" placeholder="Vul hier uw telefoonnummer in">
    <p id="foutmelding" style="color: red;"></p>
</div>

<script>
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
</script>


<script>
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
  });
</script>


<div class="form-group">
    <label>Diensten</label>
    <select name="dienst" id="diensten">
    <option value="">Maak uw keuze</option>
    <?php
         try {

          $query = "SELECT name FROM services ORDER BY NAME ASC LIMIT 0, 6";
          $result = $conn->query($query);

          while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
              echo "<option value='" . $row['name'] . "'>" . $row['name'] . "</option>";
          }
      } catch (PDOException $e) {
          die("Connection failed: " . $e->getMessage());
      } 
     ?>
    </select>
</div>

<style>
  #diensten option:first-child {
    display: none;
  }
</style>


  <div class="form-group">
    <label for="datum">Datum</label>
    <input type="date" class="form-control" id="datum" placeholder="Vul hier uw datum in" min="<?php echo date('Y-m-d', strtotime('+0 day')); ?>">
  </div>

  <div class="form-group">
    <label>Tijd</label>
    <input type="time" class="form-control" id="tijd" placeholder="Vul hier uw tijd in">
    <p id="foutmelding" style="color: red;"></p>
  </div>

 
  
<script>
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

</script>


  <button type="submit" class="btn btn-primary">Submit</button>
</form>
    



    
</body>
</html>
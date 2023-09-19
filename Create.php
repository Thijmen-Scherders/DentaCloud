<?php

include 'connect.php';

?>



<!DOCTYPE html>
<html lang="en">

<body>



<div class="container">
<form methode ="post">

  <div class="form-group">
    <label>Voornaam</label>
    <input type="voornaam" class="form-control" placeholder="Vul hier uw voornaam in">
  </div>

 
  
  <div class="form-group">
    <label>Achternaam</label>
    <input type="text" class="form-control" placeholder="Vul hier uw achternaam in">
  </div>


  <div class="form-group">
    <label>Telefoonummer</label>
    <input type="text" class="form-control" placeholder="Vul hier uw telefoonummer in">
  </div>


  <div class="form-group">
    <label>Email address</label>
    <input type="email" class="form-control" placeholder="Vul hier uw email in">
  </div>



  <div class="form-group">
    <label>Diensten</label>
    <select name="dienst" id="diensten">
        <option value="test"></option>
        <option value="test2"></option>
        <option value="test3"></option>
        <option value="test4"></option>
        <option value="test5"></option>

    </select>
  </div>


  <div class="form-group">
    <label for="datum">Datum</label>
    <input type="date" class="form-control" id="datum" placeholder="Vul hier uw datum in" min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>">
   </div>

  <div class="form-group">
    <label>Tijd</label>
    <input type="time" class="form-control"  id="tijd" placeholder="Vul hier uw tijd in">
    <p id="foutmelding" style="color: red;"></p>
  </div>

  <script>
    // Eventlistener toevoegen aan het inputveld
    document.getElementById("tijd").addEventListener("input", function() {
      // Huidige tijd ophalen
      var huidigeTijd = new Date();
      var uur = huidigeTijd.getHours();
      var minuten = huidigeTijd.getMinutes();

      // Ingevoerde tijd ophalen uit het inputveld
      var ingevoerdeTijd = document.getElementById("tijd").value;
      var ingevoerdUur = parseInt(ingevoerdeTijd.split(":")[0]);
      var ingevoerdeMinuten = parseInt(ingevoerdeTijd.split(":")[1]);

      // Tijd vergelijken
      if (ingevoerdUur < uur || (ingevoerdUur === uur && ingevoerdeMinuten < minuten)) {
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
<?php
require_once('header.php');

// Je haalt de gebruikers- en dienstgegevens op
$query = "SELECT appointments.*, users.*, services.name as serviceName
          FROM appointments
          INNER JOIN users ON appointments.userId = users.Id
          INNER JOIN services ON appointments.serviceId = services.Id";
$statement = $conn->prepare($query);
$statement->execute();
$appointments = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<?php
require_once('header.php');

?>

<body>
    <h1>Verander de afspraak van <?php echo $appointment['firstName']  ?> </h1>
    

    <?php foreach ($appointments as $appointment) : ?>
        <form method="post" action="action.php">
            <div class="form-group">
                <label>Email address</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $appointment['email'] ?>" placeholder="E-mail">
                <p id="foutmelding" style="color: red;"></p>
            </div>

            <div class="form-group">
                <label>Telefoonnummer</label>
                <input type="text" class="form-control" id="telefoon" name="phoneNumber" value="<?php echo $appointment['phoneNumber'] ?>" placeholder="Telefoonnummer">
                <p id="foutmelding" style="color: red;"></p>
            </div>

            <!-- Hidden input fields for userId and appointmentsId -->
            <input type="hidden" name="userId" value="<?php echo $appointment['userId']; ?>">
            <input type="hidden" name="serviceId" value="<?php echo $appointment['serviceId']; ?>">

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
                <select name="service" id="diensten">
                    <option value="">Maak uw keuze</option>
                    <?php
                    try {
                        $query = "SELECT name FROM services ORDER BY name ASC LIMIT 0, 6";
                        $result = $conn->query($query);

                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                            $selected = ($row['name'] == $appointment['name']) ? 'selected' : '';
                            echo "<option value='" . $row['name'] . "' $selected>" . $row['name'] . "</option>";
                        }
                    } catch (PDOException $e) {
                        die("Connection failed: " . $e->getMessage());
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="datum">Datum:</label>
                <input type="date" class="form-control" id="datum" name="date" value="<?php echo $appointment['date']; ?>" min="<?php echo date('Y-m-d', strtotime('+0 day')); ?>">
            </div>

            <div class="form-group">
                <label>Tijd</label>
                <?php
                $formattedTime = date('H:i', strtotime($appointment['time']));
                ?>
                <input type="text" class="form-control" name="time" id="tijd" value="<?php echo $formattedTime; ?>" placeholder="Vul hier uw tijd in">
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

            <button type="submit" name="update" class="btn btn-primary">Submit</button>
        </form>
    <?php endforeach; ?>
</body>

</html>
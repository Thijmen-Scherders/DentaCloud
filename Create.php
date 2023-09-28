<?php
session_start();

require_once('header.php');


if (isset($_SESSION['userId'])) {
  $userId = $_SESSION['userId'];
} else {
  $userId = NULL;
}

// check if there are any error messages in the URL
if (isset($_GET['errors']) && $_GET['errors'] === 'true') {
  $errorMessage = "Er ging iets mis. Probeer het alstublieft opnieuw.";
} else {
  $errorMessage = '';
}


logging("het afsprakenformulier bezocht", $userId);

?>
<!DOCTYPE html>
<html lang="en">

<body>

  <div class="container">
    <h1>Maak een afspraak</h1>

    <?php if (!empty($errorMessage)) : ?>
      <div class="error-message" style="color: red; margin-bottom: 10px;">
        <?php echo $errorMessage; ?>
      </div>
    <?php endif; ?>
    <form name="createForm" method="post" action="action.php">
      <div class="form-group">
        <label>Voornaam</label>
        <input type="text" id="firstName" class="form-control" name="firstname" placeholder="Vul hier uw voornaam in">

      </div>

      <input type="hidden" name="userId" value="<?php echo $appointment['userId']; ?>">
      <input type="hidden" name="serviceId" value="<?php echo $appointment['serviceId']; ?>">

      <div class="form-group">
        <label>Achternaam</label>
        <input type="text" class="form-control" id="lastName" name="lastname" placeholder="Vul hier uw achternaam in">

      </div>

      <div class="form-group">
        <label>Emailadres</label>
        <input type="email" class="form-control" name="email" id="email" placeholder="Vul hier uw email in">

      </div>

      <div class="form-group">
        <label>Telefoonnummer</label>
        <input type="text" class="form-control" name="phonenumber" id="telefoon" placeholder="Vul hier uw telefoonnummer in">

      </div>

      <div class="form-group">
        <label>Diensten</label>
        <select name="serviceId" id="diensten">
          <option value="">Maak uw keuze</option>
          <?php
          try {
            $query = "SELECT id, name FROM services ORDER BY NAME ASC LIMIT 0, 6";
            $result = $conn->query($query);

            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
              echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
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
        <input type="date" class="form-control" name="date" id="date" placeholder="Vul hier uw datum in" min="<?php echo date('Y-m-d', strtotime('+0 day')); ?>">

      </div>

      <div class="form-group">
        <label for="tijd">Tijd</label>
        <select class="form-control" id="tijd" name="time">
          <?php
          $startTime = strtotime('8:00');
          $endTime = strtotime('17:00');
          $interval = 15 * 60;
          $currentTime = time(); // Get the current time

          // Calculate the next available time that is 30 minutes from now
          $nextAvailableTime = ceil(($currentTime + 30 * 60) / $interval) * $interval;

          for ($time = $startTime; $time <= $endTime; $time += $interval) {
            if ($time >= $nextAvailableTime) {
              $roundedTime = ceil($time / $interval) * $interval;
              $formattedTime = date('H:i', $roundedTime);
              echo "<option value=\"$formattedTime\">$formattedTime</option>";
            }
          }
          ?>
        </select>

      </div>
      <input type="hidden" name="action" value="create">
      <button type="submit" name="create" class="btn btn-primary"><b>verzenden</b></button>
    </form>


    <script src="scripts.js"></script>
</body>

</html>
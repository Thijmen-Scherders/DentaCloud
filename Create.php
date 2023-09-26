<?php
session_start(); 

require_once('header.php');
include 'Scripts.php';

if (isset($_SESSION['userId'])) {
  $userId = $_SESSION['userId'];
} else {
  $userId = NULL; 
}



logging("het afsprakenformulier bezocht", $userId);

?>
<!DOCTYPE html>
<html lang="en">

<body>



  <div class="container">
    <form method="post" action="action.php">

      <div class="form-group">
        <label>Voornaam</label>
        <input type="voornaam" class="form-control" name="firstname" placeholder="Vul hier uw voornaam in">
      </div>

      <input type="hidden" name="userId" value="<?php echo $appointment['userId']; ?>">
      <input type="hidden" name="serviceId" value="<?php echo $appointment['serviceId']; ?>">


      <div class="form-group">
        <label>Achternaam</label>
        <input type="text" class="form-control" name="lastname" placeholder="Vul hier uw achternaam in">
      </div>



      <div class="form-group">
        <label>Email address</label>
        <input type="email" class="form-control" name="email" id="email" placeholder="Vul hier uw email in">
        <p id="foutmelding" style="color: red;"></p>
      </div>


      <div class="form-group">
        <label>Telefoonnummer</label>
        <input type="text" class="form-control" name="phonenumber" id="telefoon" placeholder="Vul hier uw telefoonnummer in">
        <p id="foutmelding" style="color: red;"></p>
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
        <input type="date" class="form-control" name="date" id="datum" placeholder="Vul hier uw datum in" min="<?php echo date('Y-m-d', strtotime('+0 day')); ?>">
      </div>

      <div class="form-group">
        <label>Tijd</label>
        <input type="time" class="form-control" id="tijd" name="time" placeholder="Vul hier uw tijd in">
        <p id="foutmelding" style="color: red;"></p>
      </div>




        <input type="hidden" name="action" value="create">
      <button type="submit" name="create" class="btn btn-primary" onclick="showSuccessPopup()">Submit</button>
    </form>





</body>

</html>
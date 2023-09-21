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

        
            <button type="submit" name="update" class="btn btn-primary">Submit</button>
        </form>
    <?php endforeach; ?>
</body>

</html>
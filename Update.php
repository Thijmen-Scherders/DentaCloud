<?php
session_start();

require_once('header.php');

if (isset($_SESSION['userId'])) {
    $userId = $_SESSION['userId'];
} else {
    $userId = NULL;
}



logging("het updateformulier bezocht", $userId);

$appointmentId = $_GET["id"];

if (isset($_GET['errors']) && $_GET['errors'] === 'true') {
    $errorMessage = "Er ging iets mis. Probeer het alstublieft opnieuw.";
} else {
    $errorMessage = '';
}

// Je haalt de gebruikers- en dienstgegevens op
$query = "SELECT * FROM appointments WHERE Id =$appointmentId";
$statement = $conn->prepare($query);
$statement->execute();
$appointment = $statement->fetch(PDO::FETCH_ASSOC);



$appointmentuserId = $appointment["userId"];

//get userinfo

$query = "SELECT * FROM users WHERE Id =$appointmentuserId";
$statement = $conn->prepare($query);
$statement->execute();
$user = $statement->fetch(PDO::FETCH_ASSOC);

// get serviceId

$serviceId = $appointment["serviceId"];

$query = "SELECT * FROM services WHERE Id =$serviceId";
$statement = $conn->prepare($query);
$statement->execute();
$service = $statement->fetch(PDO::FETCH_ASSOC);


// get all services

$query = "SELECT * FROM services";
$statement = $conn->prepare($query);
$statement->execute();
$services = $statement->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">

<?php
require_once('header.php');
?>


<body>
    <h1>Afspraken beheren</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Naam</th>
                <th>E-mail</th>
                <th>Telefoonnummer</th>
                <th>Dienst</th>
                <th>Datum</th>
                <th>Tijd</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $user['firstName'] . ' ' . $user['lastName']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td><?php echo $user['phoneNumber']; ?></td>
                <td><?php echo $service['name']; ?></td>
                <td><?php echo $appointment['date']; ?></td>
                <td><?php echo date('H:i', strtotime($appointment['time'])); ?></td>
            </tr>

        </tbody>
    </table>

    <!-- Voeg hier eventuele andere inhoud van de pagina toe -->

    <!-- JavaScript om de modal te openen wanneer de pagina wordt geladen -->
    <script>
        $(document).ready(function() {
            $('#editModal').modal('show');
        });
    </script>

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Verander de afspraak van <?php echo $user['firstName']; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php if (!empty($errorMessage)) : ?>
                        <div class="error-message" style="color: red; margin-bottom: 10px;">
                            <?php echo $errorMessage; ?>
                        </div>
                    <?php endif; ?>
                    <form method="POST" action="Action.php">
                        <input type="hidden" name="action" value="update">
                        <div class="form-group">
                            <label>Email address</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email'] ?>" placeholder="E-mail">
                            <p id="foutmelding" style="color: red;"></p>
                        </div>

                        <div class="form-group">
                            <label>Telefoonnummer</label>
                            <input type="text" class="form-control" id="telefoon" name="phoneNumber" value="<?php echo $user['phoneNumber'] ?>" placeholder="Telefoonnummer">
                            <p id="foutmelding" style="color: red;"></p>
                        </div>


                        <div class="form-group">
                            <label>Diensten</label>
                            <select name="service" id="diensten">
                                <option value="<?php echo $service['Id'];  ?>"><?php echo $service['name']; ?></option>
                                <?php

                                foreach ($services as $service) {
                                    if ($serviceId != $service['Id']) {
                                ?> <option value="<?php echo $service['Id']; ?>"><?php echo $service['name']; ?></option> <?php
                                                                                                                        } ?>

                                <?php
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


                        <input type="hidden" name="userId" value="<?php echo $user['Id']; ?>">
                        <input type="hidden" name="appointmentId" value="<?php echo $appointment['Id']; ?>">
                        <button type="submit" class="btn btn-primary">Opslaan</button>
                        <a class="btn btn-danger" href="delete.php?id=<?= $appointment['Id'] ?>" onclick="return confirm('Weet je zeker dat je dit record wilt verwijderen?')">Verwijderen</a>      
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="scripts.js"></script>
</body>

</html>
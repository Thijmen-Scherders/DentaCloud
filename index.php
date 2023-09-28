<!DOCTYPE html>
<html lang="en">

<body>

    <?php
    session_start();

    require_once('header.php');

    if (isset($_SESSION['userId'])) {
        $userId = $_SESSION['userId'];
    } else {
        $userId = NULL;
    }


    if (isset($_SESSION['success_message'])) {
        $successMessage = $_SESSION['success_message'];
        unset($_SESSION['success_message']);
    }

    if (isset($successMessage)) : ?>
        <div class="success-message">
            <?php echo $successMessage; ?>
        </div>
        <script>
            // Voeg JavaScript toe om het bericht na bijvoorbeeld 5 seconden te laten verdwijnen
            setTimeout(function() {
                var successMessage = document.querySelector('.success-message');
                if (successMessage) {
                    successMessage.style.display = 'none';
                }
            }, 5000); // 5000 milliseconden = 5 seconden
        </script>
    <?php endif; ?>

    <?php

    logging("het updateformulier bezocht", $userId,);

    $query = "SELECT appointments.*, users.firstName, users.lastName, users.phoneNumber, users.email, services.name 
          FROM appointments
          INNER JOIN users ON appointments.userId = users.Id
          INNER JOIN services ON appointments.serviceId = services.Id";
    $statement = $conn->prepare($query);
    $statement->execute();
    $appointments = $statement->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <div class="container-lg">
        <h1>Afspraken</h1>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Voornaam</th>
                        <th>Achternaam</th>
                        <th>Telefoonnummer</th>
                        <th>E-mailadres</th>
                        <th>Dienst</th>
                        <th>Datum</th>
                        <th>Tijd</th>
                        <th>Acties</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($appointments as $appointment) : ?>
                        <tr>
                            <td><?php echo $appointment['firstName'] ?></td>
                            <td><?php echo $appointment['lastName'] ?></td>
                            <td><?php echo $appointment['phoneNumber'] ?></td>
                            <td><?php echo $appointment['email'] ?></td>
                            <td><?php echo $appointment['name'] ?></td>
                            <td><?php echo date('d-m-Y', strtotime($appointment['date'])); ?></td>
                            <td><?php echo date('H:i', strtotime($appointment['time'])); ?></td>
                            <td class="actions">
                                <a class="btn btn-primary" href="update.php?id=<?= $appointment['Id'] ?>">Bewerken</a>
                                <a class="btn btn-danger" href="#" data-toggle="modal" data-target="#deleteModal<?= $appointment['Id'] ?>">Verwijderen</a>
                            </td>
                        </tr>

                        <!-- Modal for Deletion -->
                        <div class="modal fade" id="deleteModal<?= $appointment['Id'] ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>

                                    </div>
                                    <div class="modal-body">
                                        <p>Weet u zeker dat u deze afspraak wilt verwijderen?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>
                                        <form action="Delete.php" method="GET">
                                            <input type="hidden" name="id" value="<?= $appointment['Id'] ?>">
                                            <button type="submit" class="btn btn-primary">Verwijderen</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>



</body>

</html>
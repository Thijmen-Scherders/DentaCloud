<!DOCTYPE html>
<html lang="en">

<body>

    <?php
    require_once('header.php');
    $query = "SELECT appointments.*, users.firstName, users.lastName, services.name 
          FROM appointments
          INNER JOIN users ON appointments.userId = users.Id
          INNER JOIN services ON appointments.serviceId = services.Id";
    $statement = $conn->prepare($query);
    $statement->execute();
    $appointments = $statement->fetchAll(PDO::FETCH_ASSOC);
    ?>




    <div class="container-lg">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-8">
                            <h2>Afspraken <b></b></h2>
                        </div>
                        <div class="col-sm-4">
                            <button><a href="Create.php" class="btn btn-info add-new">
                                Maak nieuw afspraak
                            </a></button>
                        </div>
                    </div>
                </div>
                <table>
                    <thead>
                        <tr>
                            <td>Voornaam</td>
                            <td>Achternaam</td>
                            <td>Dienst</td>
                            <td>Datum</td>
                            <td>Tijd</td>
                            <td>Acties</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($appointments as $appointment) : ?>
                            <tr>
                                <td><?php echo $appointment['firstName'] ?></td>
                                <td><?php echo $appointment['lastName'] ?></td>
                                <td><?php echo $appointment['name'] ?></td>
                                <td><?php echo $appointment['date'] ?></td>
                                <td><?php echo $appointment['time'] ?></td>
                                <td class="actions">
                                    <a href="update.php?id=<?= $appointment['Id'] ?>">Bewerken</a>
                                    <a href="delete.php?id=<?= $appointment['Id'] ?>" onclick="return confirm('Weet je zeker dat je dit record wilt verwijderen?')">Verwijderen</a>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
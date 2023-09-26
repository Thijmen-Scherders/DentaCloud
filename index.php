<!DOCTYPE html>
<html lang="en">

<body>

    <?php
  session_start(); 

  require_once('header.php');
  include 'Scripts.php';
  
  if (isset($_SESSION['userId'])) {
      $userId = $_SESSION['userId'];
  } else {
      $userId = NULL; 
  }

  logging("het updateformulier bezocht", $userId, );

    $query = "SELECT appointments.*, users.firstName, users.lastName, users.phoneNumber, users.email, services.name 
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
                           
                        </div>
                    </div>
                </div>
                <table>
                    <thead>
                        <tr>
                            <td>Voornaam</td>
                            <td>Achternaam</td>
                            <td>Telefoonnummer</td>
                            <td>email</td>
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
                                <td><?php echo $appointment['phoneNumber'] ?></td>
                                <td><?php echo $appointment['email'] ?></td>
                                <td><?php echo $appointment['name'] ?></td>
                                <td><?php echo $appointment['date'] ?></td>
                                <td><?php echo $appointment['time'] ?></td>
                                <td class="actions">
                                    <a href="update.php?id=<?= $appointment['Id'] ?>">Bewerken</a>
                                    <a href="delete.php?id=<?= $appointment['Id'] ?>" onclick="return confirm('Weet je zeker dat je dit record wilt verwijderen?')">Verwijderen</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
            </div>
        </div>
    </div>
</body>

</html>
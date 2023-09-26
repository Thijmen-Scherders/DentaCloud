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
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Voornaam</th>
                    <th>Achternaam</th>
                    <th>Telefoonnummer</th>
                    <th>Email</th>
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
                        <td><?php echo $appointment['date'] ?></td>
                        <td><?php echo $appointment['time'] ?></td>
                        <td class="actions">
                            <a class="btn btn-primary" href="update.php?id=<?= $appointment['Id'] ?>">Bewerken</a>
                            <a class="btn btn-danger" href="delete.php?id=<?= $appointment['Id'] ?>" onclick="return confirm('Weet je zeker dat je dit record wilt verwijderen?')">Verwijderen</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</body>

</html>
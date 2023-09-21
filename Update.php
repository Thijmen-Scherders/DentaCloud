<?php
require_once('header.php');
include 'Scripts.php';
?>

<!DOCTYPE html>
<html lang="en">

<?php
require_once('header.php');
?>

<body>
    <?php
    $test = $_GET['id'];
    // Haal de gebruikers- en dienstgegevens op
    $queryselectedAppointments = "SELECT * FROM appointments
    WHERE id = $test";
    $statement = $conn->prepare($queryselectedAppointments);
    $statement->execute();
    $appointment = $statement->fetch(PDO::FETCH_ASSOC);
    
    $appointmentUserId = $appointment['userId'];
    // get user id of appointment
    $queryUser = "SELECT * FROM users
    WHERE id = $appointmentUserId";
    $statement = $conn->prepare($queryUser);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    $appointServiceId = $appointment['serviceId'];

    $serviceSearchQuery = "SELECT * FROM services WHERE id = $appointServiceId";
    $statement = $conn->prepare($serviceSearchQuery);
    $statement->execute();
    $selectedService = $statement->fetch(PDO::FETCH_ASSOC);


    $query = "SELECT * FROM services ORDER BY name ASC LIMIT 0, 6";
    $statement = $conn->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
?>
        
        
      <h1>Verander de afspraak van <?php echo $user['firstName'] ?></h1>  

   
        <form method="post" action="action.php">
           
                <!-- Toon het bewerkingsformulier alleen als de afspraak overeenkomt met de geselecteerde ID -->
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

                <!-- Hidden input fields for selectedAppointmentId -->
                <input type="hidden" name="selectedAppointmentId" value="<?php echo $appointment['selectedAppointmentId']; ?>">

                <div class="form-group">
                    <label>Diensten</label>
                    <select name="service" id="diensten">
                        <option value="<?php echo $selectedService['Id']; ?>"><?php echo $selectedService['name'] ?></option>
                        <?php foreach($result as $service){

                            ?>
                            <?php if($service['Id'] !=  $selectedService['Id']){
                                ?>
                            
                            <option value="<?php echo $service['id'] ?>"><?php echo $service['name'] ?></option>
                            
                            <?php
                            }
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

                <button type="submit" name="update" class="btn btn-primary">Submit</button>
       
        </form>

</body>

</html>
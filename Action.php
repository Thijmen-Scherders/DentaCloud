<?php

include 'Connect.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';
include 'LoggingFunction.php';

$action = $_POST['action'];

if ($action == "update") {
    // Define an array to store validation errors
    $errors = array();

    $firstName = htmlspecialchars($_POST["firstName"]);
    if (empty($firstName) || !ctype_alpha($firstName)) {
        $errors[] = "Invalid first name";
    }

    $lastName = htmlspecialchars($_POST["lastName"]);
    if (empty($lastName) || !ctype_alpha($lastName)) {
        $errors[] = "Invalid last name";
    }

    // Validate email format and check if it's empty
    $email = $_POST["email"];
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }

    // Validate phone number format and check if it's empty
    $phoneNumber = $_POST["phoneNumber"];
    if (empty($phoneNumber) || !preg_match("/^\d{10}$/", $phoneNumber)) {
        $errors[] = "Invalid phone number format";
    }

    // Validate service ID (assuming it's an integer) and check if it's empty
    $serviceId = $_POST["service"];
    if (empty($serviceId) || !is_numeric($serviceId) || $serviceId <= 0) {
        $errors[] = "Invalid service ID";
    }

    // Validate date format and check if it's empty
    $date = $_POST["date"];
    if (empty($date) || !strtotime($date)) {
        $errors[] = "Invalid date format";
    }

    // Validate time format and check if it's empty
    $time = $_POST["time"];
    if (empty($time) || !strtotime($time)) {
        $errors[] = "Invalid time format";
    }

    $appointmentId = $_POST['appointmentId'];

    $userId = $_POST["userId"];

    // If there are no validation errors, proceed with the updates
    if (empty($errors)) {
        $userQuery = "UPDATE users 
        SET email = :email, phoneNumber = :phoneNumber, firstName = :firstName, lastName = :lastName
        WHERE Id = :userId";
        $userStatement = $conn->prepare($userQuery);
        $userStatement->execute([
            ":firstName" => $firstName,
            ":lastName" => $lastName,
            ":email" => $email,
            ":phoneNumber" => $phoneNumber,
            ":userId" => $userId
        ]);

        $appointmentQuery = "UPDATE appointments
        SET date = :date, time = :time, serviceId = :serviceId
        WHERE Id = :appointmentId";
        $appointmentStatement = $conn->prepare($appointmentQuery);
        $appointmentStatement->execute([
            ":date" => $date,
            ":time" => $time,
            ":appointmentId" => $appointmentId,
            ":serviceId" => $serviceId
        ]);

        logging("Een afspraak is gewijzigd", $userId);

        session_start();
        $_SESSION['success_message'] = 'Uw afspraak is succesvol gewijzigd.';

        // Redirect to the index page
        header('Location: index.php');
    } else {
        // Construct the error message string with the appointmentId and generic error message

        // Redirect to "update.php" with the error message and appointmentId
        header('Location: update.php?id=' . $appointmentId . '&errors=true');
        // Exit the script to ensure the redirect takes effect
        exit;
    }
}

if (isset($_POST['create'])) {
    $email = $_POST["email"];
    $phoneNumber = $_POST["phonenumber"];
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $date = $_POST["date"];
    $time = $_POST["time"];
    $serviceId = $_POST["serviceId"];

    $errors = array();

    // Validate email format and check if it's empty
    $email = $_POST["email"];
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }

    // Validate phone number format and check if it's empty
    $phoneNumber = $_POST["phonenumber"];
    if (empty($phoneNumber) || !preg_match("/^\d{10}$/", $phoneNumber)) {
        $errors[] = "Invalid phone number format";
    }

    // Validate service ID (assuming it's an integer) and check if it's empty
    $serviceId = $_POST["serviceId"];
    if (empty($serviceId) || !is_numeric($serviceId) || $serviceId <= 0) {
        $errors[] = "Invalid service ID";
    }

    // Validate date format and check if it's empty
    $date = $_POST["date"];
    if (empty($date) || !strtotime($date)) {
        $errors[] = "Invalid date format";
    }

    // Validate time format and check if it's empty
    $time = $_POST["time"];
    if (empty($time) || !strtotime($time)) {
        $errors[] = "Invalid time format";
    }

    // If there are no validation errors, proceed with creating the appointment
    if (empty($errors)) {

        // Voeg eerst een nieuwe gebruiker toe
        $userQuery = "INSERT INTO users (email, phoneNumber, firstname, lastname) VALUES (:email, :phoneNumber, :firstname, :lastname)";
        $userStatement = $conn->prepare($userQuery);
        $userStatement->execute([
            ":email" => $email,
            ":phoneNumber" => $phoneNumber,
            ":firstname" => $firstname,
            ":lastname" => $lastname,
        ]);

        // Haal de ID op van de zojuist toegevoegde gebruiker
        $userId = $conn->lastInsertId();

        // Voeg vervolgens een nieuwe afspraak toe
        $appointmentQuery = "INSERT INTO appointments (userId, serviceId, date, time) VALUES (:userId, :serviceId, :date, :time)";
        $appointmentStatement = $conn->prepare($appointmentQuery);
        $appointmentStatement->execute([
            ":userId" => $userId,
            ":serviceId" => $serviceId,
            ":date" => $date,
            ":time" => $time,
        ]);

        logging("een afspraak aangemaakt", $userId);



        // Dit potentieel nog veranderen naar support@bsolutions.nl

        $mail = new PHPMailer\PHPMailer\PHPMailer(true);

        $mail->isSMTP();
        $mail->Host = 'vps.bg-techno.nl';
        $mail->SMTPAuth = true;
        $mail->Username = 'testaccount@bsolutions.nl';
        $mail->Password = '[GhRXcE{8I1w';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->SMTPDebug = 2;

        $mail->setFrom('123@email.nl', 'Test_BSolutions');
        $mail->addAddress('mark@bsolutions.nl', 'Company Name');
        $mail->Subject = 'Nieuwe afspraakbevestiging.';

        $queryServices = "SELECT services.name
        FROM services
        INNER JOIN appointments ON services.id = appointments.serviceId
        WHERE appointments.serviceId = :serviceId";
        $statement = $conn->prepare($queryServices);
        $statement->bindParam(':serviceId', $serviceId, PDO::PARAM_INT);
        $statement->execute();
        $service = $statement->fetch(PDO::FETCH_ASSOC);
        $serviceName = $service['name'];

        $query = "SELECT appointments.*, users.firstName, users.lastName, users.phoneNumber, users.email, services.name 
        FROM appointments
        INNER JOIN users ON appointments.userId = users.Id
        INNER JOIN services ON appointments.serviceId = services.Id";
        $statement = $conn->prepare($query);
        $statement->execute();
        $appointments = $statement->fetchAll(PDO::FETCH_ASSOC);


        $mail->Body = 'Een nieuwe afspraak is gemaakt door ' . $firstname . ' ' . $lastname . ' voor ' . $serviceName . ' op ' . $date . ' om ' . $time . '.';

        try {
            $mail->send();
            echo "Afspraak is succesvol toegevoegd en een bevestigingsmail is verzonden naar het bedrijf.";
        } catch (Exception $e) {
            echo "Er is een probleem opgetreden bij het verzenden van de bevestigingsmail.";
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }
        session_start();
        $_SESSION['success_message'] = 'Uw afspraak is succesvol toegevoegd.';

        // Redirect to the index page
        header('Location: index.php');
    } else {
        // Construct the error message string with errors=true
        header('Location: create.php?errors=true');
        // Exit the script to ensure the redirect takes effect
        exit;
    }
}

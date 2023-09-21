<?php

include 'Connect.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

$action = $_POST['update'];
if($action == "update" ) {
    $email = $_POST["email"];
    //var_dump($email);
    //die();
    $phoneNumber = $_POST["phoneNumber"];
    $service = $_POST["service"];
    $date = $_POST["date"];
    $time = $_POST["time"];
    $serviceName = $_POST["service"];
    $serviceId = $_POST["serviceId"];
    $userId = $_POST["userId"];


    $userQuery = "UPDATE users 
    SET email = :email, phoneNumber = :phoneNumber
    WHERE Id = :userId";
    $userStatement = $conn->prepare($userQuery);
    $userStatement->execute([
        ":email" => $email,
        ":phoneNumber" => $phoneNumber,
        ":userId" => $userId
    ]);


    $appointmentQuery = "UPDATE appointments
    SET date = :date, time = :time
    WHERE userId = :userId AND serviceId = :serviceId";
    $appointmentStatement = $conn->prepare($appointmentQuery);
    $appointmentStatement->execute([
        ":date" => $date,
        ":time" => $time,
        ":userId" => $userId,
        ":serviceId" => $serviceId
    ]);
  
}





if (isset($_POST['create'])) {
    $email = $_POST["email"];
    $phoneNumber = $_POST["phonenumber"];
    $firstname = $_POST["firstname"]; 
    $lastname = $_POST["lastname"];   
    $date = $_POST["date"];
    $time = $_POST["time"];
    $serviceId = $_POST["serviceId"];

    

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


    // mail sturen met afspraakbevestiging. Mailgegevens moeten we nog krijgen. Als we die hebben, kan onderstaande weer uit comment.
    /*
    $mail = new PHPMailer\PHPMailer\PHPMailer(true); 

    $mail->isSMTP();
    $mail->Host = '';
    $mail->SMTPAuth = true;
    $mail->Username = ''; 
    $mail->Password = ''; 
    $mail->SMTPSecure = 'tls'; 
    $mail->Port = 587; 
    $mail->SMTPDebug = 2;

    $mail->setFrom('email', 'naam');
    $mail->addAddress($email, $firstname . ' ' . $lastname);

    $mail->Subject = 'Afspraakbevestiging';
    $mail->Body = 'Beste ' . $firstname . ' ' . $lastname . ', 
                   Uw afspraak voor ' . $serviceId . ' op ' . $date . ' om ' . $time . ' is succesvol toegevoegd.';

    if ($mail->send()) {
        echo "Afspraak is succesvol toegevoegd en een bevestigingsmail is verzonden.";
    } else {
        echo "Er is tifeen probleem opgetreden bij het verzenden van de bevestigingsmail.";
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
*/


    // Nu is de nieuwe afspraak toegevoegd aan de database

    // Je kunt hier een succesmelding tonen of de gebruiker doorverwijzen naar een andere pagina
    echo "Afspraak is succesvol toegevoegd.";
}


header("Location: index.php");
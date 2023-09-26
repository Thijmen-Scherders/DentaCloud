<?php

include 'Connect.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

$dateNow = date('d-m-Y H:i');
$ipAddress = $_SERVER['REMOTE_ADDR']; 

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

    logging("Een afspraak is gewijzigd", $dateNow, $userId, $ipAddress);

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

    logging("een afspraak aangemaakt", $dateNow, $userId, $ipAddress);


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
    $mail->addAddress('mark@bsolutions.nl', 'Company Name'); // Replace with the company's email address
    $mail->Subject = 'Nieuwe afspraakbevestiging.'; // Change the subject as needed
    
    // Compose the email body with appointment details
    $mail->Body = 'Een nieuw afspraak is gemaakt door ' . $firstname . ' ' . $lastname . ' voor ' . $serviceId . ' op ' . $date . ' om ' . $time . '.';
    
    try {
        $mail->send();
        echo "Afspraak is succesvol toegevoegd en een bevestigingsmail is verzonden naar het bedrijf.";
    } catch (Exception $e) {
        echo "Er is een probleem opgetreden bij het verzenden van de bevestigingsmail.";
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    }


    // Nu is de nieuwe afspraak toegevoegd aan de database

    // Je kunt hier een succesmelding tonen of de gebruiker doorverwijzen naar een andere pagina
    echo "Afspraak is succesvol toegevoegd.";
    
}

function logging($message, $dateNow, $userId, $ipAddress)
{
    include 'Connect.php'; 
    $LogsQuery = "INSERT INTO logs (userId, date, ipAddress, message) VALUES (:userId, :date, :ipAddress, :message)";
    $logsStatement = $conn->prepare($LogsQuery);
    $logsStatement->execute([
        ":date" => $dateNow,
        ":userId" => $userId,
        ":ipAddress" => $ipAddress,
        ":message" => $message,
    ]);
}


// header("Location: index.php");



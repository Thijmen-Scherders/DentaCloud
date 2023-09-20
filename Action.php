<?php

include 'Connect.php';

if (isset($_POST['update'])) {

    $userId = $_POST["userId"];
    $email = $_POST["email"];
    $phoneNumber = $_POST["phoneNumber"];
    $service = $_POST["service"];
    $date = $_POST["date"];
    $time = $_POST["time"];
    $serviceName = $_POST["service"];
    $serviceId = $_POST["serviceId"];
    $userId = $_POST["userId"];


<<<<<<< Updated upstream
    $userQuery = "UPDATE users 
    SET email = :email, phoneNumber = :phoneNumber
    WHERE Id = :userId";
    $userStatement = $conn->prepare($userQuery);
    $userStatement->execute([
        ":email" => $email,
        ":phoneNumber" => $phoneNumber,
        ":userId" => $userId
    ]);

    print_r($serviceId);

    $serviceQuery = "UPDATE services
    SET name = :name
    WHERE Id = :serviceId";
    $serviceStatement = $conn->prepare($serviceQuery);
    $serviceStatement->execute([
        ":name" => $serviceName,
        ":serviceId" => $serviceId
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


    header("Location: index.php");
}
=======


?>
>>>>>>> Stashed changes

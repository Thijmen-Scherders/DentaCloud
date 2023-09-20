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
  
}


if (isset($_POST['create'])) {
    echo "test";
    $email = $_POST["email"];
    $phoneNumber = $_POST["phoneNumber"];
    $service = $_POST["service"];
    $date = $_POST["date"];
    $time = $_POST["time"];

    // Voeg eerst een nieuwe gebruiker toe
    $userQuery = "INSERT INTO users (email, phoneNumber) VALUES (:email, :phoneNumber)";
    $userStatement = $conn->prepare($userQuery);
    $userStatement->execute([
        ":email" => $email,
        ":phoneNumber" => $phoneNumber,
    ]);

    // Haal de ID op van de zojuist toegevoegde gebruiker
    $userId = $conn->lastInsertId();

    // Voeg vervolgens een nieuwe afspraak toe
    $serviceId = ''; // Vul hier de serviceId in op basis van de geselecteerde dienst

    $appointmentQuery = "INSERT INTO appointments (userId, serviceId, date, time) VALUES (:userId, :serviceId, :date, :time)";
    $appointmentStatement = $conn->prepare($appointmentQuery);
    $appointmentStatement->execute([
        ":userId" => $userId,
        ":serviceId" => $serviceId,
        ":date" => $date,
        ":time" => $time,
    ]);

    // Nu is de nieuwe afspraak toegevoegd aan de database

    // Je kunt hier een succesmelding tonen of de gebruiker doorverwijzen naar een andere pagina
    echo "Afspraak is succesvol toegevoegd.";

    header("Location: index.php");
}

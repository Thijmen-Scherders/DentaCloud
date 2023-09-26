<?php 
function logging($message,$userId)
{
    $dateNow =date("Y-m-d H:i:s");
    $ipAddress= $_SERVER['REMOTE_ADDR']; 
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
?>
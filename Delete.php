
<?php
include 'connect.php';
include 'LoggingFunction.php';



if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    // Ontvang de ID van het te verwijderen record
    $recordId = $_GET["id"];

    try {
      
        // Voer een SQL-query uit om het record uit de database te verwijderen
        $sql = "DELETE FROM appointments WHERE Id = :recordId";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':recordId', $recordId, PDO::PARAM_INT); // Juiste variabele gebruiken
        $stmt->execute();

        // Je kunt hier een succesmelding tonen of de gebruiker doorverwijzen naar een andere pagina
        echo "Record $recordId is succesvol verwijderd.";
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }

    if (isset($_SESSION['userId'])) {
        $userId = $_SESSION['userId'];
      } else {
        $userId = NULL;
      }
      
    logging("een afspraak verwijderd", $userId);
    header("Location: index.php");
}
?>

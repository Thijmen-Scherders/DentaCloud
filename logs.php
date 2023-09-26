<!DOCTYPE html>
<html lang="en">

<body>

    <?php
    require_once('header.php');
    $logQuery = "SELECT * FROM logs";
    
    $statement = $conn->prepare($logQuery);
    $statement->execute();
    $logs = $statement->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <div class="container-lg">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-8">
                            <h2>Logs <b></b></h2>
                        </div>
                        <div class="col-sm-4">

                        </div>
                    </div>
                </div>
                <table>
                    <thead>
                        <tr>
                            <td>Logs</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($logs as $log) : ?>
                            <tr>
                                <td>
                                    <?php
                                    $timestamp = $log['date'];
                                    $userId = $log['userId']; 
                                    $message = $log['message'];

                                    if ($userId != NULL)
                                    {
                                        $logMessage = "Op $timestamp heeft klant met ID-nummer: $userId $message via IP-adres {$log['ipAddress']}." . PHP_EOL;
                                    }
                                    elseif ($userId == NULL)
                                    {
                                        $logMessage = "Op $timestamp heeft iemand $message via IP-adres {$log['ipAddress']}." . PHP_EOL;
                                    }                                  
                                    echo $logMessage;
                                    ?>
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
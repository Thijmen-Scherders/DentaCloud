<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Dentacloud Crud</title>
    <?php include_once("Connect.php");
    include_once('LoggingFunction.php');



    ?>
</head>

<body>
    <div class="header">
        <div class="left-section">
            <a class="logo-img" href="index.php">
                <img class="logo_cloud" src="img/wolk-white.png" alt="witte wolk">
                <img class="logo_text" src="img/DentaCloud text white.png" alt="logo bedrijf">
            </a>
        </div>
        <div class="right-section">
            <ul class="header-menu">
                <li><a href="index.php"><b>Afspraken</b></a></li>
                <li><a href="create.php"><b>Maak een afspraak</b></a></li>
                <li><a href="logs.php"><b>Logboek</b></a></li>
            </ul>
        </div>
    </div>
</body>

</html>
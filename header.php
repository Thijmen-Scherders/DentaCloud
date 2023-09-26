<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <title>Dentacloud Crud</title>
    <?php include_once("Connect.php");
    include 'Action.php';
    ?>
</head>
<body>
    <div class="header">
        <div class="left-section">
            <img src="" alt="logo bedrijf">
        </div>
        <div class="right-section">
            <ul class="header-menu">
                <li><a href="index.php">Afspraken</a></li>
                <li><a href="create.php">Maak een afspraak</a></li>
                <li><a href="logs.php">Logs</a></li>
            </ul>
        </div>
    </div>
</body>
<style>
    /* Voor nu style hier. Later met bootstrap en met de huisstijl van het bedrijf. */

    .header {
        display: flex;
        background-color: black;
        height: 80px;
        color: white;
        justify-content: space-between;
    }

    .left-section {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .right-section {
        display: flex;
        align-items: center;
        width: 300px;
    }

    .header-menu {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
    }

    .header-menu li {
        margin-right: 20px;
    }

    .header-menu li a {
        text-decoration: none;
        color: white;
    }
</style>
</html>
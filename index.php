<!DOCTYPE html>
<html lang="en">

<body>

    <?php
        require_once('header.php');
        $query="SELECT * FROM appointments";
        $statement=$conn->prepare($query);
        $statement->execute();
        $appointments=$statement->fetchAll(PDO::FETCH_ASSOC);
    ?>
  
    <div class="container-lg">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-8">
                            <h2>Afspraken <b></b></h2>
                        </div>
                        <div class="col-sm-4">
                            <button type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i> Add New</button>
                        </div>
                    </div>
                </div>
                <table>
                    <thead>
                        <tr>
                            <td>Voornaam</td>
                            <td>Dienst</td>
                            <td>Datum</td>
                            <td>Acties</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($appointments as $appointment) : ?>
                            <tr>
                                <td><?php echo $appointment['firstName'] ?></td>
                                <td><?php echo $appointment['service'] ?></td>
                                <td><?php echo $appointment['date'] ?></td>
                                <td class="actions">
                                    <a href="update.php?id=<?= $contact['id'] ?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                                    <a href="delete.php?id=<?= $contact['id'] ?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
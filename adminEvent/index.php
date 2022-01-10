<!DOCTYPE html>
<html>
    <head>
        <title>evenements</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="../css/styles.css">
    </head>
    
    <body>
    <h1 class="text-logo"></span> Anomic Element Artiste </span></h1>
        <div class="container admin">
            <div class="row">
                <h1><strong>  Liste des evenements   </strong><a href="insert.php" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-plus"></span> Ajouter</a></h1>
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Nom</th>
                      <th>date</th>
                      <th>Adresse</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                        require 'database.php';
                        $db = Database::connect();
                        $statement = $db->query('SELECT event.id,event.name, event.date, event.event_adresse FROM event');
                        while($item = $statement->fetch()) {
                            echo '<tr>';
                            echo '<td>'. $item['name'] . '</td>';
                            echo '<td>'. $item['date'] . '</td>';
                            echo '<td>'. $item['event_adresse'] . '</td>';
                            echo '<td width=340>';
                            echo '<a class="btn btn-secondary" href="view.php?id='.$item['id'].'"><span class="bi-eye"></span> Voir</a>';
                            echo ' ';
                            echo '<a class="btn btn-primary" href="update.php?id='.$item['id'].'"><span class="bi-pencil"></span> Modifier</a>';
                            echo ' ';
                            echo '<a class="btn btn-danger" href="delete.php?id='.$item['id'].'"><span class="bi-x"></span> Supprimer</a>';
                            echo '</td>';
                            echo '</tr>';
                        }
                        Database::disconnect();
                      ?>
                   
                  </tbody>
                </table>
            </div>
        </div>
    </body>
</html>

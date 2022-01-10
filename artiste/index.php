<!DOCTYPE html>
<html>
    <head>
        <title>ARTISE</title>
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
    <h1 class="text-logo"><span class="glyphicon glyphicon-cutlery"></span> Anomic Element Artiste <span class="glyphicon glyphicon-cutlery"></span></h1>
        <div class="container admin">
            <div class="row">
                
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Nom</th>
                      <th>Presentation</th>
                      <th>Catégorie</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                        require 'database.php';
                        $db = Database::connect();
                        $statement = $db->query('SELECT artise.id, artise.nomArtise, artise.presentation, ar_cate.name_cate AS  categorie FROM artise LEFT JOIN ar_cate ON artise.Categorie = ar_cate.id ORDER BY artise.id DESC');
                        while($item = $statement->fetch()) {
                            echo '<tr>';
                            echo '<td>'. $item['nomArtise'] . '</td>';
                            echo '<td>'. $item['presentation'] . '</td>';
                            echo '<td>'. $item['categorie'] . '</td>';
                            echo '<td width=340>';
                            echo '<a class="btn btn-secondary" href="view.php?id='.$item['id'].'"><span class="bi-eye"></span> Voir </a>';
                            echo ' ';
                          
                            
                        }
                       
                       
                       
                     
                        Database::disconnect();

                      ?>
                      
                     
                   
                  </tbody>
                </table>
                <br>
                <a class="btn btn-primary" href="../"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
            </div>
        </div>
    </body>
</html>

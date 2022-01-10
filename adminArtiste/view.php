<?php
    require 'database.php';

    if(!empty($_GET['id'])) {
        $id = checkInput($_GET['id']);
    }
     
    $db = Database::connect();
  
   $statement = $db->query('SELECT artise.id, artise.nomArtise, artise.presentation, artise.img, ar_cate.name_cate AS  categorie FROM artise LEFT JOIN ar_cate ON artise.Categorie = ar_cate.id where artise.id = '.$id);
    $item = $statement->fetch();
    
    Database::disconnect();

    function checkInput($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

?>

<!DOCTYPE html>
<html>
    <head>
      <title>View</title>
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
      <h1 class="text-logo"></span> Anomic Element </span></h1>
      <div class="container admin">
        <div class="row">
          <div class="col-md-6">
            <h1><strong>Voir un artiste</strong></h1>
            <br>
            <form>
              <div>
                <label>Nom:</label><?php echo '  '.$item['nomArtise'];?>
              </div>
              <br>
              <div>
                <label>Description:</label><?php echo '  '.$item['presentation'];?>
              </div>
              <br>
              
              <div>
                <label>Catégorie:</label><?php echo '  '.$item['categorie'];?>

              </div>
              <br>
              <div>
                <label>Image:</label><?php echo '  '.$item['img'];?>
              </div>
            </form>
            <br>
            <div class="form-actions">
              <a class="btn btn-primary" href="index.php"><span class="bi-arrow-left"></span> Retour</a>
            </div>
          </div>
          <div class="col-md-6 site">
            <div class="img-thumbnail">
              <img src="<?php echo '../images/'.$item['img'];?>" alt="...">
             
              <div class="caption">
                <h4><?php echo $item['nomArtise'];?></h4>
                <p><?php echo $item['presentation'];?></p>
               
              </div>
            </div>
          </div>
        </div>
      </div>   
    </body>
</html>

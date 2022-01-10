<?php
    require 'database.php';

    if(!empty($_GET['id'])) {
        $id = checkInput($_GET['id']);
    }
     
    $db = Database::connect();
  
    $s = $db->prepare("SELECT event.id, event.name, event.date, event.event_adresse, event.img, artise.id AS Artiste FROM event LEFT JOIN artise ON event.artise = artise.id WHERE event.id =?");
            
    $s->execute(array ($id));
    //$statement = $db->query("SELECT event.id, event.name, event.date, event.event_adresse, event.img, artise.id AS Artiste FROM event LEFT JOIN artise ON event.artise = artise.id WHERE event.id ='.$id'");
    $item = $s->fetch();
    
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
            <h1><strong>Voir un evenement</strong></h1>
            <br>
            <form>
              <div>
                <label>Nom:</label><?php echo '  '.$item['name'];?>
              </div>
              <br>
              <div>
                <label>Date:</label><?php echo '  '.$item['date'];?>
              </div>
              <br>
              
              <div>
                <label>Adresse:</label><?php echo '  '.$item['event_adresse'];?>

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
                <h4><?php echo $item['name'];?></h4>
                <p><?php echo $item['date'];?></p>
               
              </div>
            </div>
          </div>
        </div>
      </div>   
    </body>
</html>

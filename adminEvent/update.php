<?php

    require 'database.php';

    if(!empty($_GET['id'])) 
    {
        $id = checkInput($_GET['id']);
    }

    $nameError = $dateError = $adresseError = $imageError = $name = $adresse  = $date = $image = $artiste = $artisteError ="";

    if(!empty($_POST)) 
    {
     
      
        $name               = checkInput($_POST['name']);
        $date            = checkInput($_POST['date']);
        $artiste          = checkInput($_POST['artiste']); 
        $image              = checkInput($_FILES["image"]["name"]);
        $adresse =  checkInput($_POST['adresse']);
        $imagePath          = '../images/'. basename($image);
        $imageExtension     = pathinfo($imagePath,PATHINFO_EXTENSION);
        $isSuccess          = true;
        $isUploadSuccess    = false;
       
        if(empty($name)) 
        {
            $nameError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
        if(empty($date)) 
        {
            $dateError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        } 
        if(empty($adresse)) 
        {
            $adresseError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        } 
         
        if(empty($artiste)) 
        {
            $artisteError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
        if(empty($image)) // le input file est vide, ce qui signifie que l'image n'a pas ete update
        {
            $isImageUpdated = false;
        }
        else
        {
            $isImageUpdated = true;
            $isUploadSuccess =true;
            if($imageExtension != "jpg" && $imageExtension != "png" && $imageExtension != "jpeg" && $imageExtension != "gif" ) 
            {
                $imageError = "Les fichiers autorises sont: .jpg, .jpeg, .png, .gif";
                $isUploadSuccess = false;
            }
            if(file_exists($imagePath)) 
            {
                $imageError = "Le fichier existe deja";
                $isUploadSuccess = false;
            }
            if($_FILES["image"]["size"] > 500000) 
            {
                $imageError = "Le fichier ne doit pas depasser les 500KB";
                $isUploadSuccess = false;
            }
            if($isUploadSuccess) 
            {
                if(!move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath)) 
                {
                    $imageError = "Il y a eu une erreur lors de l'upload";
                    $isUploadSuccess = false;
                } 
            } 
        }
         
        if (($isSuccess && $isImageUpdated && $isUploadSuccess) || ($isSuccess && !$isImageUpdated)) 
        { 
            $db = Database::connect();
            if($isImageUpdated)
            {
                $statement = $db->prepare("UPDATE event  set name = ?, date = ?,  event_adresse = ?, img = ? , artise = ? WHERE id = ?");
                $statement->execute(array($name,$date,$adresse,$image,$artiste,$id));
            }
            else
            {
                $statement = $db->prepare("UPDATE event  set name = ?, date = ?, event_adresse= ?,artise = ? WHERE id = ?");
                $statement->execute(array($name,$date,$adresse,$artiste,$id));
            }
            Database::disconnect();
            header("Location: index.php");
        }
        else if($isImageUpdated && !$isUploadSuccess)
        {
            $db = Database::connect();
            $statement = $db->prepare("SELECT * FROM event where id = ?");
            $statement->execute(array($id));
            $item = $statement->fetch();
            $image          = $item['img'];
            Database::disconnect();
           
        }
    }
    else 
    {
        $db = Database::connect();
        $statement = $db->prepare("SELECT * FROM event where id = ?");
        $statement->execute(array($id));
        $item = $statement->fetch();
        $name           = $item['name'];
        $date    = $item['date'];
        $adresse       = $item['event_adresse'];
        $artiste = $item['artise'];
        $image          = $item['img'];
        Database::disconnect();
    }

    function checkInput($data) 
    {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

?>



<!DOCTYPE html>
<html>
    <head>
        <title>Modifier</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="../css/styles.css">
    </head>
    
    <body>
        <h1 class="text-logo"></span> Anomic Element </span></h1>
         <div class="container admin">
            <div class="row">
                <div class="col-sm-6">
                    <h1><strong>Modifier une evenement</strong></h1>
                    <br>
                    <form class="form" action="<?php echo 'update.php?id='.$id;?>" role="form" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name">Nom:
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nom" value="<?php echo $name;?>">
                            <span class="help-inline"><?php echo $nameError;?></span>
                        </div>
                        <div class="form-group">
                            <label for="description">Date:
                            <input type="text" class="form-control" id="date" name="date" placeholder="date" value="<?php echo $date;?>">
                            <span class="help-inline"><?php echo $dateError;?></span>
                        </div>
                        <div class="form-group">
                        <label for="description">Adresse:</label>
                        <input type="text" class="form-control" id="Adresse" name="adresse" placeholder="Adresse" value="<?php echo $date;?>">
                        <span class="help-inline"><?php echo $dateError;?></span>
                    </div>
                


                    <br>
                   <div class="form-group">
                        <label for="artiste">Artiste:</label>
                        <select class="form-control" id="artiste" name="artiste">
                          
                            <?php
                           $db = Database::connect();
                            foreach ($db->query('SELECT * FROM artise') as $row) 
                            {
                                    echo '<option value="'. $row['id'] .'">'. $row['nomArtise'] . '</option>';;
                            }
                            Database::disconnect();
                            ?>
                        </select>
                        <span class="help-inline"><?php echo $artisteError;?></span>
                    </div>
                        <div class="form-group">
                            <label for="image">Image:</label>
                            <p><?php echo $image;?></p>
                            <label for="image">Sélectionner une nouvelle image:</label>
                            <input type="file" id="image" name="image"> 
                            <span class="help-inline"><?php echo $imageError;?></span>
                        </div>
                        <br>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span> Modifier</button>
                            <a class="btn btn-primary" href="index.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                       </div>
                    </form>
                </div>
                <div class="col-sm-6 site">
                    <div class="thumbnail">
                        <img src="<?php echo '../images/'.$image;?>" alt="...">
                          <div class="caption">
                            <h4><?php echo $name;?></h4>
                            <p><?php echo $date;?></p>
                          </div>
                    </div>
                </div>
            </div>
        </div>   
    </body>
</html>

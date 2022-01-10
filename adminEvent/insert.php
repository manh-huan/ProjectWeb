<?php
     
    require 'database.php';
 
    $nameError = $dateError  = $artisteError = $imageError = $name = $date  =  $image = $adresse = "";

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

        echo $name ; echo $date ; echo $artiste ; echo $image; echo $adresse;
        
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

        if(empty($artiste)) 
        {
            $artisteError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
        if(empty($image)) 
        {
            $imageError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
        else
        {
            $isUploadSuccess = true;
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
        
        if($isSuccess && $isUploadSuccess) 
        {
            $db = Database::connect();
            $statement = $db->prepare("INSERT INTO event (name,date,event_adresse,img,artise) values(?, ?, ?, ?,?)");
            
        
            $statement->execute(array ( $name,$date, $adresse ,$image,$artiste));
            
            Database::disconnect();
            header("Location: index.php");
        }
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
        <title>Evenement</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="../css/styles.css">
    </head>
    
    <body>
        <h1 class="text-logo"></span> Ajouter un evenement </span></h1>
         <div class="container admin">
            <div class="row">
                <h1><strong>Ajouter un evenement</strong></h1>
               
                <form class="form" action="insert.php" role="form" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Nom:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nom" value="<?php echo $name;?>">
                        <span class="help-inline"><?php echo $nameError;?></span>
                    </div>
                    <div class="form-group">
                        <label for="description">Date:</label>
                        <input type="text" class="form-control" id="date" name="date" placeholder="Date" value="<?php echo $date; ?>">
                        <span class="help-inline"><?php echo $dateError;?></span>
                    </div>
                    
                    <br>
                    <div class="form-group">
                        <label for="description">Adresse:</label>
                        <input type="text" class="form-control" id="Adresse" name="Adresse" placeholder="Adresse" value="<?php echo $date;?>">
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
                        <label for="image">Sélectionner une image:</label>
                        <input type="file" id="image" name="image"> 
                        <span class="help-inline"><?php echo $imageError;?></span>
                    </div>
                <div class="form-actions">
                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span> Ajouter</button>
                        <a class="btn btn-primary" href="index.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                   </div>
                </form>
            </div>
        </div>   
    </body>
</html>
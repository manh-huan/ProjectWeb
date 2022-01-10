
<?php
require 'database.php';

  if(isset($_POST['valider']))
  {
  	if(isset($_POST['user_name']) AND isset($_POST['user_email']) AND isset($_POST['user_message']))
  	{
  		if(!empty($_POST['user_name']) AND !empty($_POST['user_email']) AND !empty($_POST['user_message']))
  		{
           $name=htmlspecialchars($_POST['user_name']);
           $email=htmlspecialchars($_POST['user_email']);
           $message=htmlspecialchars($_POST['user_message']);

           $db = Database::connect();

           $statement = $db->prepare("INSERT INTO client (nom,mail,message) values(?, ?,?)");
           
       
           $statement->execute(array (  $_POST['user_name'], $_POST['user_email'] , $_POST['user_message'] ));
           
           Database::disconnect();

           header("Location: index.php");
         
           
      
          
  		}
      else 
      header("Location:contactErreur.html"); 
  	}
    else 
    header("Location:contactErreur.html"); 
  }

?>
<?php
   session_start();

   if(!isset($_SESSION['email'])){
    header('Location:../index.php');
   }

   include_once('../db_connection.php');

   
    
    


   
   
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../style.css"/>
    <title>Ajouter un produit</title>
</head>
<body class="container">

     <!-- Ajout de l'entete du document-->  
     <?php include_once('header.php');  ?>
     
     <?php 

       //verification pour savoir si les informations sont presentes
        //si oui
          if(isset($_POST) && isset($_FILES['image']) && !empty($_FILES['image'])){

        //Verification pour voir s'il n'y a pas d'erreur de chargement du fichier
        //si non
            if($_FILES['image']['error'] == 0){

                $fileInfo = pathinfo($_FILES['image']['name']);
                $extension = $fileInfo['extension'];
                
                $extension=strtolower($extension);
                  //voir si l'extension est autorisee
                  //si oui
                  if(in_array($extension,['jpeg','jpg','png','gif'])){

                       $time = time();
                       $newName = $time.basename($_FILES['image']['name']);
                       

                        move_uploaded_file($_FILES['image']['tmp_name'],'../images/'.$newName);
                         

                        //insertion de l'image dans la base de donnees
                        $insertReq ='INSERT INTO products(name,description,quantity,unit,price,image,created_at,updated_at,idUser)
                        VALUES(:name,:description,:quantity,:unit,:price,:image,:created_at,:updated_at,:idUser)';
                        
                        $insertStatement = $db->prepare($insertReq);
                        $insertStatement->execute(
                            [
                                "name" => $_POST['name'],
                                "description" => $_POST['description'],
                                "quantity" => $_POST['quantity'],
                                "unit" => $_POST['unit'],
                                "price" => $_POST['price'],
                                "image" => $newName,
                                "created_at" => $_POST['created_at'],
                                "updated_at" => null,
                                "idUser" => $_SESSION['idUser']
                            ]
                        ); 

                       if($insertStatement){
                           echo '<p class="alert alert-success" role="alert"> Produit ajoute avec succes </p>';
                       }else{
                           echo '<p class="alert alert-danger" role="alert"> Echec de l\'ajout du produit </p>';

                       }
                  //si non
                 }else{

                    echo "<p class='alert alert-danger' role='alert'> Extension non valide </p>";

                  }
            
            //si oui
            }else{
                    echo "<p class='alert alert-danger' role='alert'> Erreur lors de l'envoi de l'image</p>";
            }
            
          }
     ?>




     <!-- Formulaire d'ajout de produits-->
   <div class="myform">
    <h1> Ajout de Produits </h1>
    <form method="post" action="ajoutProduit.php" class="col-md-6" enctype="multipart/form-data">
       <div class="mb-3">
                <label for="name" class="form-label">Nom</label>
                <input type="text" name="name" placeholder="entrez le nom du produit" class="form-control" id="name" required/>
       </div>
       <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description"  class="form-control" id="description" required> Description du produit </textarea>
        </div>
        <div class="mb-3">
                <label for="quantity" class="form-label">Quantite</label>
                <input type="number" name="quantity" placeholder="indiquez la quantite disponible" class="form-control" id="quantity" required/>
        </div>
        <div class="mb-3">
                <label for="unit" class="form-label">Unite de mesure</label>
                <input type="text" name="unit" placeholder="indiquez l'unite" class="form-control" id="unit" required/>
        </div>
        <div class="mb-3">
                <label for="price" class="form-label">Prix</label>
                <input type="number" name="price" placeholder="entrez le prix" class="form-control" id="price" required/>
        </div>
        <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" name="image" class="form-control" id="image" required/>
        </div>
        <div class="mb-3">
                <label for="created_at" class="form-label">Date de Creation</label>
                <input type="text" name="created_at"  class="form-control" id="created_at" required readonly="readonly" value="<?php echo date('Y/m/d H:i:s'); ?>" />
        </div>
        <!--<div class="mb-3">
                <label for="updated_at" class="form-label">Date de modification</label>
                <input type="text" name="updated_at"  class="form-control" id="updated_at" required readonly="readonly" value="<?php// echo date('Y/m/d'); ?>"/>
        </div>-->
        <div>
            <button type="submit" class="btn btn-success"> Ajouter </button>
        </div>
    <form>
</div>

    
</body>
</html>
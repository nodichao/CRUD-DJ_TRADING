<?php
       session_start();
       if(!isset($_SESSION['email'])){
           header('Location:../index.php');
       }

       include_once('../db_connection.php');

       //recuperation de l'identifiant du produit a modifier

       if(isset($_GET['id'])){

          $getData = $_GET['id'];
          
          
                    

          $selectReq = 'SELECT * FROM products WHERE idProduct=:idProduct';

          $selectStatement = $db->prepare($selectReq);
          $selectStatement->execute([
              'idProduct' => $getData
          ]);

          $ProductsToModify = $selectStatement->fetchAll();

          foreach($ProductsToModify as $product){
            $currentProduct = $product;
          }

       //var_dump($currentProduct);


       }
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
    <title>Modifier un article</title>
</head>
<body class="container">
    <?php
        include_once("header.php");
      ?>

        <!-- Formulaire de modification de produits-->
        <div class="myform">
    <h1> Modification du Produit </h1>
    <form method="post" action="post_modifierProduit.php" class="col-md-6" enctype="multipart/form-data">
    <div class="mb-3 visually-hidden">
                <label for="idProduct" class="form-label">ID Produit</label>
                <input type="text" name="idProduct" value="<?php echo $currentProduct['idProduct']; ?>" class="form-control" id="idProduct" required/>
       </div>
       <div class="mb-3">
                <label for="name" class="form-label">Nom</label>
                <input type="text" name="name" value="<?php echo $currentProduct['name']; ?>" class="form-control" id="name" required/>
       </div>
       <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description"  class="form-control" id="description" required> <?php echo $currentProduct['description']; ?> </textarea>
        </div>
        <div class="mb-3">
                <label for="quantity" class="form-label">Quantite</label>
                <input type="number" name="quantity" value="<?php echo $currentProduct['quantity']; ?>" class="form-control" id="quantity" required/>
        </div>
        <div class="mb-3">
                <label for="unit" class="form-label">Unite de mesure</label>
                <input type="text" name="unit" value="<?php echo $currentProduct['unit']; ?>" class="form-control" id="unit" required/>
        </div>
        <div class="mb-3">
                <label for="price" class="form-label">Prix</label>
                <input type="number" name="price" value="<?php echo $currentProduct['price']; ?>" class="form-control" id="price" required/>
        </div>
        <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" name="image" class="form-control" id="image" />
                <img src="../images/<?php echo $currentProduct['image']; ?>" height="100" width="100"/>
        </div>
        <div class="mb-3">
                <label for="created_at" class="form-label">Date de Creation</label>
                <input type="text" name="created_at"  class="form-control" id="created_at" required readonly="readonly" value="<?php echo $currentProduct['created_at']; ?>"  />
        </div>
        <div class="mb-3">
                <label for="updated_at" class="form-label">Date de modification</label>
                <input type="text" name="updated_at"  class="form-control" id="updated_at" required readonly="readonly" value="<?php echo date('Y/m/d H:i:s'); ?>"/>
        </div>
        <div>
            <button type="submit" class="btn btn-success"> modifier </button>
        </div>
    <form>
</div>


    
</body>
</html>
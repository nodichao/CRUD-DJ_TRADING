<?php 
    
    session_start();

    //verification de la session
    if(!isset($_SESSION['email'])){
        header('Location:../index.php');
    }

    //outil de connection de la base de donnees 
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
    <title>Details du Produit</title>
</head>
<body class="container">
    <!-- Ajout de l'entete du document-->  
    <?php include_once('header.php');  ?> 

    <?php
        $selectReq ='SELECT *  FROM products where idProduct=:idProduct';

        $selectStatement = $db->prepare($selectReq);

        $selectStatement->execute(
            [
                'idProduct'=>$_GET['id']
            ]

        );

        $products = $selectStatement->fetchAll();

        foreach($products as $product){
            $productToPrint = $product;
        }
        
     ?>
    
    <!-- Details sur le produit Selectionne -->

    <div class="card product" style="width: 18rem;height: 25rem;margin: 10% auto;">
       <img src="../images/<?php echo($productToPrint['image']);?>" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title"><?php echo($productToPrint['name']); ?></h5>
        <p class="card-text"><?php echo($productToPrint['description']) ?></p>
     </div>
     <ul class="list-group list-group-flush">
       <li class="list-group-item"><b>Unite : </b><?php echo($productToPrint['unit']); ?></li>
       <li class="list-group-item"><b>Quantite : </b><?php echo($productToPrint['quantity']); ?></li>
       <li class="list-group-item"><b>Prix Unitaire : </b><?php echo($productToPrint['price']); ?></li>
       <li class="list-group-item"><b>Valeur : </b><?php echo($productToPrint['price']*$productToPrint['quantity']); ?></li>
     </ul>
    <div class="card-body">
       <a href="modifierProduit.php?id=<?php echo($_GET['id']);?>" class="card-link btn btn-primary">Modifier</a>
       <a href="listeProduit.php" class="card-link">liste des produits</a>
    </div>
  </div>
</body>
</html>
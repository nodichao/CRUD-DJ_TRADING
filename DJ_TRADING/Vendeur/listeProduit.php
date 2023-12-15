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
    <title>Liste des produits</title>
</head>
<body class="container">
     <!-- Ajout de l'entete du document-->  
     <?php include_once('header.php');  ?> 

     <?php  
                 $req = 'SELECT * FROM products';
                 $listStatement = $db->prepare($req);
                 $listStatement->execute();
                 $products = $listStatement->fetchAll();
        ?>  

             <!-- Affichage des Acticles sous forme de tableau-->
            <table class="table">
                <thead>
                    <tr>
                      <th scope="col">Id Product</th>
                      <th scope="col">Nom</th>
                      <th scope="col">Description</th>
                      <th scope="col">Quantite</th>
                      <th scope="col">Unite</th>
                      <th scope="col">Prix</th>
                      <th scope="col">image</th>
                      <th scope="col">Cree le</th>
                      <th scope="col">Modifie le</th>
                      <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($products as $product): ?>
                      <?php if($_SESSION['idUser'] == $product['idUser']): ?>
                          <tr>
                            <th scope="row"><?php echo $product['idProduct'] ?></th>
                            <td><?php echo $product['name'] ?></td>
                            <td><?php echo $product['description'] ?></td>
                            <td><?php echo $product['quantity'] ?></td>
                            <td><?php echo $product['unit'] ?></td>
                            <td><?php echo $product['price'] ?></td>
                            <td><img src="../images/<?php echo $product['image']; ?>" width="70" height="70"/></td>
                            <td><?php echo $product['created_at'] ?></td>
                            <td><?php echo $product['updated_at'] ?></td>
                            <td><?php echo '<a href=\'detailsProduit.php?id='.$product['idProduct'].'\' class="btn btn-primary">details</a>
                               <a href=\'supprimerProduit.php?id='.$product['idProduct'].'\' class="btn btn-danger">supprimer</a>'; ?></td>
                          </tr>
                      <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>

            
    
</body>
</html>
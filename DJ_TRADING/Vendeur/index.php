<?php
    session_start();
    if(!isset($_SESSION['email'])){
        header('Location:../index.php');
    }

  //inclusion du code de connexion a la base de donnees
    include('../db_connection.php');

    //Requete pour recuperer tous les produits
    $totalReq ='SELECT COUNT(idProduct) as :nombre FROM products where idUser =:idUser';
    $totalStatement = $db->prepare($totalReq);
     $totalStatement->execute([
        'nombre'=>'nombre',
        'idUser' => $_SESSION['idUser']
     ]);

     $totaux = $totalStatement->fetchAll();
     foreach($totaux as $totau){
        $total = $totau;
     }
    

    //Requete pour recuperer la somme des valeurs de produits

    $valeursReq ='SELECT SUM(quantity*price) as :valeurs FROM products WHERE idUser=:idUser';

    $valeursStatement = $db->prepare($valeursReq);

    $valeursStatement->execute(
         [
            'valeurs'=>'valeurs',
            'idUser'=>$_SESSION['idUser']
         ]
    );

    $valeurs = $valeursStatement->fetchAll();

    foreach($valeurs as $valeur){
        $valeurAffichee = $valeur;
    }

   //Requete pour recuperer le nombre de  produits en Rupture de stock

   $rupReq = 'SELECT COUNT(idProduct) as :nombreRup FROM products WHERE quantity=0';
   $rupStatement = $db->prepare($rupReq);
   $rupStatement->execute([
       'nombreRup'=>'nombreRup'
   ]);

   $productsOvs = $rupStatement->fetchAll();
   
   foreach($productsOvs as $productsOv){
      $listOv = $productsOv;
   }


    //Requete pour recuperer la liste des  produits en alerte de rupture

   $alertReq = 'SELECT * FROM products WHERE quantity<= alert AND quantity>0';
   $alertStatement = $db->prepare($alertReq);
   $alertStatement->execute();

   $productsAls = $alertStatement->fetchAll();

   //Requete pour recuperer la liste des  produits en rupture de stock

   $rupReq = 'SELECT * FROM products WHERE quantity<=0';
   $rupStatement = $db->prepare($rupReq);
   $rupStatement->execute();

   $ruProducts = $rupStatement->fetchAll();
   
   /*foreach($productsAls as $productsAl){
      $listAl = $productsAl;
   }*/
 /* var_dump($productsAls);
   die();*/
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
    <link rel="stylesheet" href="style.css"/>
    <title>Accueil</title>
</head>
<body class="container">
    <?php include('header.php'); ?>

    <!-- Nombre total de produits-->
    <div class="container myCards" style="margin-top: 50px;">
      <div class="row Cards">
      
      <div class="card  col-3" style="margin:0 auto;">
         
         <div class="card-body">
        <h5 class="card-title">Total</h5>
        <br>
       <p class="card-text"><?php echo($total['nombre'].' produits'); ?></p>
       </div>
     </div>


     <!-- Valeur totale des produits -->
     <div class="card col-3" style="margin:0 auto;">
         <div class="card-body">
        <h5 class="card-title">Valeur</h5>
        <br/>
       <p class="card-text"><?php echo($valeurAffichee['valeurs'].' FCFA'); ?></p>
       </div>
     </div>
    
    <!---->
     <div class="card col-3" style="margin:0 auto;">  
         <div class="card-body">
        <h5 class="card-title">En rupture de stock</h5>
        <br/>
        <!--<ul class="list-group list-group-flush">-->
            <!--<?php //foreach($productsOvs as $productsOv): ?>-->
                   <p><?php echo($listOv['nombreRup'].' produits'); ?></p>
            <?php// endforeach; ?>
         <!--</ul>-->
       </div>
     </div>
    </div>

    <div class="row Cards">

          <div class="card col-3" >
                <div class="card-body">
                   <h5 class="card-title">Alerte de Rupture</h5>
                   <p class="card-text">Produits presque en rupture de stock</p>
                 </div>
            <ul class="list-group list-group-flush">
              <?php foreach($productsAls as $productsAl): ?>
                  <li class="list-group-item"><?php echo($productsAl['name']); ?></li>
              <?php endforeach; ?>
            </ul>
      </div>

      <div class="card col-3" >
                <div class="card-body">
                   <h5 class="card-title">En rupture</h5>
                   <p class="card-text">Produits en rupture de stock</p>
                 </div>
            <ul class="list-group list-group-flush">
              <?php foreach($ruProducts as $ruProduct): ?>
                  <li class="list-group-item"><?php echo($ruProduct['name']); ?></li>
              <?php endforeach; ?>
            </ul>
      </div>

   </div>
       
        
  <div>
   
    
    
</body>
</html>
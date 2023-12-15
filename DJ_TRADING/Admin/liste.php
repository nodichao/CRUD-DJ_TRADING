<?php 
   session_start();
   include_once('../db_connection.php');
   if(!isset($_SESSION['email'])){
    header('Location:profile.php');
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
    <link rel="stylesheet" href="style.css"/>
    <title>Liste</title>
</head>
<body class="container">
    

         <a href='profile.php'>accueil</a>
         <a href="../logout.php" class="btn_deconnexion">deconnexion</a>

         <?php if($_SESSION['role'] == 1):?>
            <ul class="nav justify-content-center">
                <li class="nav-item">
                    <a class="nav-link" href="ajout.php">Ajouter un vendeur</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="liste.php">Liste des vendeurs</a>
                </li>
            </ul>
             
            <h1>liste des vendeurs</h1>

            <?php  
                 $req = 'SELECT * FROM users where role=:role';
                 $listStatement = $db->prepare($req);
                 $listStatement->execute([
                    'role' => 2
                 ]);
                 $sellers = $listStatement->fetchAll();
            ?>

           

            <table class="table">
                <thead>
                    <tr>
                      <th scope="col">Id Vendeur</th>
                      <th scope="col">Nom</th>
                      <th scope="col">Pseudo</th>
                      <th scope="col">email</th>
                      <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($sellers as $seller): ?>
                          <tr>
                            <th scope="row"><?php echo $seller['idUser'] ?></th>
                            <td><?php echo $seller['name'] ?></td>
                            <td><?php echo $seller['username'] ?></td>
                            <td><?php echo $seller['email'] ?></td>
                            <!--<td><?php //echo $seller['password'] ?></td>-->
                            <td><?php echo '<a href=\'modifier.php?id='.$seller['idUser'].'\' class="btn btn-primary">modifier</a> 
                              <a href=\'supprimer.php?id='.$seller['idUser'].'\' class="btn btn-danger">supprimer</a>'; ?></td>
                          </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

         <?php endif; ?>

 <?php
       
   
       include_once('../db_connection.php');
       if(isset($_POST['nom']) && isset($_POST['pseudo']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['role']) ){
       
               
       
           $req = "INSERT INTO users(username,email,name,role,password) VALUES(:username,:email,:name,:role,:password)";
       
           $insertStatement = $db->prepare($req);
           $insertStatement->execute([
               'username'=>$_POST['pseudo'],
               'email'=>$_POST['email'],
               'name'=>$_POST['nom'],
               'role'=>$_POST['role'],
               'password'=>$_POST['password']
           ]);
       
                  
       
       }
             
?>
    
    
    
    
</body>
</html>
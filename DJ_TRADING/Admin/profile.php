<?php
    session_start();
    //var_dump($_SESSION['email']);
    //die();
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
    <title>Profile</title>
</head>
<body class="container">

    
    <?php if(isset($_SESSION['email'])): ?>
        <?php if($_SESSION['role'] == 1):?>
        <a href='profile.php'>accueil</a>
         <a href="../logout.php" class="btn_deconnexion">deconnexion</a>

         
            <ul class="nav justify-content-center">
                <li class="nav-item">
                    <a class="nav-link" href="ajout.php">Ajouter un vendeur</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="liste.php">Liste des vendeurs</a>
                </li>
            </ul>
        
            <ul class="list-group">
                 <li class="list-group-item">Nom : <?php echo $_SESSION['name'];?></li>
                <li class="list-group-item">Email : <?php echo $_SESSION['email'];?></li>
                <li class="list-group-item">Role : <?php if($_SESSION['role'] == 1){echo "Admin";}else{echo "Vendeur";}  ?></li>
                <!--<li class="list-group-item">Mot de passe : <?php// echo $_SESSION['password'];?></li>-->
            </ul>
         <?php else:header('Location:../Vendeur/index.php'); ?>
         <?php endif;?>


         
        
    <?php else: header('Location:index.php');?>
    <?php endif; ?>
    



    
    
    
</body>
</html>
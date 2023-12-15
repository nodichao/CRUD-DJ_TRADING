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
    <title>modification</title>
</head>
<body class="container">
<?php include_once('../index.php'); ?>

<?php if(isset($_SESSION['email'])): ?>
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
            <?php if(isset($_GET['id'])){
                       
                    $getData = $_GET['id'];

                /*$req = 'SELECT * FROM users WHERE idUser=:id';
                $selectStatement = $db->prepare($req);
                $selectStatement->execute(
                    [
                        'id'=>$getData
                    ]
                );

                $userToModify = $selectStatement->fetchAll();
                foreach($userToModify as $user){
                    $current = $user;
                }*/
               
                $req = 'DELETE FROM users WHERE idUser=:id';

                $selectStatement = $db->prepare($req);
                $selectStatement->execute(
                    [
                        'id'=>$getData
                    ]
                );
                
             }

             header('Location:liste.php');
             


            ?>
             
             
           

        <?php endif; ?>
<?php endif; ?>


    
</body>
</html>
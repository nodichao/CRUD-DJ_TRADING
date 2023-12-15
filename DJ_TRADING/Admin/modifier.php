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
    <link rel="stylesheet" href="../style.css"/>
    <title>modification</title>
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
            <?php if(isset($_GET['id'])){
                       
                    $getData = $_GET['id'];

                $req = 'SELECT * FROM users WHERE idUser=:id';
                $selectStatement = $db->prepare($req);
                $selectStatement->execute(
                    [
                        'id'=>$getData
                    ]
                );

                $userToModify = $selectStatement->fetchAll();
                foreach($userToModify as $user){
                    $current = $user;
                }

                
             }
            ?>
             <div class="myform">
             <h1>Modifier les informations</h1>
             <form method="POST" action="post_modifier.php" class="col-md-6">
            <fieldset>
                <legend>Infos User</legend>
                  <div class="mb-3 visually-hidden">
                     <label for="idUser" class="form-label">Identifiant</label>
                     <input type="text" name="idUser" class="form-control" id="idUser" value="<?php echo $current['idUser'] ?>" required/>
                 </div>
                 <div class="mb-3">
                     <label for="name" class="form-label">Nom</label>
                     <input type="text" name="nom" placeholder="entrez le nom" class="form-control" id="name" value="<?php echo $current['name']; ?> " required />
                 </div>
                 <div class="mb-3">
                     <label for="pseudo" class="form-label">pseudo</label>
                     <input type="text" name="pseudo" placeholder="entrez le nom d'utilisateur" class="form-control" id="pseudo" value="<?php echo $current['username'];?>" required />
                 </div>
                 <div class="mb-3">
                     <label for="email" class="form-label">Email</label>
                     <input type="email" name="email" placeholder="exemple@gmail.com" class="form-control" id="email" value="<?php echo $current['email'];?>" required/>
                 </div>
                 <div>
                     <button class="btn btn-success" type="submit">modifier</button>
                 </div>
            </fieldset>
            </form>
            </div>
            <hr/>
            <div class="myform">
            <form method="post" action="post_modifier.php" class="col-md-6">
                <fielset>
                    <legend> Mot de Passe </legend>
                    <div class="mb-3 visually-hidden">
                     <label for="idUser" class="form-label">Identifiant</label>
                     <input type="text" name="idUser" class="form-control" id="idUser" value="<?php echo $current['idUser'] ?>" required/>
                 </div>
                 <div class="mb-3">
                     <label for="password" class="form-label">Ancien mot de passe</label>
                     <input type="password" name="password" placeholder="entrez le mot de passe" class="form-control" id="password" required />
                 </div>
                 <div class="mb-3">
                     <label for="password" class="form-label">Nouveau mot de passe</label>
                     <input type="password" name="newPassword" placeholder="entrez le nouveau mot de passe" class="form-control" id="password" required/>
                 </div>
                 <div class="mb-3">
                     <label for="password" class="form-label">Confirmation du mot de passe</label>
                     <input type="password" name="conNewPassword" placeholder="Confirmez le mot de passe" class="form-control" id="password" required/>
                 </div>

                 
                 <div>
                     <button class="btn btn-success" type="submit">modifier</button>
                 </div>
            </fieldset>
             </form>
            </div>
           </div>
           

        <?php endif; ?>


    
</body>
</html>
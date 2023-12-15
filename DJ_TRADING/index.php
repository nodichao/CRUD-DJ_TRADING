

<?php 
    session_start();
      include_once('db_connection.php');
    
      //Verification si l'email et le password ne sont pas vides
      if(isset($_POST['email']) && isset($_POST['password'])){

             //fonction de hashage qui permet de crypter le mot de passe
              $password = md5($_POST['password']);    

              $req = 'SELECT * FROM users where email=:email and password=:password';
              $conStatement = $db->prepare($req);
              $conStatement->execute([
                'email' => $_POST['email'],
                'password' => $password
              ]);

          $loggedUsers = $conStatement->fetchAll();

              if(!empty($loggedUsers)){
                 foreach($loggedUsers as $loggedUser){
                    $_SESSION['email'] = $loggedUser['email'];
                    $_SESSION['password'] = $loggedUser['password'];
                    $_SESSION['username']  = $loggedUser['username'];
                    $_SESSION['name']  = $loggedUser['name'];
                    $_SESSION['role']  = $loggedUser['role'];
                    $_SESSION['idUser'] = $loggedUser['idUser'];

                    
            }

                header('Location:Admin/profile.php');
            }else{
                   $message = "<div class='alert alert-danger' role='alert'>informations incorrectes</div>";
         }
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
          <title>Document</title>
      </head>
<body class="container form">
    <?php if(!isset($_SESSION['email'])): ?>
        <?php if(isset($message)): ?>
          <?php echo $message; ?>
        <?php endif;?>
        <div class="myform" >
            <h1>Connectez vous !</h1>
            <form method="post" action="index.php" class="col-md-6">
                <div class="mb-3 row">
                     <input type="email" name="email" placeholder="Entrez votre email" class="form-control"/>
                </div>
                <div class="mb-3 row">
                    <input type="password" name="password" placeholder="Entrez votre mot de passe" class="form-control"/>
                </div>
                <button type="submit" class="btn btn-success">Se connecter</button>
            </form>
        </div>
    <?php else: ?>
        <?php header('Location:Admin/profile.php') ;?>
    <?php endif;?>
    
</body>
</html>

<?php
       
   
       include_once('db_connection.php');
       if(isset($_POST['nom']) && isset($_POST['pseudo']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['role']) ){
              
               $reqVerification = "SELECT * FROM users WHERE email=:email OR username=:username";

               $verifStatement = $db->prepare($reqVerification);

               $verifStatement->execute([

                  'email' => $_POST['email'],
                  'username'=> $_POST['pseudo']

               ]);
               
               $result = $verifStatement->fetchAll();

               //var_dump($result);

               if(!empty($result)){

                 // var_dump($verifStatement);
                echo "<div class='alert alert-danger' role='alert'>cet email ou ce pseudo existe deja.</div>";
               }
               else{
                        
                      $password = md5($_POST['password']);

                    $req = "INSERT INTO users(username,email,name,role,password) VALUES(:username,:email,:name,:role,:password)";
       
                      $insertStatement = $db->prepare($req);
                     $insertStatement->execute([
                      'username'=>$_POST['pseudo'],
                      'email'=>$_POST['email'],
                      'name'=>$_POST['nom'],
                      'role'=>$_POST['role'],
                      'password'=>$password
                   ]);
            
                    if($insertStatement){
                         header('Location:index.php');
                   }
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
    <title>Register</title>
</head>
<body class="container form">
    <div class="myform">
        <h1>Creation des utilisateurs</h1>
        <form method="POST" action="register.php" class="col-md-6">
            <div class="mb-3">
                <label for="name" class="form-label">Nom</label>
                <input type="text" name="nom" placeholder="entrez le nom" class="form-control" id="name" required/>
            </div>
            <div class="mb-3">
                <label for="pseudo" class="form-label">pseudo</label>
                <input type="text" name="pseudo" placeholder="entrez le nom d'utilisateur" class="form-control" id="pseudo" required/>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" placeholder="exemple@gmail.com" class="form-control" id="email" required/>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">password</label>
                <input type="password" name="password" placeholder="entrez le mot de passe" class="form-control" id="password" required/>
            </div>
            <div class="input-group mb-3">
                <label class="input-group-text">Role</label>
                <select class="form-select" name="role" required>
                    <!--<option selected>Choisir</option>-->
                    <option  value="1" selected>Administrateur</option>
                    <!--<option  value="2">Vendeur</option>-->
                </select>
            </div>
            <div>
                <button class="btn btn-success" type="submit">Enregistrer</button>
            </div>
        </form>
    </div>
    
</body>
</html>
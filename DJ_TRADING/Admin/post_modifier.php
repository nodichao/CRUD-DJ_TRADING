<?php
       include_once('../db_connection.php');

       
                     if(isset($_POST['idUser']) && isset($_POST['nom']) && isset($_POST['pseudo']) && isset($_POST['email'])){

    $updateReq1 = 'UPDATE users SET username=?,email=?,name=? WHERE idUser=?';

                        $updateStatement = $db->prepare($updateReq1);
                        $updateStatement->execute(
                            [
                                $_POST['pseudo'],
                                $_POST['email'],
                                 $_POST['nom'],
                                $_POST['idUser']
                            ]
                            );

                        
                        }
                      if(isset($_POST['idUser']) && isset( $_POST['password']) && isset($_POST['newPassword']) && isset($_POST['conNewPassword'])){
                          $selectReq = 'SELECT * FROM users WHERE password=:password AND idUser=:idUser';
                          $selectStatement = $db->prepare($selectReq);
                          $selectStatement->execute(
                            [
                                'password'=>md5($_POST['password']),
                                'idUser'=>$_POST['idUser']
                            ]
                          );

                          $users = $selectStatement->fetchAll();

                        if(!empty($users)){
                            foreach($users as $user){
                                 $current = $user;
                            }
                            if($_POST['newPassword'] != $_POST['conNewPassword']){
                                echo '<p class="alert alert-danger" role="alert">les nouveaux mot de passe ne correspondent pas  </p>';
                            }else{
                                     $updateReq2 ='UPDATE users SET password=:password WHERE idUser=:idUser';
                                     $updateStatement2 = $db->prepare($updateReq2);
                                     $updateStatement2->execute(
                                           [
                                            'password'=>md5($_POST['newPassword']),
                                            'idUser'=>$_POST['idUser']
                                           ]
                                     ) ;

                                     echo '<p> Modification effectu&eacute;e avec succ&egrave;s</p>';
                                     header('Location:liste.php');

                            }



                        }else{
                            echo '<p class="alert alert-danger" role="alert"> ancien mot de passe invalide </p>';
                        }
                           

                      }
                        ///$updateStatement->fetchAll();
                        //var_dump($updateStatement);
                        

                      
    

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
    <title>modification</title>
</head>
<body>
    
</body>
</html>
<?php
      session_start();
      if(!isset($_SESSION['email'])){
          header('Location:../index.php');
      }

      include_once('../db_connection.php');



      
     if(isset($_POST['name']) && isset($_POST['description']) && isset($_POST['quantity']) && isset($_POST['unit'])
      && isset($_POST['price']) && isset($_POST['created_at']) && isset($_POST['updated_at'])){
 
        

         if(empty($_FILES['image']['name'])){

                
                $updateReq = 'UPDATE products SET name=:name,description=:description,
                quantity=:quantity,unit=:unit,price=:price,updated_at=:updated_at WHERE idProduct=:idProduct';

                $updateStatement = $db->prepare($updateReq);
                $updateStatement->execute([
                        'name'=>$_POST['name'],
                        'description'=>$_POST['description'],
                        'quantity'=>$_POST['quantity'],
                        'unit'=>$_POST['unit'],
                        'price'=>$_POST['price'],
                        'updated_at'=>$_POST['updated_at'],
                        'idProduct'=>$_POST['idProduct']
                ]);

                header("Location:listeProduit.php");

        }else{

                $time=time();
                $newName = $time.basename($_FILES['image']['name']);

                move_uploaded_file($_FILES['image']['tmp_name'],'../images/'.$newName);

                $updateReq = 'UPDATE products SET name=:name,description=:description,
                quantity=:quantity,unit=:unit,price=:price,image=:image,name=:name,updated_at=:updated_at WHERE idProduct=:idProduct';

                $updateStatement = $db->prepare($updateReq);
                $updateStatement->execute([
                        'name'=>$_POST['name'],
                        'description'=>$_POST['description'],
                        'quantity'=>$_POST['quantity'],
                        'unit'=>$_POST['unit'],
                        'price'=>$_POST['price'],
                        'image'=>$newName,
                        'updated_at'=>$_POST['updated_at'],
                        'idProduct'=>$_POST['idProduct']
                ]);
                 
                header("Location:listeProduit.php");
               
        }
        
     }



?>
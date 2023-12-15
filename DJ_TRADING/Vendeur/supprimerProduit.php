<?php
    session_start();

    //verification de la session

     if(!isset($_SESSION['email'])){
        header('Location:../index.php');
     }


    //outil de connection de la base de donnees 
     include_once('../db_connection.php');

     if(isset($_GET['id'])){
        $getData = $_GET['id'];

        $deleteReq = 'DELETE FROM products WHERE idProduct=:idProduct';

        $deleteStatement = $db->prepare($deleteReq);

        $deleteStatement->execute([
            'idProduct'=>$getData
        ]);

        header('Location:listeProduit.php');
     }
?>
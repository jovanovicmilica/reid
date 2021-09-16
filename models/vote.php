<?php
session_start();
    require_once "konekcija.php";

    $data="";
    $code=200;
    $id=$_POST['id'];

    $user=$_SESSION['user'];
    $idUser=$user['idUser'];

    $upit="INSERT INTO useranswer VALUES (null,$idUser,$id)";

    try{
        $konekcija->query($upit);
        $code=200;
        $data="Thanks for voting!";
    }
    catch(PDOException $e){
        $code=500;
        $message="Server error";
    }

    
    echo json_encode($data);
    http_response_code($code);
?>
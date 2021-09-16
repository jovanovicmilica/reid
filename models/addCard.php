<?php
session_start();
    require_once "konekcija.php";

    $data="";
    $code=200;

    $idPrice=$_POST['idPrice'];
    $quantitiy=$_POST['quantity'];
    $size=$_POST['size'];

    if(isset($_SESSION['user'])){
        $user=$_SESSION['user'];
        $idUser=$user['idUser'];
        $upit="INSERT INTO basket VALUES (null,:user,:price,:quantity,:ordered,null,:size)";
        $ordered=0;
        $priprema=$konekcija->prepare($upit);
        $priprema->bindParam(":user",$idUser);
        $priprema->bindParam(":price",$idPrice);
        $priprema->bindParam(":quantity",$quantitiy);
        $priprema->bindParam(":ordered",$ordered);
        $priprema->bindParam(":size",$size);
        try{
            $priprema->execute();
            $data="Successfulu addes to card";
        }
        catch(PDOException $e){
            $data=$e->getMessage();
            $code=500;
        } 
    }
    else{
        $data="Login to add to card";
    }

    
    echo json_encode($data);
    http_response_code($code);
?>
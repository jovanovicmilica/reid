<?php
    
    require_once "konekcija.php";

    $data="";
    $code="";
    $id=$_POST['id'];

    $upit="DELETE FROM basket WHERE idOrder=:id";
    $priprema=$konekcija->prepare($upit);
    $priprema->bindParam(":id",$id);
    try{
        $priprema->execute();
        $data="Deleted";
        $code=200;
    }
    catch(PDOException $e){
        $code=500;
        $data="Server error";
    }

    echo json_encode($data);
    http_response_code($code);
?>
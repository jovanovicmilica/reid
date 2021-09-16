<?php
    session_start();
    
    require_once "konekcija.php";

    $code=200;
    $data="";

    $address=$_POST['address'];

    $user=$_SESSION['user'];
    $idUser=$user['idUser'];

    $upit="UPDATE basket set ordered=1,adress=:adr WHERE idUser=:id";
    $priprema=$konekcija->prepare($upit);
    $priprema->bindParam(":id",$idUser);
    $priprema->bindParam(":adr",$address);
    try{
        $priprema->execute();
        $data="You have successfuly ordered";
        $code=200;
    }
    catch(PDOException $e){
        $code=500;
        $data="Server error";
    }

    echo json_encode($data);
    http_response_code($code);
?>
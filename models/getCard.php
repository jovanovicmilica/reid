<?php
    require_once "konekcija.php";

    $user=$_SESSION['user'];
    $idUser=$user['idUser'];

    $upit="SELECT * FROM basket b INNER JOIN price p ON b.idPrice=p.idPrice INNER JOIN product pr ON p.idProduct=pr.idProduct INNER JOIN size s on b.idSize=s.idSize WHERE idUser=:id AND ordered=0";
    $priprema=$konekcija->prepare($upit);
    $priprema->bindParam(":id",$idUser);

    $upit2="SELECT SUM(quantity*price) AS total FROM basket b INNER JOIN price p on b.idPrice=p.idPrice WHERE idUser=:id AND ordered=0";
    $priprema2=$konekcija->prepare($upit2);
    $priprema2->bindParam(":id",$idUser);

    try{
        $priprema->execute();
        $priprema2->execute();
        if($priprema->rowCount()!=0){
            $basket=$priprema->fetchAll();
            $total=$priprema2->fetch();
        }
        else{
            $message="Basket is empty";
        }
    }
    catch(PDOException $e){
        $code=500;
        $message="Server error";
    }
?>
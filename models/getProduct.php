<?php
    require_once "konekcija.php";

    if(isset($_GET['id'])){
        $id=$_GET['id'];
        $upit="SELECT * FROM product p INNER JOIN price pr ON p.idProduct=pr.idProduct WHERE p.idProduct=:id AND pr.idPrice = (SELECT idPrice FROM price WHERE idProduct=pr.idProduct ORDER BY dateFrom DESC LIMIT 1)";
        $priprema=$konekcija->prepare($upit);
        $priprema->bindParam(":id",$id);
        try{
            $priprema->execute();
            if($priprema->rowCount()==1){
                $product=$priprema->fetch();
            }
            else{
                $message="No access";
            }
            
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }
    else{
        $message="No access";
    }
?>
<?php
    require_once "konekcija.php";

    if(isset($_GET['id'])){
        $id=$_GET['id'];
        $upit="SELECT * FROM product p INNER JOIN price pr ON p.idProduct=pr.idProduct WHERE pr.idPrice = (SELECT idPrice FROM price WHERE idProduct=pr.idProduct ORDER BY dateFrom DESC LIMIT 1) ORDER BY p.idProduct DESC LIMIT 7";
        
        try{
            $new=$konekcija->query($upit)->fetchAll();
            
        }
        catch(PDOException $e){
            $new="Server error";
        }
    }
    else{
        $new="No access";
    }
?>
<?php
    require_once "konekcija.php";

    $data="";
    $code=200;
        $id=$_GET['id'];
        $upit="SELECT * FROM product p INNER JOIN price pr ON p.idProduct=pr.idProduct WHERE p.idProduct=:id AND pr.idPrice = (SELECT idPrice FROM price WHERE idProduct=pr.idProduct ORDER BY dateFrom DESC LIMIT 1)";
        $priprema=$konekcija->prepare($upit);
        $priprema->bindParam(":id",$id);
        try{
            $priprema->execute();
            if($priprema->rowCount()==1){
                $data=$priprema->fetch();
            }
            else{
                $data="No access";
                $code=404;
            }
            
        }
        catch(PDOException $e){
            $data="Server error";
            $code=500;
        }


    
        echo json_encode($data);
        http_response_code($code);
?>
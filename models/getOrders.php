<?php
    require_once "konekcija.php";

    $data="";
    $code=200;

    $upit="SELECT *,pr.name as pName FROM basket b INNER JOIN price p ON b.idPrice=p.idPrice INNER JOIN product pr ON p.idProduct=pr.idProduct INNER JOIN user u on b.idUser=u.idUser INNER JOIN size s on b.idSize=s.idSize WHERE ordered=1";

    try{
        $rez=$konekcija->query($upit);
        if($rez->rowCount()!=0){
            $data=$rez->fetchAll();
        }
        else{
            $data="Basket is empty";
        }
    }
    catch(PDOException $e){
        $code=500;
        $data="Server error";
    }

    
echo json_encode($data);
http_response_code($code);
?>
<?php
    require_once "konekcija.php";

    $data="";
    $code=200;
    

    $upit="SELECT * FROM product p INNER JOIN price pr ON p.idProduct=pr.idProduct WHERE pr.idPrice = (SELECT idPrice FROM price WHERE idProduct=pr.idProduct ORDER BY dateFrom DESC LIMIT 1)";

    try{
        $data=$konekcija->query($upit)->fetchAll();

    }
    catch(PDOException $e){
        $data="Server error";
        $code=500;
    }

    
    echo json_encode($data);
    http_response_code($code);
?>

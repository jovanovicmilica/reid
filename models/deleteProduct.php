<?php

    require_once "konekcija.php";


    
        $data="";
        $code=200;
        $id=$_POST['id'];
        $upit="DELETE FROM product WHERE idProduct=:id";
        $priprema=$konekcija->prepare($upit);
        $priprema->bindParam(":id",$id);
            try{
                $priprema->execute();
                $code=201;
            }
            catch(PDOException $e){
                $data="Server error";
                $code=500;
            }



    
echo json_encode($data);
http_response_code($code);
?>
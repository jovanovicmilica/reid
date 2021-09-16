<?php

    require_once "konekcija.php";


        $id=$_POST['id'];
        $data="";


        $upit="SELECT * FROM category WHERE idCategory=:id";
        $priprema=$konekcija->prepare($upit);
        $priprema->bindParam(":id",$id);
        
        try{  
            $priprema->execute();
            $data=$priprema->fetch();
            $code=200;
        }
        catch(PDOException $e){
            $code=500;
            $data="Server error";
        }

    
echo json_encode($data);
http_response_code($code);
?>

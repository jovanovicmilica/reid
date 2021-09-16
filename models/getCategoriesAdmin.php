<?php
    require_once "konekcija.php";

    $data="";
    $code=200;

    

    $upit="SELECT * FROM category";


    try{  
        $data=$konekcija->query($upit)->fetchAll();
        $code=200;
    }
    catch(PDOException $e){
        $code=500;
        $data="Server error";
    }
  

    
echo json_encode($data);
http_response_code($code);  


?>
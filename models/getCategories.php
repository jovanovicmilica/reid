<?php
    require_once "konekcija.php";

    $data="";

    

    $upit="SELECT * FROM category";


    try{  
        $category=$konekcija->query($upit)->fetchAll();
        $code=200;
    }
    catch(PDOException $e){
        $code=500;
        $category="Server error";
    }
    


?>
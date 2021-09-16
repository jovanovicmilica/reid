<?php
    require_once "konekcija.php";

    $data="";

    

    $upit="SELECT * FROM menu WHERE preview=0";


    if(isset($_SESSION['user'])){
        $korisnik=$_SESSION['user'];
        if($korisnik['idRole']==1){
            $upit.="  OR preview=1";
        }
        $upit.=" OR preview=2";
    }
    else{
        $upit.=" OR preview=3";
    }
    $upit.=" ORDER BY priority";

    try{  
        $menu=$konekcija->query($upit)->fetchAll();
        $code=200;
    }
    catch(PDOException $e){
        $code=500;
        $menu="Server error";
    }
    


?>
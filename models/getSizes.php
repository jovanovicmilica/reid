<?php
    require_once "konekcija.php";

    $upit="SELECT * FROM size ORDER BY idSize";
    try{
        $size=$konekcija->query($upit)->fetchAll();
    }
    catch(PDOException $e){
        $size="Server error";
    }
?>
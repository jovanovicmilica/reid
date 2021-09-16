<?php
    require_once "konekcija.php";


    $limit=4;
    $offset=0;
    $page=0;
    if(isset($_GET['page'])){
        $page=$_GET['page']-1;
    }
    $search="";
    if(isset($_GET['search'])){
        $search=$_GET['search'];
        $offset=$page*$limit;
    }
    $sum=0;
    $numberPages=0;
    

    $upit="SELECT * FROM product p INNER JOIN price pr ON p.idProduct=pr.idProduct WHERE pr.idPrice = (SELECT idPrice FROM price WHERE idProduct=pr.idProduct ORDER BY dateFrom DESC LIMIT 1) AND p.name LIKE '%$search%'";

    try{
        $data=$konekcija->query($upit);
        if($data->rowCount()==0){
            $products="There is no match";
        }
        else{
            $products=$data->fetchAll();
            $sum=$data->rowCount();
            $numberPages=ceil($sum/$limit);

    
            $upit.="LIMIT $limit OFFSET $offset";
            $products=$konekcija->query($upit)->fetchAll();

            if($page+1>$numberPages){
                $sum=0;
                $products="There is no match";
            }
        }

    }
    catch(PDOException $e){
        $products="Server error";
    }
?>

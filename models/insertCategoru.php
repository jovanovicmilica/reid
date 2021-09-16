<?php
    require_once "konekcija.php";

    $data="";
    $code=200;

    $nameCat=$_POST['name'];

    $regName="/^[A-Z][a-z]+(\s[A-Z][a-z]+)?$/";
    $greske=0;
    
    if(isset($_FILES['image'])){
        $slika=$_FILES['image'];

        $tmpName=$slika['tmp_name'];
        $size=$slika['size'];
        $tip=$slika['type'];
        $name=$slika['name'];
        $naziv=time().$name;
        $putanja="../assets/img/about/$naziv";
        move_uploaded_file($tmpName,$putanja);
    }
    else{
        $data="You have to choose image";
        $greske++;
    }
    

    
    if(!preg_match($regName,$nameCat)){
        $data="Title must begin with capital letter and have 2 word max";
        $greske++;
    }

    if($greske==0){
        $upit="INSERT INTO  category VALUES (null,:name,:img)";
        $priprema=$konekcija->prepare($upit);
        $priprema->bindParam(":name",$nameCat);
        $priprema->bindParam(":img",$naziv);
    
        try{  
            $data="Category added";
            $priprema->execute();
            $code=200;
        }
        catch(PDOException $e){
            $code=500;
            $data="Server error";
        }
    }

  

    
echo json_encode($data);
http_response_code($code);  


?>
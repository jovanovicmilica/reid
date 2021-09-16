<?php
    require_once "konekcija.php";

    $data="";
    $code=200;

    $nameCat=$_POST['name'];
    $id=$_POST['id'];

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
    

    
    if(!preg_match($regName,$nameCat)){
        $data="Title must begin with capital letter and have 2 word max";
        $greske++;
    }

    if($greske==0){
        if(isset($_FILES['image'])){
            $upit="UPDATE category SET name=:name,img=:img WHERE idCategory=:id";
            $priprema=$konekcija->prepare($upit);
            $priprema->bindParam(":img",$naziv);
        }
        else{
            $upit="UPDATE category SET name=:name WHERE idCategory=:id";
            $priprema=$konekcija->prepare($upit);
        }
        $priprema->bindParam(":name",$nameCat);
        $priprema->bindParam(":id",$id);
    
        try{  
            $data="Category updated";
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
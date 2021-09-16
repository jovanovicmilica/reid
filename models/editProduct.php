<?php

    require_once "konekcija.php";


    
        $data="";
        $code=200;
        $greske=0;

    
        $title= $_POST['name'];
        $desc= $_POST['descripion'];
        $price=$_POST['price'];
        $id=$_POST['id'];
        $oldPrice=$_POST['oldPrice'];

        if(isset($_FILES['image'])){
            $slika=$_FILES['image'];

            $tmpName=$slika['tmp_name'];
            $size=$slika['size'];
            $tip=$slika['type'];
            $name=$slika['name'];
            $naziv=time().$name;
            $putanja="../assets/img/product/$naziv";
        }
        else{
            $data="You have to choose image";
            $greske++;
        }
        


        $greske=0;

        $regTitle="/^[A-Z][a-z]+(\s[A-z]+)+$/";
        $regDesc=explode(" ",$desc);

        if(!preg_match($regTitle,$title)){
            $data="Title must begin with capital letter and have 2 words minimum";
            $greske++;
        }
        if(count($regDesc)<30){
            $data="Description have 30 words minimum";
            $greske++;
        }
        if(!is_numeric($price)){
            $data="Price is decimal";
            $greske++;
        }

        if($greske==0){
            
        if(isset($_FILES['image'])){
            $rezultat=move_uploaded_file($tmpName,$putanja);
            if(!$rezultat){
                $data="Error";
                $code=200;
            }
        }




            if(isset($_FILES['image'])){
                $upit="UPDATE product set name=:title,description=:description,img=:img WHERE idProduct=:id";
                $priprema=$konekcija->prepare($upit);
                $priprema->bindParam(":img",$naziv);
            }
            else{
                $upit="UPDATE product set name=:title,description=:description WHERE idProduct=:id";
                $priprema=$konekcija->prepare($upit);
            }
            $priprema->bindParam(":title",$title);
            $priprema->bindParam(":description",$desc);
            $priprema->bindParam(":id",$id);

            try{
                $priprema->execute();
                if($oldPrice!=$price){
                    $date=date("Y-m-d");
                    $upit2="INSERT INTO price values (null,$id,$price,'$date')";
                    try{
                        $konekcija->query($upit2);
                        $data="Product successfully updated";
                        $code=201;
                    }
                    catch(PDOException $e){
                        $data="Server error";
                        $code=500;
                    }
                }
                else{
                    $data="Product successfully updated";
                    $code=201;
                }
            }
            catch(PDOException $e){
                $data="Server error";
                $code=500;
            }
        }



    
echo json_encode($data);
http_response_code($code);
?>
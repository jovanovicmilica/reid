<?php

session_start();
    require_once "konekcija.php";

    $data="";
    $code=200;
    if(isset($_POST['btnLog'])){

        $email=$_POST['email'];
        $password=$_POST['password'];
    
        $regEmail="/^\w[.\d\w]*\@[a-z]{2,10}(\.[a-z]{2,3})+$/";
        $regPass="/^.{8,50}$/";

        $err=[];

        if(!preg_match($regEmail,$email)){
            array_push($err,"E-mail formats: pera@gmail.com or petar.petrovic@ict.edu.rs. ");
        }
        if(!preg_match($regPass,$password) && strlen($password)<8){
            array_push($err,"Password must be at least 8 characters long. ");
        }

        if(count($err)==0){
                    $upit="SELECT * FROM user u INNER JOIN roles r ON u.idRole=r.id WHERE email=:email AND active=1 AND  password=:pass";
                    $password=md5($password);
                    $priprema2=$konekcija->prepare($upit);
                    $priprema2->bindParam(":email",$email);
                    $priprema2->bindParam(":pass",$password);
                    try{
                        $priprema2->execute();
                        $code=200;
                        if($priprema2->rowCount()==1){
                            $user=$priprema2->fetch();
                            $_SESSION['user']=$user;
                            $code=200;
                            $data="ok";
                        }
                        else{
                            $data="User not found";
                        }
                    }
                    catch(PDOException $e){
                        $code=500;
                        $data="Server error";
                    }
            }
            else{
                $data=$err;
            }
    }
    else if(isset($_POST['btnReg'])){
        $firstName=$_POST['firstName'];
        $lastName=$_POST['lastName'];
        $phone=$_POST['phone'];
        $email=$_POST['email'];
        $password=$_POST['password'];
        
        $regName="/^[A-ZŠĐŽČĆ][a-zšđžčć]{2,19}$/";
        $regEmail="/^\w[.\d\w]*\@[a-z]{2,10}(\.[a-z]{2,3})+$/";
        $regPass="/^.{8,15}$/";
        $regPhone="/^06\d{1}\/\d{7}$/";

        $err=[];
        if(!preg_match($regName,$firstName)){
            array_push($err,"First name has capital letter, 3 letter min, 20 max. ");
        }
        if(!preg_match($regName,$lastName)){
            array_push($err,"Last name has capital letter, 3 letter min, 20 max. ");
        }
        if(!preg_match($regEmail,$email)){
            array_push($err,"E-mail formats: pera@gmail.com or petar.petrovic@ict.edu.rs. ");
        }
        if(!preg_match($regPass,$password) && strlen($password)<8){
            array_push($err,"Password must be at least 8 characters long. ");
        }
        if(!preg_match($regPhone,$phone)){
            array_push($err,"Phone format: 060/1234567. ");
        }

        if(count($err)==0){
            $mailProvera="SELECT email FROM user WHERE email=:email";
            $priprema=$konekcija->prepare($mailProvera);
                $priprema->bindParam(":email",$email);
            try{
                $priprema->execute();
                $rez=$priprema->fetch();
                if($priprema->rowCount()==1){
                    $data="userName";
                    $code=200;
                }
                else{

                            $insert="INSERT INTO user VALUES(NULL,:fName,:lName,:telefon,:iduloge,:email,:pass,:aktivan,:kod)";
                            $password=md5($password);
                            $datum=date("Y-m-d H:i:s");
                            $uloga=2;
                            $aktivan=1;
                            $kod=md5(time().md5($email));
                            
                            //mail($mail,"Account activation","http://127.0.0.1/reid/activation.php?kod=".$kod);
                            $priprema2=$konekcija->prepare($insert);
                            $priprema2->bindParam(":fName",$firstName);
                            $priprema2->bindParam(":lName",$lastName);
                            $priprema2->bindParam(":email",$email);
                            $priprema2->bindParam(":pass",$password);
                            $priprema2->bindParam(":aktivan",$aktivan);
                            $priprema2->bindParam(":kod",$kod);
                            $priprema2->bindParam(":iduloge",$uloga);
                            $priprema2->bindParam(":telefon",$phone);
                            try{
                                $uspesno=$priprema2->execute();
                                $code=201;
                                $data="You have successfuli register. Activate you acount.";
                            }
                            catch(PDOException $e){
                                $code=500;
                                $data="Server error";
                            }
                }
            }
            catch(PDOException $e){
                $data="Server error";
                $code=500;
            }  
        }
        else{
            $data=$err;
        }
    }
    else{
        $data="Error 404.";
        $code=404;
    }


    
echo json_encode($data);
http_response_code($code);

?>
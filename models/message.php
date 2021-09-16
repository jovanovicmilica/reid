<?php

    require_once "konekcija.php";

if(isset($_POST["btnMessage"])){
    $kod=200;
    $email=$_POST["email"];
    $subject=$_POST["subject"];
    $message=$_POST["message"];
    $regEmail="/^\w[.\d\w]*\@[a-z]{2,10}(\.[a-z]{2,3})+$/";
    $regNaslov="/^[\w\s]+$/";
    $greska=0;
    if(!preg_match($regEmail,$email)){
        $greska++;
        $data="E-mail formats: pera@gmail.com or petar.petrovic@ict.edu.rs";
    }
    if(!preg_match($regNaslov,$subject)){
        $greska++;
        $data="You have to write subject";
    }
    if(count($message)<10){
        $greska++;
        $data="Message mus have 10 words minimum";
    }
    if($greska==0){
        $message=implode($message," ");
        $insert="INSERT INTO message VALUES(null,:email,:subj,:mess)";
        $priprema=$konekcija->prepare($insert);
        $priprema->bindParam(":email",$email);
        $priprema->bindParam(":subj",$subject);
        $priprema->bindParam(":mess",$message);
        try{
            $priprema->execute();
            $poruka="Message successfuly sent";
            $kod=201;
        }
        catch(PDOException $e){
            $poruka="Server error";
            $kod=500;
            zabeleziGresku($e);
        }
    }
}
else{
    $kod=404;
    $poruka="Error";
}

echo json_encode($poruka);
http_response_code($kod);
?>
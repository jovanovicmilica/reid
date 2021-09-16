<?php
    require_once "konekcija.php";


    $upit="SELECT * FROM survey WHERE active=1";
    $glasao=false;
    
    try{
        $rez=$konekcija->query($upit);
        if($rez->rowCount()!=0){
            $question=$rez->fetch();
            $idQuestion=$question['idSurvey'];
            $upit2="SELECT * FROM answer WHERE idSurvey=$idQuestion";
            $answers=$konekcija->query($upit2)->fetchAll();
            if(isset($_SESSION['user'])){
                $user=$_SESSION['user'];
                $idUser=$user['idUser'];
                $upit3="SELECT * FROM useranswer ua INNER JOIN answer a ON a.idAnswer=ua.idAnswer WHERE idUser=$idUser AND a.idSurvey=(SELECT idSurvey FROM survey WHERE active=1)";
                try{
                    $rez2=$konekcija->query($upit3);
                    if($rez2->rowCount()==1){
                        $glasao=true;
                    }
                    else{
                        $glasao=false;
                    }
                }
                catch(PDOException $e){
                    $code=500;
                    $message="Server error";
                }
            }
        }
    }
    catch(PDOException $e){
        $code=500;
        $message="Server error";
    }
?>
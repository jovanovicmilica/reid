<?php

require_once "konekcija.php";

        $pitanjeUpit="SELECT * FROM survey";

        $upit="SELECT *,ROUND(COUNT(o.idAnswer)/(SELECT COUNT(idAnswer) AS ukupno FROM useranswer)*100) AS broj FROM useranswer oa INNER JOIN answer o ON oa.idAnswer=o.idAnswer GROUP BY o.idAnswer";
        $code=200;
    
        try{
            $pitanje=$konekcija->query($pitanjeUpit)->fetch();
            $data['pitanje']=$pitanje['question'];
            $data['aktivna']=$pitanje['active'];
            $data['odgovori']=$konekcija->query($upit)->fetchAll();
        }
        catch(PDOException $e){
            $code=500;
            $data=$e;
        }

    

    
echo json_encode($data);
http_response_code($code);

?>
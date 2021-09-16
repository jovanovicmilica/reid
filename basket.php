<?php

    $title="Basket";

    require_once "view/fixed/head.php";

    require_once "view/fixed/header.php";

    if(isset($_SESSION['user'])){
        require_once "view/pages/basket.php";
    }
    else{
        echo "<div class='pt-5 text-center'><h1 class='pt-5'>Error 404</h1></div>";
    }

    require_once "view/fixed/footer.php";

?>
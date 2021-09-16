<?php
    require_once "models/getProducts.php";
?>

    <!--shop  area start-->
    <div class="shop_area shop_fullwidth shop_reverse pt-5">
        <div class="container pt-5">
            <div class="shop_inner_area">
                <div class="row">
                    <div class="col-12">
                        <!--shop toolbar start-->
                        <div class="shop_toolbar_wrapper">
                            <div class="shop_toolbar_btn">

                                <button data-role="grid_3" type="button" class=" btn-grid-3" data-toggle="tooltip" title="3"></button>

                                <button data-role="grid_4" type="button"  class="active btn-grid-4" data-toggle="tooltip" title="4"></button>

                                <button data-role="grid_5" type="button"  class="btn-grid-5" data-toggle="tooltip" title="5"></button>

                            </div>
                            <div class="page_amount">
                                <p><?=$sum?> results</p>
                            </div>
                        </div>
                         <!--shop toolbar end-->
                        
                         <div class="row shop_wrapper">

                            <?php
                            if($sum!=0):
                                foreach($products as $p):
                            ?>
                            <div class="col-lg-3 col-md-4 col-12 ">
                                <div class="single_product">
                                    <div class="product_thumb">
                                        <a class="primary_img" href="product-details.php?id=<?=$p['idProduct']?>"><img src="assets/img/product/<?=$p['img']?>" alt="<?=$p['name']?>"></a>
                                    </div>
                                    
                                    <div class="product_content grid_content">
                                        <h3><a href="product-details.php?id=<?=$p['idProduct']?>"><?=$p['name']?></a></h3>
                                        <span class="current_price">$<?=$p['price']?></span>
                                    </div>
                                </div>
                            </div>
                            <?php
                                endforeach;
                            else:
                            ?>
                                <h2 class="my-5"><?=$products?></h2>
                            <?php
                                endif;
                            ?>
                        </div>
                        <!--shop toolbar end-->
                    </div>    
                </div>
                
                <!--shop tab product end-->
                <div class="row">
                    <div class="col-12">
                        <!--shop toolbar start-->
                            <?php

                                $page=1;
                                if(isset($_GET['page'])){
                                    $page=$_GET['page'];
                                }
                                if($page<=$numberPages):
                            ?>
                            
                        <div class="shop_toolbar t_bottom">
                            <div class="pagination">
                                <ul>
                                    <?php
                                    $search="";
                                    if(isset($_GET['search'])){
                                        $search=$_GET['search'];
                                    }
                                        if($page!=1):
                                            $previous=$page-1;
                                    ?>
                                        <li class="next"><a href="<?=$_SERVER['PHP_SELF']."?page=".$previous."&search=".$search?>">Previous</a></li>
                                    <?php
                                        endif;
                                    ?>
                                    <?php
                                        for($i=0;$i<$numberPages;$i++):
                                            $br=$i+1;
                                    ?>
                                        <li><a href="<?=$_SERVER['PHP_SELF']."?page=".$br."&search=".$search?>"><?=$br?></a></li>
                                    <?php
                                        endfor;
                                    ?>
                                    <?php
                                        if($page!=$numberPages):
                                            $next=$page+1;
                                    ?>
                                        <li class="next"><a href="<?=$_SERVER['PHP_SELF']."?page=".$next."&search=".$search?>">Next</a></li>
                                    <?php
                                        endif;
                                    ?>
                                </ul>
                            </div>
                        </div>
                            <?php
                                endif;
                            ?>
                        <!--shop toolbar end-->
                    </div>
                </div>       
            </div>   
                
        </div>
    </div>
    <!--shop  area end-->
<?php
    require_once "models/getProduct.php";
    require_once "models/getSizes.php";
    require_once "models/getNew.php";
?>

    <?php
        if(isset($message)):
    ?>
        <div class="container pt-5 text-center">
            <div class="row pt-5">
                <h1 class="pt-5"><?=$message?></h1>
            </div>
        </div>
    <?php
        else:
    ?>
    <!--product details start-->
    <div class="product_details pt-5">
        <div class="container pt-5">
            <div class="row pt-5">
                <div class="col-lg-5 col-md-5">
                   <div class="product-details-tab">

                        <div id="img-1" class="zoomWrapper single-zoom">
                            <a href="#">
                                <img id="zoom1" src="assets/img/product/<?=$product['img']?>" data-zoom-image="assets/img/product/<?=$product['img']?>" alt="<?=$product['name']?>">
                            </a>
                        </div>

                    </div>
                </div>
                <div class="col-lg-7 col-md-7">
                    <div class="product_d_right">
                       <form action="#">
                           
                            <h1><?=$product['name']?></h1>
                            <div class="product_price">
                                <span class="current_price">$<?=$product['price']?></span>
                            </div>
                            <div class="product_desc">
                                <p><?=$product['description']?></p>
                            </div>

                            <div class="product_variant size">
                                <h3>size</h3>
                                <select class="niceselect_option" id="size" name="produc_color">
                                    <option selected value="0">size</option> 
                                    <?php
                                        foreach($size as $s):
                                    ?>
                                        <option value="<?=$s['idSize']?>"><?=$s['size']?></option> 
                                    <?php
                                        endforeach;
                                    ?>             
                                </select> 
                            </div>
                            <div class="product_variant quantity">
                                <input type="hidden" id="price" value="<?=$product['idPrice']?>">
                                <label>quantity</label>
                                <input id="quantity" min="1" max="100" value="1" type="number">
                                <button class="button" type="button" id="add">add to cart</button> 
                            </div>
                            <div>
                                
                            <p id="errorAdd"></p> 
                            </div>
                            
                        </form>

                    </div>
                </div>
            </div>
        </div>    
    </div>
    <!--product details end-->
    
    
    <!--product section area start-->
    <section class="product_section related_product">
        <div class="container">
            <div class="row">   
                <div class="col-12">
                   <div class="section_title">
                       <h2>New Products</h2>
                       <p>Contemporary, minimal and modern designs embody the Lavish Alice handwriting</p>
                   </div>
                </div> 
            </div>    
            <div class="product_area"> 
                 <div class="row">
                    <div class="product_carousel product_three_column4 owl-carousel">
                        <?php
                            foreach($new as $n):
                        ?>
                        <div class="col-lg-3">
                            <div class="single_product">
                                <div class="product_thumb">
                                    <a class="primary_img" href="product-details.php?id=<?=$n['idProduct']?>"><img src="assets/img/product/<?=$n['img']?>" alt="<?=$n['name']?></a>"></a>
                                </div>
                                <div class="product_content">
                                    <h3><a href="product-details.php?id=<?=$n['idProduct']?>"><?=$n['name']?></a></h3>
                                    <span class="current_price">$<?=$n['price']?></span>
                                </div>
                            </div>
                        </div>
                        <?php
                            endforeach;
                        ?>
                    </div>
                </div>
            </div>
               
        </div>
    </section>
    <!--product section area end-->
    
    <?php
        endif;
    ?>
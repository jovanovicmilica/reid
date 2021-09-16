<?php
    require_once "models/getCategories.php";
    require_once "models/getSurvey.php";
?>

    <!--slider area start-->
    <div class="slider_area home_seven_slider owl-carousel">
        <div class="single_slider" data-bgimg="assets/img/slider/slider13.jpg">
           <div class="slider_content_inner">
                <div class="slider_content">
                   <h2>new arrivals</h2>
                    <h1>autumn</h1>
                    <p>Brands you know & love </p>
                    <a href="shop.php">Discover Now</a>
                </div>  
            </div>     
        </div>
        <div class="single_slider" data-bgimg="assets/img/slider/slider14.jpg">
           <div class="slider_content_inner">
                <div class="slider_content">
                    <h2>top products</h2>
                    <h1>packback</h1>
                    <p>Backpacks and Bags for Hiking, Trekking, and Everyday Use </p>
                    <a href="shop.php">Discover Now</a>
                </div> 
            </div>   
        </div>
        <div class="single_slider" data-bgimg="assets/img/slider/slider15.jpg">
           <div class="slider_content_inner">
                <div class="slider_content">
                    <h2>top selections</h2>
                    <h1>handbag</h1>
                    <p>Your plans for the season meet perfect bags for every of them </p>
                    <a href="shop.php">Discover Now</a>
                </div> 
            </div>         
        </div>
    </div>
    <!--slider area end-->

    
    <!--shiping area start-->
    <div class="shipping_area px-5">
        <div class="container-fluid">
            <div class="row">
               <div class="shipping_carousel shipping_column5 owl-carousel">
                    <?php
                        foreach($category as $c):
                    ?>
                    <div class="col-lg-2">
                         <div class="single_shipping">
                             <div class="shipping_thumb">
                                <a href=""><img src="assets/img/about/<?=$c['img']?>" alt="<?=$m['name']?>"></a>
                             </div>  
                             <div class="shipping_content">
                                <a href=""><?=$c['name']?></a>
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
    <!--shiping area end-->


    <!--banner area start-->
    <section class="banner_section">
        <div class="container-fluid">
            <div class="row ">
                <div class="col-12">
                   <div class="banner_conteiner">
                       <div class="banner_text">
                            <h1>Game Of Thrones Jaime<br> Lannister <br>Themed Sneakers</h1>
                            <a href="shop.php">Discover Now</a>
                        </div>
                   </div>
                </div>
            </div>
        </div>
    </section>
    <!--banner area end-->
    <!--Instagram area start--> 
    <section class="instagram_area instagram_seven">
        <div class="container-fluid">
            <div class="row">
               <div class="col-12">
                   <div class="section_title">
                       <h2>Follow us On Instagram</h2>
                       <p>Contemporary, minimal and modern designs embody the Lavish Alice handwriting</p>
                   </div>
               </div>
           </div>
           <div class="instagram_home_block">
                <div class="row">
                    <div class="instagram_wrapper instagram_column5 owl-carousel">
                       <div class="col-lg-3">
                           <div class="single_instagram">
                               <a href="#"><img src="assets/img/about/intagram.png" alt=""></a>
                               <div class="instagram_icone">
                                   <a class="instagram_pupop" href="assets/img/about/intagram.png"><i class="fa fa-instagram"></i></a>
                               </div>
                           </div>
                       </div>
                       <div class="col-lg-3">
                           <div class="single_instagram">
                               <a href="#"><img src="assets/img/about/intagram1.png" alt=""></a>
                               <div class="instagram_icone">
                                   <a class="instagram_pupop" href="assets/img/about/intagram1.png"><i class="fa fa-instagram"></i></a>
                               </div>
                           </div>
                       </div>
                       <div class="col-lg-3">
                           <div class="single_instagram">
                               <a href="#"><img src="assets/img/about/intagram2.png" alt=""></a>
                               <div class="instagram_icone">
                                   <a class="instagram_pupop" href="assets/img/about/intagram2.png"><i class="fa fa-instagram"></i></a>
                               </div>
                           </div>
                       </div>
                       <div class="col-lg-3">
                           <div class="single_instagram">
                               <a href="#"><img src="assets/img/about/intagram3(1).png" alt=""></a>
                               <div class="instagram_icone">
                                   <a class="instagram_pupop" href="assets/img/about/intagram3(1).png"><i class="fa fa-instagram"></i></a>
                               </div>
                           </div>
                       </div>
                       <div class="col-lg-3">
                           <div class="single_instagram">
                               <a href="#"><img src="assets/img/about/intagram4(1).png" alt=""></a>
                               <div class="instagram_icone">
                                   <a class="instagram_pupop" href="assets/img/about/intagram4(1).png"><i class="fa fa-instagram"></i></a>
                               </div>
                           </div>
                       </div>
                       <div class="col-lg-3">
                           <div class="single_instagram">
                               <a href="#"><img src="assets/img/about/intagram1.png" alt=""></a>
                               <div class="instagram_icone">
                                   <a class="instagram_pupop" href="assets/img/about/intagram1.png"><i class="fa fa-instagram"></i></a>
                               </div>
                           </div>
                       </div>
                   </div>
                    <div class="col-12">
                       <div class="text_follow">
                           <a href="#">#Follow us on Instagram</a>
                       </div>
                   </div>
                </div>
           </div>
        </div>
    </section>
    <!--Instagram area end--> 

    <?php
    if(isset($question)):
    ?>
    <form action="">
    <div class="container">
        <div class="row text-center">
            <h2>Survey</h2>
        </div>
        <div class="row text-center">
            <?php
                if(isset($_SESSION['user'])):
            ?>
                <h3><?=$question['question']?></h3>
                <div class="my-3">
                <?php
                    foreach($answers as $a):
                ?>
                    <input type="radio" value="<?=$a['idAnswer']?>" name="answer"> <?=$a['answer']?> 
                <?php
                    endforeach;
                ?>
                </div>
                <div class="product_variant quantity my-3 mx-auto">
                <button 
                <?php
                    if($glasao):
                ?>
                    disabled="true"
                <?php
                    endif;
                ?>
                class="button border-none mx-auto" type="button" id="vote">Vote</button>
                </div>
                <div class="mx-auto text-center">
                    <p id="answerError"></p>
                </div>
            <?php
                else:
            ?>
                <h3>Login to vote our survey</h3>
            <?php
                endif;
            ?>
        </div>
    </div>
</form>
    <?php
        endif;
    ?>
    
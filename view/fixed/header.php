<?php
    require_once "models/getMenu.php";
?>
    <!-- Main Wrapper Start -->
    <!--Offcanvas menu area start-->
    <div class="off_canvars_overlay">
                
    </div>
    <div class="offcanvas_menu offcanvas_seven">
        <div class="canvas_open">
                        <a href="javascript:void(0)"><i class="ion-navicon"></i></a>
                    </div>
        <div class="offcanvas_menu_wrapper">
                        <div class="canvas_close">
                              <a href="javascript:void(0)"><i class="ion-android-close"></i></a>  
                        </div>
                        <div class="search_bar">
                            <form action="shop.php" method="get">
                                <input 
                                <?php
                                    if(isset($_GET['search'])):
                                        $key=$_GET['search'];
                                ?>
                                    value="<?=$key?>"
                                <?php
                                    endif;
                                ?>
                                placeholder="Search entire store here..." name="search" type="text">
                                <button type="submit"><i class="ion-ios-search-strong"></i></button>
                            </form>
                        </div>
                        <div id="menu" class="text-left ">
                            <ul class="offcanvas_main_menu">
                                <?php
                                    foreach($menu as $m):
                                ?>
                                <li class="menu-item-has-children">
                                    <a href="<?=$m['path']?>"><?=$m['name']?></a>
                                </li>
                                <?php
                                    endforeach;
                                ?>
                            </ul>
                        </div>
                            <?php
                                if(isset($_SESSION['user'])):
                            ?>
                            <div class="cart_link">
                                <a href="basket.php"><i class="fa fa-shopping-basket"></i>Basket</a>
                                <!--mini cart-->
                                <!--mini cart end-->
                            </div>
                            <?php
                                endif;
                            ?>
                        <div class="offcanvas_footer">
                            <span><a href="#"><i class="fa fa-envelope-o"></i> info@yourdomain.com</a></span>
                            <ul>
                                <li class="facebook"><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li class="twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li class="pinterest"><a href="#"><i class="fa fa-pinterest-p"></i></a></li>
                                <li class="google-plus"><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li class="linkedin"><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                        </div>
                    </div>
    </div>
    <!--Offcanvas menu area end-->
    <!--header area start-->
    <header class="header_area header_seven sticky-header">
        <!--header top start-->
        <div class="container-fluid"> 
               <div class="header_seven_top">
                <div class="row align-items-center">
                   <div class="col-lg-3">
                        <div class="header_top_logo_wrapper">
                            <div class="logo">
                                <a href="index.php"><img src="assets/img/logo/logo.png" alt=""></a>
                            </div>
                            <div class="home_menu_bar">
                                <div class="icone_menu">
                                    <a href="#"><i class="fa fa-bars"></i></a>
                                    <div class="home_menu_inner">
                                        <nav>  
                                                    <ul class="dropdown_other_page_menu">
                                                        <?php
                                                            foreach($menu as $m):
                                                        ?>
                                                        <li><a href="<?=$m['path']?>"><?=$m['name']?></a></li>
                                                        <?php
                                                            endforeach;
                                                        ?>
                                                    </ul>
                                                </li>
                                            </ul>  
                                        </nav>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="header_top_right">
                            <div class="search_bar">
                                <form action="shop.php" method="get">                          
                                    <input 
                                    
                                    <?php
                                    $key="";
                                    if(isset($_GET['search'])):
                                        $key=$_GET['search'];
                                    ?>
                                        value="<?=$key?>"
                                    <?php
                                    endif;
                                    ?>
                                    placeholder="Search entire store here..." name="search" type="text">
                                    <button type="submit"><i class="ion-ios-search-strong"></i></button>
                                </form>
                            </div>
                           
                            <?php
                                if(isset($_SESSION['user'])):
                            ?>
                            <div class="cart_link">
                                <a href="basket.php"><i class="fa fa-shopping-basket"></i>Basket</a>
                                <!--mini cart-->
                                <!--mini cart end-->
                            </div>
                            <?php
                                endif;
                            ?>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--header top end-->
    </header>
    <!--header area end-->
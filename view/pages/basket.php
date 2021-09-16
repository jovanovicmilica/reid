<?php
    require_once "models/getCard.php";
?>

    <!--shopping cart area start -->
    <div class="shopping_cart_area pt-5">
        <div class="container pt-5">  
            <?php
                if(isset($message)):
            ?>
            <div class="row text-center pt-5">
                <h1><?=$message?></h1>
            </div>
            <?php
                else:
            ?>
            <form action="#"> 
                <div class="row text-center pt-5">
                    <h1 id="message"></h1>
                </div>
                <div class="row" id="tabela">
                    <div class="col-12">
                        <div class="table_desc">
                            <div class="cart_page table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="product_remove">Delete</th>
                                            <th class="product_thumb">Image</th>
                                            <th class="product_name">Product</th>
                                            <th class="product-price">Price</th>
                                            <th class="product_quantity">Quantity</th>
                                            <th class="product_quantity">Size</th>
                                            <th class="product_total">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach($basket as $b):
                                        ?>
                                        <tr>
                                           <td class="product_remove"><a class="deleteFromBasket" data-id="<?=$b['idOrder']?>" href="#"><i class="fa fa-trash-o"></i></a></td>
                                            <td class="product_thumb"><a href="#"><img src="assets/img/product/<?=$b['img']?>" alt=""></a></td>
                                            <td class="product_name"><a href="#"><?=$b['name']?></a></td>
                                            <td class="product-price">$<?=$b['price']?></td>
                                            <td class="product_quantity"><p><?=$b['quantity']?></p></td>
                                            <td class="product_quantity"><p><?=$b['size']?></p></td>
                                            <td class="product_total">$<?=$b['quantity']*$b['price']?></td>
                                        </tr>
                                        <?php
                                            endforeach;
                                        ?>
                                    </tbody>
                                </table>   
                            </div>     
                        </div>
                    </div>
                </div>
                
                <!--coupon code area start-->
                <div class="coupon_area" id="total">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="coupon_code right">
                                <h3>Cart Totals</h3>
                                <div class="coupon_inner">
                                   <div class="cart_subtotal">
                                        <p>   
                                            <label>Address: <span>*</span></label>
                                        </p>
                                        <p>
                                            <input type="text" id="address">
                                        </p>
                                   </div>
                                    <hr>
                                   <div class="cart_subtotal">
                                       <p>Total</p>
                                       <p class="cart_amount">$<?=$total['total']?></p>
                                   </div>
                                   <div class="checkout_btn">
                                       <button type="button" id="order">Order</button>
                                   </div>
                                   <p id="errorBasket"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--coupon code area end-->
                
            </form> 
            <?php
                endif;
            ?>
        </div>     
    </div>
    <!--shopping cart area end -->
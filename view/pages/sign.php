<?php?>
    
    <!-- customer login start -->
    <div class="customer_login pt-5">
        <div class="container pt-5">
            <div class="row pt-5">
               <!--login area start-->
                <div class="col-lg-6 col-md-6">
                    <div class="account_form">
                        <h2>login</h2>
                        <form action="#">
                            <p>   
                                <label>E-mail <span>*</span></label>
                                <input type="text" id="email">
                             </p>
                             <p>   
                                <label>Password <span>*</span></label>
                                <input type="password" id="password">
                             </p>   
                            <div class="login_submit">
                                <button type="button" id="login">login</button>
                            </div>
                            <p id="errorsLogin"></p>
                        </form>
                     </div>    
                </div>
                <!--login area start-->

                <!--register area start-->
                <div class="col-lg-6 col-md-6">
                    <div class="account_form register">
                        <h2>Register</h2>
                        <form action="#">
                            <p>   
                                <label>First Name  <span>*</span></label>
                                <input type="text" id="firstName">
                            </p>
                            <p>   
                                <label>Last Name  <span>*</span></label>
                                <input type="text" id="lastName">
                            </p>
                            <p>   
                                <label>Phone  <span>*</span></label>
                                <input type="text" id="phone">
                            </p>
                            <p>   
                                <label>Email address  <span>*</span></label>
                                <input type="text" id="emailReg">
                             </p>
                             <p>   
                                <label>Passwords <span>*</span></label>
                                <input type="password" id="passwordReg">
                             </p>
                            <div class="login_submit">
                                <button type="button" id="register">Register</button>
                            </div>
                            <p id="errorsRegister"></p>
                        </form>
                    </div>    
                </div>
                <!--register area end-->
            </div>
        </div>    
    </div>
    <!-- customer login end -->
<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="keywords" content="Travel, Blog, Travel blog, Relax, Travel, Food"/>
        <meta name="description" content="A travel blog for the curious and adventurous; pursuers of great travel experiences. Whether you need guidance for your first solo trip or you're a seasoned traveler looking for destination inspiration, you've come to the right place!"/>
        <title>Admin Panel</title>
        <link href="css/styles.css" rel="stylesheet"/>
        <link rel="stylesheet" href="../../assets/css/style.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <link rel="shortcut icon" href="../../assets/img/favicon.ico"/>
    </head>
    <body class="sb-nav-fixed">
        <?php
            if(isset($_SESSION['user'])):
                $user=$_SESSION['user'];
                if($user['idRole']==1):
        ?>
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark justify-content-between">
            <div>
                <a class="navbar-brand" href="../../index.php">Home</a>
                <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            </div>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0 navAdmin">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="../../signout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Content</div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-clipboard"></i></div>
                                Products
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="#" id="allProducts">All products</a>
                                    <!-- <a class="nav-link" href="#" id="addPostForm">Add post</a> -->
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-tags"></i></i></div>
                                Categories
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="#" id="allCategories">All categories</a>
                                    <!-- <a class="nav-link" href="#" id="addCategoryForm">Add category</a> -->
                                </nav>
                            </div>

                            <a class="nav-link" href="#" id="orders">
                                <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
                                Orders
                            </a>


                            <div class="sb-sidenav-menu-heading">Survey</div>
                            <a class="nav-link" href="#" id="survey">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Survey
                            </a>
                            <div class="sb-sidenav-menu-heading">Users</div>
                            <a class="nav-link" href="#" id="users">
                                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                All users
                            </a>
                            <a class="nav-link" href="#" id="messages">
                                <div class="sb-nav-link-icon"><i class="fas fa-comment"></i></div>
                                Messages
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <div id="layoutSidenav_content pt-2">
            <main class="pt-4">
                <div class="container p-4">
                    <div class="row">
                        <div class="col-12">
                            <h1 class="pt-3 text-center" id="title">Admin Panel</h1>
                        </div>
                        <div class="col-12 mx-auto mt-3" id="content"></div>
                        <div class="row form" id="forms"></div>
                    </div>
                </div>
            </main>
        </div>
        <?php
            else:
                header("Location:../../404.php");
            endif;
        else:
            header("Location:../../404.php");
        endif;
        ?>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    
    
        <script src="../../assets/js/myjs.js" type="text/javascript"></script>
    </body>
</html>


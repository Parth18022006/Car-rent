<?php
require '../../include/init.php';
include pathof('include/header.php');
include pathof('include/nav.php');
?>
       

        <!-- Header Start -->
        <div class="container-fluid bg-breadcrumb">
            <div class="container text-center py-5" style="max-width: 900px;">
                <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">404 Pages</h4>
                <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                    <li class="breadcrumb-item"><a href="../../index">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item active text-primary">404 Page</li>
                </ol>    
            </div>
        </div>
        <!-- Header End -->

        <!-- 404 Start -->
        <div class="container-fluid bg-light py-5">
            <div class="container py-5 text-center">
                <div class="row justify-content-center">
                    <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                        <i class="bi bi-exclamation-triangle display-1 text-primary"></i>
                        <h1 class="display-1">404</h1>
                        <h1 class="mb-4">Page Not Found</h1>
                        <p class="mb-4">We’re sorry, the page you have looked for does not exist in our website! Maybe go to our home page or try to use a search?</p>
                        <a class="btn btn-primary rounded-pill py-3 px-5" href="<?= urlof('./index')?>">Go Back To Home</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- 404 End -->

        <?php
        include pathof('include/footer.php');
        ?>
        
        


        <!-- Back to Top -->
        <a href="#" class="btn btn-secondary btn-lg-square rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>   

        
        <?php
        include pathof('include/script.php');
        include pathof('include/closing tag.php');
        ?>
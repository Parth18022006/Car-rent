<!-- Navbar & Hero Start -->
<div class="container-fluid nav-bar sticky-top px-0 px-lg-4 py-2 py-lg-0">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a href="" class="navbar-brand p-0">
                        <h1 class="display-6 text-primary"><i class="fas fa-car-alt me-3"></i></i>Cental</h1>
                        <!-- <img src="img/logo.png" alt="Logo"> -->
                    </a>
                     <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                        <span class="fa fa-bars"></span>
                    </button> 
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <div class="navbar-nav mx-auto py-0">
                            <a href="<?=urlof('index.php')?>" class="nav-item nav-link active">Home</a>
                            <a href="<?=urlof('pages/Template pages/about.php')?>" class="nav-item nav-link">About</a>
                            <a href="<?=urlof('pages/Template pages/service.php')?>" class="nav-item nav-link">Service</a>
                            <a href="<?=urlof('pages/Template pages/blog.php')?>" class="nav-item nav-link">Blog</a>
                            
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                                <div class="dropdown-menu m-0">
                                    <a href="<?=urlof('pages/Template pages/feature.php')?>" class="dropdown-item">Our Feature</a>
                                    <a href="<?=urlof('pages/Template pages/cars.php')?>" class="dropdown-item">Our Cars</a>
                                    <a href="<?=urlof('pages/Template pages/team.php')?>" class="dropdown-item">Our Team</a>
                                    <a href="<?=urlof('pages/Template pages/testimonial.php')?>" class="dropdown-item">Testimonial</a>
                                    <a href="<?=urlof('pages/Template pages/404.php')?>" class="dropdown-item">404 Page</a>
                                </div>
                            </div>
                            <?php
                                if(isset($_SESSION['user'])){
                                   ?> 
                                   <a href="<?=urlof('api/user/logout.php')?>" class="nav-item nav-link">Logout</a>
                                   <a href="<?=urlof('pages/Edit/index.php')?>" class="nav-item nav-link">Edit</a>
                                    <?php
                                    }
                                else{
                                  ?> 
                                   <a href="<?=urlof('pages/User/login.php')?>" class="nav-item nav-link">Login</a>

                                  <?php

                                }
                            ?>
                            <a href="<?=urlof('pages/Template pages/contact.php')?>" class="nav-item nav-link">Contact</a>
                        </div>
                        <a href="#" class="btn btn-primary rounded-pill py-2 px-4">Get Started</a>
                    </div>
                </nav>
            </div>
        </div>
        <!-- Navbar & Hero End -->

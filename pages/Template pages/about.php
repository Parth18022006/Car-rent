<?php
require '../../include/init.php';
include pathof('include/header.php');
include pathof('include/nav.php');
?>
       

        <!-- Header Start -->
        <div class="container-fluid bg-breadcrumb">
            <div class="container text-center py-5" style="max-width: 900px;">
                <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">About Us</h4>
                <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                    <li class="breadcrumb-item"><a href="../../index">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item active text-primary">About</li>
                </ol>    
            </div>
        </div>
        <!-- Header End -->

        <!-- About Start -->
        <div class="container-fluid overflow-hidden about py-5">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-xl-6 wow fadeInLeft" data-wow-delay="0.2s">
                        <div class="about-item">
                            <div class="pb-5">
                                <h1 class="display-5 text-capitalize">Cental <span class="text-primary">About</span></h1>
                                <p class="mb-0"> At Car-Rent, we are passionate about making car rental simple, accessible, and affordable. With years of industry experience and a focus on customer satisfaction, we deliver exceptional value and convenience with every rental.
                                </p>
                            </div>
                            <div class="row g-4">
                                <div class="col-lg-6">
                                    <div class="about-item-inner border p-4">
                                        <div class="about-icon mb-4">
                                            <img src="<?=urlof('assets/img/about-icon-1.png')?>" class="img-fluid w-50 h-50" alt="Icon">
                                        </div>
                                        <h5 class="mb-3">Our Vision</h5>
                                        <p class="mb-0">To become the most trusted and preferred car rental platform by offering innovative, reliable, and user-friendly services for every journey.</p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="about-item-inner border p-4">
                                        <div class="about-icon mb-4">
                                            <img src="<?=urlof('assets/img/about-icon-2.png')?>" class="img-fluid h-50 w-50" alt="Icon">
                                        </div>
                                        <h5 class="mb-3">Our Mision</h5>
                                        <p class="mb-0">To provide safe, affordable, and high-quality car rental services through a seamless digital experience and a commitment to customer care.</p>
                                    </div>
                                </div>
                            </div>
                            <p class="text-item my-4">Whether you're traveling for business, leisure, or everyday needs, Car-Rent ensures your ride is smooth, secure, and perfectly suited to your preferences. With flexible options and transparent pricing, you stay in control from start to finish.
                            </p>
                            <div class="row g-4">
                                <div class="col-lg-6">
                                    <div class="text-center rounded bg-secondary p-4">
                                        <h1 class="display-6 text-white">17</h1>
                                        <h5 class="text-light mb-0">Years Of Experience</h5>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="rounded">
                                        <p class="mb-2"><i class="fa fa-check-circle text-primary me-1"></i> Wide range of vehicle options</p>
                                        <p class="mb-2"><i class="fa fa-check-circle text-primary me-1"></i> Competitive and transparent pricing</p>
                                        <p class="mb-2"><i class="fa fa-check-circle text-primary me-1"></i> Easy online booking and cancellation</p>
                                        <p class="mb-0"><i class="fa fa-check-circle text-primary me-1"></i> Dedicated support and maintenance team</p>
                                    </div>
                                </div>
                                <div class="col-lg-5 d-flex align-items-center">
                                    <a href="<?= urlof('./pages/Template pages/about');?>" class="btn btn-primary rounded py-3 px-5">More About Us</a>
                                </div>
                                <div class="col-lg-7">
                                    <div class="d-flex align-items-center">
                                        <img src="<?=urlof('assets/img/IMG_20250217_183850881_HDR_PORTRAIT.jpg')?>" class="img-fluid rounded-circle border border-4 border-secondary" style="width: 100px; height: 100px;" alt="Image">
                                        <div class="ms-4">
                                            <h4>Chavda Parth</h4>
                                            <p class="mb-0">Car-Rent Founder</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 wow fadeInRight" data-wow-delay="0.2s">
                        <div class="about-img">
                            <div class="img-1">
                                <img src="<?=urlof('assets/img/about-img.jpg')?>" class="img-fluid rounded h-100 w-100" alt="">
                            </div>
                            <div class="img-2">
                                <img src="<?=urlof('assets/img/about-img-1.jpg')?>" class="img-fluid rounded w-100" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->

        <!-- Fact Counter -->
        <div class="container-fluid counter py-5">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="counter-item text-center">
                            <div class="counter-item-icon mx-auto">
                                <i class="fas fa-thumbs-up fa-2x"></i>
                            </div>
                            <div class="counter-counting my-3">
                                <span class="text-white fs-2 fw-bold" data-toggle="counter-up">829</span>
                                <span class="h1 fw-bold text-white">+</span>
                            </div>
                            <h4 class="text-white mb-0">Happy Clients</h4>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="counter-item text-center">
                            <div class="counter-item-icon mx-auto">
                                <i class="fas fa-car-alt fa-2x"></i>
                            </div>
                            <div class="counter-counting my-3">
                                <span class="text-white fs-2 fw-bold" data-toggle="counter-up">56</span>
                                <span class="h1 fw-bold text-white">+</span>
                            </div>
                            <h4 class="text-white mb-0">Number of Cars</h4>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="counter-item text-center">
                            <div class="counter-item-icon mx-auto">
                                <i class="fas fa-building fa-2x"></i>
                            </div>
                            <div class="counter-counting my-3">
                                <span class="text-white fs-2 fw-bold" data-toggle="counter-up">127</span>
                                <span class="h1 fw-bold text-white">+</span>
                            </div>
                            <h4 class="text-white mb-0">Car Center</h4>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.7s">
                        <div class="counter-item text-center">
                            <div class="counter-item-icon mx-auto">
                                <i class="fas fa-clock fa-2x"></i>
                            </div>
                            <div class="counter-counting my-3">
                                <span class="text-white fs-2 fw-bold" data-toggle="counter-up">589</span>
                                <span class="h1 fw-bold text-white">+</span>
                            </div>
                            <h4 class="text-white mb-0">Total kilometers</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fact Counter -->

        <!-- Features Start -->
        <div class="container-fluid feature py-5">
            <div class="container py-5">
                <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 800px;">
                    <h1 class="display-5 text-capitalize mb-3">Cental <span class="text-primary">Features</span></h1>
                    <p class="mb-0">Explore why thousands of customers trust Car-Rent for their transportation needs. We offer premium services, unmatched convenience, and total peace of mind—anytime, anywhere.
                    </p>
                </div>
                <div class="row g-4 align-items-center">
                    <div class="col-xl-4">
                        <div class="row gy-4 gx-0">
                            <div class="col-12 wow fadeInUp" data-wow-delay="0.1s">
                                <div class="feature-item">
                                    <div class="feature-icon">
                                        <span class="fa fa-trophy fa-2x"></span>
                                    </div>
                                    <div class="ms-4">
                                        <h5 class="mb-3">First Class services</h5>
                                        <p class="mb-0">From booking to return, we ensure a seamless and luxurious rental experience with top-notch customer support.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 wow fadeInUp" data-wow-delay="0.3s">
                                <div class="feature-item">
                                    <div class="feature-icon">
                                        <span class="fa fa-road fa-2x"></span>
                                    </div>
                                    <div class="ms-4">
                                        <h5 class="mb-3">24/7 road assistance</h5>
                                        <p class="mb-0">Drive worry-free with our round-the-clock emergency assistance, available wherever you go.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-xl-4 wow fadeInUp" data-wow-delay="0.2s">
                        <img src="<?=urlof('assets/img/features-img.png')?>" class="img-fluid w-100" style="object-fit: cover;" alt="Img">
                    </div>
                    <div class="col-xl-4">
                        <div class="row gy-4 gx-0">
                            <div class="col-12 wow fadeInUp" data-wow-delay="0.1s">
                                <div class="feature-item justify-content-end">
                                    <div class="text-end me-4">
                                        <h5 class="mb-3">Affordable Quality</h5>
                                        <p class="mb-0">Enjoy reliable, well-maintained vehicles at the best prices—no compromises on quality.</p>
                                    </div>
                                    <div class="feature-icon">
                                        <span class="fa fa-tag fa-2x"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 wow fadeInUp" data-wow-delay="0.3s">
                                <div class="feature-item justify-content-end">
                                    <div class="text-end me-4">
                                        <h5 class="mb-3">Free Pick-Up & Drop-Off</h5>
                                        <p class="mb-0">We offer complimentary vehicle delivery and return services to your desired location for maximum convenience.</p>
                                    </div>
                                    <div class="feature-icon">
                                        <span class="fa fa-map-pin fa-2x"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Features End -->

        <!-- Car Steps Start -->
        <div class="container-fluid steps py-5">
            <div class="container py-5">
                <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 800px;">
                    <h1 class="display-5 text-capitalize text-white mb-3">Cental<span class="text-primary"> Process</span></h1>
                    <p class="mb-0 text-white">Renting a car with us is quick and hassle-free. Follow these three simple steps to get on the road with comfort and confidence.
                    </p>
                </div>
                <div class="row g-4">
                    <div class="col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="steps-item p-4 mb-4">
                            <h4>Come In Contact</h4>
                            <p class="mb-0">Reach out via phone, website, or in-person visit to check availability, get answers, and begin your booking.</p>
                            <div class="setps-number">01.</div>
                        </div>
                    </div>
                    <div class="col-lg-4 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="steps-item p-4 mb-4">
                            <h4>Choose A Car</h4>
                            <p class="mb-0">Pick a vehicle that suits your style, needs, and budget from our wide range of trusted models.</p>
                            <div class="setps-number">02.</div>
                        </div>
                    </div>
                    <div class="col-lg-4 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="steps-item p-4 mb-4">
                            <h4>Enjoy Driving</h4>
                            <p class="mb-0">Collect your keys, hit the road, and enjoy your journey. We've taken care of the rest.</p>
                            <div class="setps-number">03.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Car Steps End -->

        <!-- Team Start -->
        <div class="container-fluid team py-5">
            <div class="container py-5">
                <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 800px;">
                    <h1 class="display-5 text-capitalize mb-3">Customer<span class="text-primary"> Support</span> Center</h1>
                    <p class="mb-0">Meet our dedicated support team, available to assist you with every step of your rental journey. Friendly, knowledgeable, and always ready to help.
                    </p>
                </div>
                <div class="row g-4">
                    <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="team-item p-4 pt-0">
                            <div class="team-img">
                                <img src="<?=urlof('assets/img/team-1.jpg')?>" class="img-fluid rounded w-100" alt="Image">
                            </div>
                            <div class="team-content pt-4">
                                <h4>MARTIN COOPER</h4>
                                <p>Senior Customer Executive</p>
                                <div class="team-icon d-flex justify-content-center">
                                    <a class="btn btn-square btn-light rounded-circle mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-square btn-light rounded-circle mx-1" href=""><i class="fab fa-twitter"></i></a>
                                    <a class="btn btn-square btn-light rounded-circle mx-1" href=""><i class="fab fa-instagram"></i></a>
                                    <a class="btn btn-square btn-light rounded-circle mx-1" href=""><i class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="team-item p-4 pt-0">
                            <div class="team-img">
                                <img src="<?=urlof('assets/img/team-2.jpg')?>" class="img-fluid rounded w-100" alt="Image">
                            </div>
                            <div class="team-content pt-4">
                                <h4>MARTIN LUOIS</h4>
                                <p>Live Chat Specialist</p>
                                <div class="team-icon d-flex justify-content-center">
                                    <a class="btn btn-square btn-light rounded-circle mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-square btn-light rounded-circle mx-1" href=""><i class="fab fa-twitter"></i></a>
                                    <a class="btn btn-square btn-light rounded-circle mx-1" href=""><i class="fab fa-instagram"></i></a>
                                    <a class="btn btn-square btn-light rounded-circle mx-1" href=""><i class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="team-item p-4 pt-0">
                            <div class="team-img">
                                <img src="<?=urlof('assets/img/team-3.jpg')?>" class="img-fluid rounded w-100" alt="Image">
                            </div>
                            <div class="team-content pt-4">
                                <h4>James Carter</h4>
                                <p>Phone Support Lead</p>
                                <div class="team-icon d-flex justify-content-center">
                                    <a class="btn btn-square btn-light rounded-circle mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-square btn-light rounded-circle mx-1" href=""><i class="fab fa-twitter"></i></a>
                                    <a class="btn btn-square btn-light rounded-circle mx-1" href=""><i class="fab fa-instagram"></i></a>
                                    <a class="btn btn-square btn-light rounded-circle mx-1" href=""><i class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.7s">
                        <div class="team-item p-4 pt-0">
                            <div class="team-img">
                                <img src="<?=urlof('assets/img/team-4.jpg')?>" class="img-fluid rounded w-100" alt="Image">
                            </div>
                            <div class="team-content pt-4">
                                <h4>TONY STARk</h4>
                                <p>Booking & Complaints Officer</p>
                                <div class="team-icon d-flex justify-content-center">
                                    <a class="btn btn-square btn-light rounded-circle mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-square btn-light rounded-circle mx-1" href=""><i class="fab fa-twitter"></i></a>
                                    <a class="btn btn-square btn-light rounded-circle mx-1" href=""><i class="fab fa-instagram"></i></a>
                                    <a class="btn btn-square btn-light rounded-circle mx-1" href=""><i class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Team End -->

        <!-- Banner Start -->
        <div class="container-fluid banner pb-5 wow zoomInDown" data-wow-delay="0.1s">
            <div class="container pb-5">
                <div class="banner-item rounded">
                    <img src="<?=urlof('assets/img/banner-1.jpg')?>" class="img-fluid rounded w-100" alt="">
                    <div class="banner-content">
                        <h2 class="text-primary">Rent Your Car</h2>
                        <h1 class="text-white">Interested in Renting?</h1>
                        <p class="text-white">Don't hesitate and send us a message.</p>
                        <div class="banner-btn">
                            <a href="#" class="btn btn-secondary rounded-pill py-3 px-4 px-md-5 me-2">WhatchApp</a>
                            <a href = "<?= urlof('./pages/Template pages/contact');?>" class="btn btn-primary rounded-pill py-3 px-4 px-md-5 ms-2">Contact Us</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Banner End -->


        <?php
        include pathof('include/footer.php');
        ?>




        <!-- Back to Top -->
        <a href="#" class="btn btn-secondary btn-lg-square rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>   

     
        <?php
        include pathof('include/script.php');
        include pathof('include/closing tag.php');
        ?>
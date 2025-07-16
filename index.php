<?php
require './include/init.php';

if (!isset($_SESSION['booking_tokens'])) {
    $_SESSION['booking_tokens'] = [];  // first visit
}

/** Return a brand‑new token and remember it in the pool */
function new_booking_token(): string
{
    $tok = bin2hex(random_bytes(16));          // 32‑char hex, cryptographically strong
    $_SESSION['booking_tokens'][$tok] = time();
    return $tok;
}

/* helper for later housekeeping (optional) */
function purge_expired_booking_tokens(int $maxAge = 900): void
{
    $cut = time() - $maxAge;
    foreach ($_SESSION['booking_tokens'] as $t => $issued) {
        if ($issued < $cut) unset($_SESSION['booking_tokens'][$t]);
    }
}
include pathof('include/header.php');
include pathof('include/nav.php');

$q = "SELECT * FROM `car`";

$stmt = $conn->prepare($q);
$stmt->execute();

$row = $stmt->fetchAll(PDO::FETCH_ASSOC)
?>

<!-- Carousel Start -->
<div class="header-carousel">
    <div id="carouselId" class="carousel slide" data-bs-ride="carousel" data-bs-interval="false">
        <ol class="carousel-indicators">
            <li data-bs-target="#carouselId" data-bs-slide-to="0" class="active" aria-current="true" aria-label="First slide"></li>
            <li data-bs-target="#carouselId" data-bs-slide-to="1" aria-label="Second slide"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
                <img src="<?= urlof('assets/img/carousel-2.jpg') ?>" class="img-fluid w-100" alt="First slide" />
                <div class="carousel-caption">
                    <div class="container py-4">
                        <div class="row g-5">
                            <div class="col-lg-6 fadeInLeft animated" data-animation="fadeInLeft" data-delay="1s" style="animation-delay: 1s;">
                                <div class="bg-secondary rounded p-5">
                                    <h4 class="text-white mb-4">CONTINUE CAR RESERVATION</h4>
                                    <form>
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <select class="form-select" aria-label="Default select example">
                                                    <option value="" disabled selected hidden>Select Car</option>
                                                    <?php
                                                    if (count($row) > 0) {
                                                        foreach ($row as $r) {
                                                    ?>
                                                            <option value="<?= $r['id'] ?>"><?= $r['name'] ?></option>
                                                        <?php
                                                        }
                                                    } else {
                                                        ?><option value="">No Records</option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <div class="input-group">
                                                    <div class="d-flex align-items-center bg-light text-body rounded-start p-2">
                                                        <span class="fas fa-map-marker-alt"></span> <span class="ms-1">Pick Up</span>
                                                    </div>
                                                    <input class="form-control" type="text" placeholder="Enter a City or Airport" aria-label="Enter a City or Airport">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <a href="#" class="text-start text-white d-block mb-2">Need a different drop-off location?</a>
                                                <div class="input-group">
                                                    <div class="d-flex align-items-center bg-light text-body rounded-start p-2">
                                                        <span class="fas fa-map-marker-alt"></span><span class="ms-1">Drop off</span>
                                                    </div>
                                                    <input class="form-control" type="text" placeholder="Enter a City or Airport" aria-label="Enter a City or Airport">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="input-group">
                                                    <div class="d-flex align-items-center bg-light text-body rounded-start p-2">
                                                        <span class="fas fa-calendar-alt"></span><span class="ms-1">Pick Up</span>
                                                    </div>
                                                    <input class="form-control" type="date">
                                                    <select class="form-select ms-3" aria-label="Default select example">
                                                        <option selected>12:00AM</option>
                                                        <option value="1">1:00AM</option>
                                                        <option value="2">2:00AM</option>
                                                        <option value="3">3:00AM</option>
                                                        <option value="4">4:00AM</option>
                                                        <option value="5">5:00AM</option>
                                                        <option value="6">6:00AM</option>
                                                        <option value="7">7:00AM</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="input-group">
                                                    <div class="d-flex align-items-center bg-light text-body rounded-start p-2">
                                                        <span class="fas fa-calendar-alt"></span><span class="ms-1">Drop off</span>
                                                    </div>
                                                    <input class="form-control" type="date">
                                                    <select class="form-select ms-3" aria-label="Default select example">
                                                        <option selected>12:00AM</option>
                                                        <option value="1">1:00AM</option>
                                                        <option value="2">2:00AM</option>
                                                        <option value="3">3:00AM</option>
                                                        <option value="4">4:00AM</option>
                                                        <option value="5">5:00AM</option>
                                                        <option value="6">6:00AM</option>
                                                        <option value="7">7:00AM</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <a class="btn btn-light w-100 py-2" href="#ourcars">Book Now</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-lg-6 d-none d-lg-flex fadeInRight animated" data-animation="fadeInRight" data-delay="1s" style="animation-delay: 1s;">
                                <div class="text-start">
                                    <h1 class="display-5 text-white">Get 15% off your rental Plan your trip now</h1>
                                    <p>Treat yourself in INDIA</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img src="<?= urlof('assets/img/carousel-1.jpg') ?>" class="img-fluid w-100" alt="First slide" />
                <div class="carousel-caption">
                    <div class="container py-4">
                        <div class="row g-5">
                            <div class="col-lg-6 fadeInLeft animated" data-animation="fadeInLeft" data-delay="1s" style="animation-delay: 1s;">
                                <div class="bg-secondary rounded p-5">
                                    <h4 class="text-white mb-4">CONTINUE CAR RESERVATION</h4>
                                    <form>
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <select class="form-select" aria-label="Default select example">
                                                    <option value="" disabled selected hidden>Select Car</option>
                                                    <?php
                                                    if (count($row) > 0) {
                                                        foreach ($row as $r) {
                                                    ?>
                                                            <option value="<?= $r['id'] ?>"><?= $r['name'] ?></option>
                                                        <?php
                                                        }
                                                    } else {
                                                        ?><option value="">No Records</option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <div class="input-group">
                                                    <div class="d-flex align-items-center bg-light text-body rounded-start p-2">
                                                        <span class="fas fa-map-marker-alt"></span><span class="ms-1">Pick Up</span>
                                                    </div>
                                                    <input class="form-control" type="text" placeholder="Enter a City or Airport" aria-label="Enter a City or Airport">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <a href="#" class="text-start text-white d-block mb-2">Need a different drop-off location?</a>
                                                <div class="input-group">
                                                    <div class="d-flex align-items-center bg-light text-body rounded-start p-2">
                                                        <span class="fas fa-map-marker-alt"></span><span class="ms-1">Drop off</span>
                                                    </div>
                                                    <input class="form-control" type="text" placeholder="Enter a City or Airport" aria-label="Enter a City or Airport">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="input-group">
                                                    <div class="d-flex align-items-center bg-light text-body rounded-start p-2">
                                                        <span class="fas fa-calendar-alt"></span><span class="ms-1">Pick Up</span>
                                                    </div>
                                                    <input class="form-control" type="date">
                                                    <select class="form-select ms-3" aria-label="Default select example">
                                                        <option selected>12:00AM</option>
                                                        <option value="1">1:00AM</option>
                                                        <option value="2">2:00AM</option>
                                                        <option value="3">3:00AM</option>
                                                        <option value="4">4:00AM</option>
                                                        <option value="5">5:00AM</option>
                                                        <option value="6">6:00AM</option>
                                                        <option value="7">7:00AM</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="input-group">
                                                    <div class="d-flex align-items-center bg-light text-body rounded-start p-2">
                                                        <span class="fas fa-calendar-alt"></span><span class="ms-1">Drop off</span>
                                                    </div>
                                                    <input class="form-control" type="date">
                                                    <select class="form-select ms-3" aria-label="Default select example">
                                                        <option selected>12:00AM</option>
                                                        <option value="1">1:00AM</option>
                                                        <option value="2">2:00AM</option>
                                                        <option value="3">3:00AM</option>
                                                        <option value="4">4:00AM</option>
                                                        <option value="5">5:00AM</option>
                                                        <option value="6">6:00AM</option>
                                                        <option value="7">7:00AM</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <a class="btn btn-light w-100 py-2" href="#ourcars">Book Now</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-lg-6 d-none d-lg-flex fadeInRight animated" data-animation="fadeInRight" data-delay="1s" style="animation-delay: 1s;">
                                <div class="text-start">
                                    <h1 class="display-5 text-white">Get 15% off your rental! Choose Your Model </h1>
                                    <p>Treat yourself in INDIA</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Carousel End -->

<!-- Features Start -->
<div class="container-fluid feature py-5">
    <div class="container py-5">
        <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 800px;">
            <h1 class="display-5 text-capitalize mb-3">Cental <span class="text-primary">Features</span></h1>
            <p class="mb-0"> Explore why thousands of customers trust Car-Rent for their transportation needs. We offer premium services, unmatched convenience, and total peace of mind—anytime, anywhere.
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
                                <p class="mb-0"> Drive worry-free with our round-the-clock emergency assistance, available wherever you go.
                                </p>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-xl-4 wow fadeInUp" data-wow-delay="0.2s">
                <img src="<?= urlof('assets/img/features-img.png') ?>" class="img-fluid w-100" style="object-fit: cover;" alt="Img">
            </div>
            <div class="col-xl-4">
                <div class="row gy-4 gx-0">
                    <div class="col-12 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="feature-item justify-content-end">
                            <div class="text-end me-4">
                                <h5 class="mb-3">Affordable Quality</h5>
                                <p class="mb-0"> Enjoy reliable, well-maintained vehicles at the best prices—no compromises on quality.</p>
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
                                <p class="mb-0"> We offer complimentary vehicle delivery and return services to your desired location for maximum convenience.</p>
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
                                    <img src="<?= urlof('assets/img/about-icon-1.png') ?>" class="img-fluid w-50 h-50" alt="Icon">
                                </div>
                                <h5 class="mb-3">Our Vision</h5>
                                <p class="mb-0">To become the most trusted and preferred car rental platform by offering innovative, reliable, and user-friendly services for every journey.</p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="about-item-inner border p-4">
                                <div class="about-icon mb-4">
                                    <img src="<?= urlof('assets/img/about-icon-2.png') ?>" class="img-fluid h-50 w-50" alt="Icon">
                                </div>
                                <h5 class="mb-3">Our Mision</h5>
                                <p class="mb-0"> To provide safe, affordable, and high-quality car rental services through a seamless digital experience and a commitment to customer care.</p>
                            </div>
                        </div>
                    </div>
                    <p class="text-item my-4"> Whether you're traveling for business, leisure, or everyday needs, Car-Rent ensures your ride is smooth, secure, and perfectly suited to your preferences. With flexible options and transparent pricing, you stay in control from start to finish.
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
                            <a href="<?= urlof('./pages/Template pages/about'); ?>" class="btn btn-primary rounded py-3 px-5">More About Us</a>
                        </div>
                        <div class="col-lg-7">
                            <div class="d-flex align-items-center">
                                <img src="<?= urlof('assets/img/IMG_20250217_183850881_HDR_PORTRAIT.jpg') ?>" class="img-fluid rounded-circle border border-4 border-secondary" style="width: 100px; height: 100px;" alt="Image">
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
                        <img src="<?= urlof('assets/img/about-img.jpg') ?>" class="img-fluid rounded h-100 w-100" alt="">
                    </div>
                    <div class="img-2">
                        <img src="<?= urlof('assets/img/about-img-1.jpg') ?>" class="img-fluid rounded w-100" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- About End -->

<!-- Fact Counter -->
<div class="container-fluid counter bg-secondary py-5">
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

<!-- Services Start -->
<div class="container-fluid service py-5">
    <div class="container py-5">
        <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 800px;">
            <h1 class="display-5 text-capitalize mb-3">Cental <span class="text-primary">Services</span></h1>
            <p class="mb-0"> We offer a wide range of services to make your car rental experience smooth, flexible, and convenient—from quick bookings to cross-city travel, and everything in between.
            </p>
        </div>
        <div class="row g-4">
            <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                <div class="service-item p-4">
                    <div class="service-icon mb-4">
                        <i class="fa fa-phone-alt fa-2x"></i>
                    </div>
                    <h5 class="mb-3">Phone Reservation</h5>
                    <p class="mb-0">Prefer a personal touch? Call us anytime to book your ride quickly and easily with the help of our friendly support team.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.3s">
                <div class="service-item p-4">
                    <div class="service-icon mb-4">
                        <i class="fa fa-money-bill-alt fa-2x"></i>
                    </div>
                    <h5 class="mb-3">Special Rates</h5>
                    <p class="mb-0">Enjoy exclusive deals for long-term rentals, corporate bookings, and seasonal discounts—all with transparent pricing.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.5s">
                <div class="service-item p-4">
                    <div class="service-icon mb-4">
                        <i class="fa fa-road fa-2x"></i>
                    </div>
                    <h5 class="mb-3">One Way Rental</h5>
                    <p class="mb-0">Need to drop off your car in a different city? Our one-way rental service gives you total flexibility across routes.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                <div class="service-item p-4">
                    <div class="service-icon mb-4">
                        <i class="fa fa-umbrella fa-2x"></i>
                    </div>
                    <h5 class="mb-3">Insurance Option</h5>
                    <p class="mb-0">Drive with peace of mind. We offer a range of insurance coverage options to keep you and your rental protected.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.3s">
                <div class="service-item p-4">
                    <div class="service-icon mb-4">
                        <i class="fa fa-building fa-2x"></i>
                    </div>
                    <h5 class="mb-3">City to City</h5>
                    <p class="mb-0">Travel seamlessly between cities with our intercity rental service—ideal for business trips or spontaneous getaways.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.5s">
                <div class="service-item p-4">
                    <div class="service-icon mb-4">
                        <i class="fa fa-car-alt fa-2x"></i>
                    </div>
                    <h5 class="mb-3">Free Rides</h5>
                    <p class="mb-0">Take advantage of promotions that include free ride credits, especially for first-time users and referrals.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Services End -->

<!-- Car categories Start -->
<div class="container-fluid categories pb-5">
    <div class="container pb-5">
        <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 800px;">
            <h1 class="display-5 text-capitalize mb-3">Vehicle <span class="text-primary">Categories</span></h1>
            <p class="mb-0">Browse our diverse fleet—from compact city cars to spacious SUVs and premium sedans. Every vehicle is thoroughly inspected, regularly serviced, and ready for your next adventure or business trip.
            </p>
        </div>
        <div class="categories-carousel owl-carousel wow fadeInUp" id="ourcars" data-wow-delay="0.1s">
            <?php
            if (count($row) > 0) {
                foreach ($row as $r) {
            ?>
                    <div class="categories-item p-4">
                        <div class="categories-item-inner">
                            <div class="categories-img rounded-top">
                                <img src="<?= urlof('assets/upload_img/') . $r['ImageFile'] ?>" class="img-fluid w-100 rounded-top" alt="">
                            </div>
                            <div class="categories-content rounded-bottom p-4">
                                <h4><?= $r['name']; ?></h4>
                                <div class="categories-review mb-4">
                                    <div class="me-3"><?= $r['review']; ?> Review</div>
                                    <div class="d-flex justify-content-center text-secondary">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star text-body"></i>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <h4 class="bg-white text-primary rounded-pill py-2 px-4 mb-0">$<?= $r['price']; ?>:00/Day</h4>
                                </div>
                                <div class="row gy-2 gx-0 text-center mb-4">
                                    <div class="col-4 border-end border-white">
                                        <i class="fa fa-users text-dark"></i> <span class="text-body ms-1"><?= $r['space']; ?> Seat</span>
                                    </div>
                                    <div class="col-4">
                                        <i class="fa fa-gas-pump text-dark"></i> <span class="text-body ms-1"><?= $r['gas']; ?></span>
                                    </div>
                                    <div class="col-4 border-end border-white">
                                        <i class="fa fa-car text-dark"></i> <span class="text-body ms-1"><?= $r['year']; ?></span>
                                    </div>
                                    <div class="col-4 border-end border-white">
                                        <i class="fa fa-cogs text-dark"></i> <span class="text-body ms-1">AUTO</span>
                                    </div>
                                </div>
                                <?php $tok = new_booking_token(); ?>
                                <a class="btn btn-light w-100 py-2" href="<?= urlof('./pages/Booking/index') . '?car=' . $r['id'] . '&tok=' . $tok ?>">Book Now</a>
                            </div>
                        </div>
                    </div>
                <?php
                }; ?>
            <?php  } else {
            ?><p>No record</p><?php
                            }
                                ?>
        </div>
    </div>
</div>
<!-- Car categories End -->

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

<!-- Blog Start -->
<div class="container-fluid blog py-5">
    <div class="container py-5">
        <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 800px;">
            <h1 class="display-5 text-capitalize mb-3">Cental<span class="text-primary"> Blog & News</span></h1>
            <p class="mb-0">Stay updated with the latest car rental tips, travel trends, and news from the road. Our blog keeps you informed and inspired for every journey.
            </p>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                <div class="blog-item">
                    <div class="blog-img">
                        <img src="<?= urlof('assets/img/blog-1.jpg') ?>" class="img-fluid rounded-top w-100" alt="Image">
                    </div>
                    <div class="blog-content rounded-bottom p-4">
                        <div class="blog-date">30 Dec 2025</div>
                        <div class="blog-comment my-3">
                            <div class="small"><span class="fa fa-user text-primary"></span><span class="ms-2">Martin.C</span></div>
                            <div class="small"><span class="fa fa-comment-alt text-primary"></span><span class="ms-2">6 Comments</span></div>
                        </div>
                        <a href="#" class="h4 d-block mb-3">Rental Cars how to check driving fines?</a>
                        <p class="mb-3">Discover how to verify any pending traffic fines before renting a car to avoid surprises during your trip.</p>
                        <a href="<?= urlof('./pages/Template pages/blog'); ?>" class="">Read More <i class="fa fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 wow fadeInUp" data-wow-delay="0.3s">
                <div class="blog-item">
                    <div class="blog-img">
                        <img src="<?= urlof('assets/img/blog-2.jpg') ?>" class="img-fluid rounded-top w-100" alt="Image">
                    </div>
                    <div class="blog-content rounded-bottom p-4">
                        <div class="blog-date">25 Dec 2025</div>
                        <div class="blog-comment my-3">
                            <div class="small"><span class="fa fa-user text-primary"></span><span class="ms-2">Martin.C</span></div>
                            <div class="small"><span class="fa fa-comment-alt text-primary"></span><span class="ms-2">6 Comments</span></div>
                        </div>
                        <a href="#" class="h4 d-block mb-3">Rental Costs: Sports vs. Standard Cars</a>
                        <p class="mb-3">Curious about the price difference between luxury sports cars and everyday vehicles? Here’s what you need to know.</p>
                        <a href="<?= urlof('./pages/Template pages/blog'); ?>" class="">Read More <i class="fa fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 wow fadeInUp" data-wow-delay="0.5s">
                <div class="blog-item">
                    <div class="blog-img">
                        <img src="<?= urlof('assets/img/blog-3.jpg') ?>" class="img-fluid rounded-top w-100" alt="Image">
                    </div>
                    <div class="blog-content rounded-bottom p-4">
                        <div class="blog-date">27 Dec 2025</div>
                        <div class="blog-comment my-3">
                            <div class="small"><span class="fa fa-user text-primary"></span><span class="ms-2">Martin.C</span></div>
                            <div class="small"><span class="fa fa-comment-alt text-primary"></span><span class="ms-2">6 Comments</span></div>
                        </div>
                        <a href="#" class="h4 d-block mb-3">Document required for car rental</a>
                        <p class="mb-3">Before hitting the road, make sure you have the right documents. This guide breaks down exactly what you’ll need.</p>
                        <a href="<?= urlof('./pages/Template pages/blog'); ?>" class="">Read More <i class="fa fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Blog End -->

<!-- Banner Start -->
<div class="container-fluid banner pb-5 wow zoomInDown" data-wow-delay="0.1s">
    <div class="container pb-5">
        <div class="banner-item rounded">
            <img src="<?= urlof('assets/img/banner-1.jpg') ?>" class="img-fluid rounded w-100" alt="">
            <div class="banner-content">
                <h2 class="text-primary">Rent Your Car</h2>
                <h1 class="text-white">Interested in Renting?</h1>
                <p class="text-white">Don't hesitate and send us a message.</p>
                <div class="banner-btn">
                    <a href="#" class="btn btn-secondary rounded-pill py-3 px-4 px-md-5 me-2">WhatchApp</a>
                    <a href="<?= urlof('./pages/Template pages/contact'); ?>" class="btn btn-primary rounded-pill py-3 px-4 px-md-5 ms-2">Contact Us</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Banner End -->

<!-- Team Start -->
<div class="container-fluid team pb-5">
    <div class="container pb-5">
        <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 800px;">
            <h1 class="display-5 text-capitalize mb-3">Customer<span class="text-primary"> Support</span> Center</h1>
            <p class="mb-0">Meet our dedicated support team, available to assist you with every step of your rental journey. Friendly, knowledgeable, and always ready to help.
            </p>
        </div>
        <div class="row g-4">
            <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.1s">
                <div class="team-item p-4 pt-0">
                    <div class="team-img">
                        <img src="<?= urlof('assets/img/team-1.jpg') ?>" class="img-fluid rounded w-100" alt="Image">
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
                        <img src="<?= urlof('assets/img/team-2.jpg') ?>" class="img-fluid rounded w-100" alt="Image">
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
                        <img src="<?= urlof('assets/img/team-3.jpg') ?>" class="img-fluid rounded w-100" alt="Image">
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
                        <img src="<?= urlof('assets/img/team-4.jpg') ?>" class="img-fluid rounded w-100" alt="Image">
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

<!-- Testimonial Start -->
<div class="container-fluid testimonial pb-5">
    <div class="container pb-5">
        <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 800px;">
            <h1 class="display-5 text-capitalize mb-3">Our Clients<span class="text-primary"> Reviews</span></h1>
            <p class="mb-0">Hear what our happy customers have to say about their experience with our car rental service. We value your trust and satisfaction.
            </p>
        </div>
        <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
            <div class="testimonial-item">
                <div class="testimonial-quote"><i class="fa fa-quote-right fa-2x"></i>
                </div>
                <div class="testimonial-inner p-4">
                    <img src="<?= urlof('assets/img/testimonial-1.jpg') ?>" class="img-fluid" alt="">
                    <div class="ms-4">
                        <h4>Priya Sharma</h4>
                        <p>Travel Blogger</p>
                        <div class="d-flex text-primary">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star text-body"></i>
                        </div>
                    </div>
                </div>
                <div class="border-top rounded-bottom p-4">
                    <p class="mb-0">The car was in excellent condition and the booking process was super smooth. Customer service was responsive and friendly. Highly recommend!</p>
                </div>
            </div>
            <div class="testimonial-item">
                <div class="testimonial-quote"><i class="fa fa-quote-right fa-2x"></i>
                </div>
                <div class="testimonial-inner p-4">
                    <img src="<?= urlof('assets/img/testimonial-2.jpg') ?>" class="img-fluid" alt="">
                    <div class="ms-4">
                        <h4>Sunita Verma</h4>
                        <p>IT Professional</p>
                        <div class="d-flex text-primary">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star text-body"></i>
                            <i class="fas fa-star text-body"></i>
                        </div>
                    </div>
                </div>
                <div class="border-top rounded-bottom p-4">
                    <p class="mb-0">Great pricing and punctual delivery. I used their service for a weekend trip and it made the whole journey convenient and stress-free.</p>
                </div>
            </div>
            <div class="testimonial-item">
                <div class="testimonial-quote"><i class="fa fa-quote-right fa-2x"></i>
                </div>
                <div class="testimonial-inner p-4">
                    <img src="<?= urlof('assets/img/testimonial-3.jpg') ?>" class="img-fluid" alt="">
                    <div class="ms-4">
                        <h4>Rahul Mehta</h4>
                        <p>Freelance Designer</p>
                        <div class="d-flex text-primary">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star text-body"></i>
                            <i class="fas fa-star text-body"></i>
                            <i class="fas fa-star text-body"></i>
                        </div>
                    </div>
                </div>
                <div class="border-top rounded-bottom p-4">
                    <p class="mb-0">While the overall experience was good, the pickup took a bit longer than expected. But the team resolved it quickly and the car was clean.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Testimonial End -->

<!-- Terms & Conditions Start -->
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold text-capitalize">Terms & <span class="text-primary">Conditions</span></h1>
        <p class="lead text-muted">Kindly review our policies before using our services.</p>
        <div class="divider mx-auto my-4" style="width: 60px; height: 4px; background-color: var(--clr-primary);"></div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="accordion" id="termsAccordion">

                <!-- Section 1 -->
                <div class="accordion-item mb-3">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            1. Rental Agreement
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#termsAccordion">
                        <div class="accordion-body">
                            By renting a vehicle, you agree to all terms set forth herein and in any supporting documentation provided during booking.
                        </div>
                    </div>
                </div>

                <!-- Section 2 -->
                <div class="accordion-item mb-3">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            2. Age & License Requirements
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#termsAccordion">
                        <div class="accordion-body">
                            Renters must be 21+ with a valid driver's license for at least 1 year. International renters must present an International Driving Permit.
                        </div>
                    </div>
                </div>

                <!-- Section 3 -->
                <div class="accordion-item mb-3">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            3. Booking & Payment
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#termsAccordion">
                        <div class="accordion-body">
                            All bookings are confirmed with full/partial payment. Add-ons like GPS, child seats, and outstation permits may incur extra charges.
                        </div>
                    </div>
                </div>

                <!-- Section 4 -->
                <div class="accordion-item mb-3">
                    <h2 class="accordion-header" id="headingFour">
                        <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            4. Vehicle Condition
                        </button>
                    </h2>
                    <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#termsAccordion">
                        <div class="accordion-body">
                            Vehicles are delivered in clean and roadworthy condition. The customer is responsible for returning the car in the same condition. Any damage, excessive dirt, or loss of vehicle accessories may result in additional charges.
                        </div>
                    </div>
                </div>

                <!-- Section 5 -->
                <div class="accordion-item mb-3">
                    <h2 class="accordion-header" id="headingFive">
                        <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                            5. Fuel Policy
                        </button>
                    </h2>
                    <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#termsAccordion">
                        <div class="accordion-body">
                            Vehicles are provided with a full fuel tank and must be returned full. If not, fuel charges will be deducted from the deposit as per current fuel rates.
                        </div>
                    </div>
                </div>

                <!-- Section 6 -->
                <div class="accordion-item mb-3">
                    <h2 class="accordion-header" id="headingSix">
                        <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                            6. Insurance & Liability
                        </button>
                    </h2>
                    <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#termsAccordion">
                        <div class="accordion-body">
                            All vehicles are insured with basic third-party liability. The renter is responsible for any damage or theft that is not covered by insurance. Optional full coverage can be availed at an additional cost. </div>
                    </div>
                </div>

                <!-- Section 7 -->
                <div class="accordion-item mb-3">
                    <h2 class="accordion-header" id="headingSeven">
                        <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                            7. Cancellations & Refunds
                        </button>
                    </h2>
                    <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-bs-parent="#termsAccordion">
                        <div class="accordion-body">
                            Cancellations made more than 24 hours before the rental start time are eligible for a full refund. No refunds will be provided for cancellations made within 24 hours of the pickup time. </div>
                    </div>
                </div>

                <!-- Section 8 -->
                <div class="accordion-item mb-3">
                    <h2 class="accordion-header" id="headingEight">
                        <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                            8. Traffic Violations
                        </button>
                    </h2>
                    <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight" data-bs-parent="#termsAccordion">
                        <div class="accordion-body">
                            The renter is responsible for any traffic fines, penalties, or legal violations incurred during the rental period. </div>
                    </div>
                </div>

                <!-- Section 9 -->
                <div class="accordion-item mb-3">
                    <h2 class="accordion-header" id="headingNine">
                        <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                            9. Prohibited Uses
                        </button>
                    </h2>
                    <div id="collapseNine" class="accordion-collapse collapse" aria-labelledby="headingNine" data-bs-parent="#termsAccordion">
                        <div class="accordion-body">
                            The rented vehicle must not be used for illegal activities, racing, towing, or driving under the influence of alcohol or drugs. Violation will result in contract termination without refund.
                        </div>
                    </div>
                </div>

                <div class="accordion-item mb-3">
                    <h2 class="accordion-header" id="headingTen">
                        <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTen">
                            10. Governing Law
                        </button>
                    </h2>
                    <div id="collapseTen" class="accordion-collapse collapse" aria-labelledby="headingTen" data-bs-parent="#termsAccordion">
                        <div class="accordion-body">
                            These terms follow Indian law. Disputes shall be settled under the jurisdiction of our registered office.
                        </div>
                    </div>
                </div>

                <!-- Section 11 -->
                <div class="accordion-item mb-3">
                    <h2 class="accordion-header" id="headingEleven">
                        <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEleven" aria-expanded="false" aria-controls="collapseEleven">
                            11. Address Accuracy & Additional Charges
                        </button>
                    </h2>
                    <div id="collapseEleven" class="accordion-collapse collapse" aria-labelledby="headingEleven" data-bs-parent="#termsAccordion">
                        <div class="accordion-body">
                            It is the renter's responsibility to provide accurate and complete pickup and drop-off locations during the booking process. If the address provided is unclear, vague, or incorrect, the renter will bear full responsibility for any delays in pickup or delivery. Additionally, any detours, waiting time, or logistical adjustments caused by incomplete or incorrect addresses may result in additional charges.
                        </div>
                    </div>
                </div>

                <!-- Section 12 -->
                <div class="accordion-item mb-3">
                    <h2 class="accordion-header" id="headingTwelve">
                        <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwelve" aria-expanded="false" aria-controls="collapseTwelve">
                            12. Intercity Pickup or Drop-off
                        </button>
                    </h2>
                    <div id="collapseTwelve" class="accordion-collapse collapse" aria-labelledby="headingTwelve" data-bs-parent="#termsAccordion">
                        <div class="accordion-body">
                            If the pickup location and drop-off location are in <strong>different cities</strong>, additional charges will be applied to cover the cost of returning the vehicle to its original city. These charges will be calculated based on the distance and logistics required, and the renter agrees to pay these charges as part of the rental agreement.
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- Terms & Conditions End -->



<?php
include pathof('include/footer.php');
?>

<script>
    // 1. Cache the target element
    const target = document.getElementById('ourcars');

    // 2. Attach once to every “Book Now” button that points to #ourcars
    document.querySelectorAll('a[href="#ourcars"]').forEach(btn => {
        btn.addEventListener('click', e => {
            e.preventDefault(); // stop the hash from hitting the URL
            target.scrollIntoView({ // smooth‑scroll down
                behavior: 'smooth',
                block: 'start'
            });
            // 3. Optional: remove any hash the user might paste in manually
            if (history.replaceState) {
                history.replaceState(null, '', window.location.pathname + window.location.search);
            }
        });
    });
</script>


<!-- Back to Top -->
<a href="#" class="btn btn-secondary btn-lg-square rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>


<?php
include pathof('include/script.php');
include pathof('include/closing tag.php');
?>
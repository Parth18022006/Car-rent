<?php
require '../../include/init.php';

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

<!-- Header Start -->
<div class="container-fluid bg-breadcrumb">
    <div class="container text-center py-5" style="max-width: 900px;">
        <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">Our Cars</h4>
        <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
            <li class="breadcrumb-item"><a href="../../index">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-primary">Categories</li>
        </ol>
    </div>
</div>
<!-- Header End -->

<!-- Car categories Start -->
<div class="container-fluid categories py-5">
    <div class="container py-5">
        <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 800px;">
            <h1 class="display-5 text-capitalize mb-3">Vehicle <span class="text-primary">Categories</span></h1>
            <p class="mb-0">Browse our diverse fleet—from compact city cars to spacious SUVs and premium sedans. Every vehicle is thoroughly inspected, regularly serviced, and ready for your next adventure or business trip.
            </p>
        </div>
        <div class="categories-carousel owl-carousel wow fadeInUp" data-wow-delay="0.1s">
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
                                    <h4 class="bg-white text-primary rounded-pill py-2 px-4 mb-0">₹<?= $r['price']; ?>:00/Day</h4>
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

<!-- Banner Start -->
<div class="container-fluid banner py-5 wow zoomInDown" data-wow-delay="0.1s">
    <div class="container py-5">
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

<?php
include pathof('include/footer.php');
?>




<!-- Back to Top -->
<a href="#" class="btn btn-secondary btn-lg-square rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>


<?php
include pathof('include/script.php');
include pathof('include/closing tag.php');
?>
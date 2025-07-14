<?php

require '../../include/init.php';


/* ───── validate booking token ───── */
$tok = $_GET['tok'] ?? $_POST['tok'] ?? '';
$tokens  = $_SESSION['booking_tokens'] ?? [];
$issued  = $tokens[$tok] ?? null;
$maxAge  = 900;                       // 15 min, change if you like

if (!$issued || (time() - $issued) > $maxAge) {
    header('Location: ' . urlof('./index'));   // bad or expired token
    exit;
}

/* optional: one‑use ‑‑ uncomment next line to make token single‑use
   unset($_SESSION['booking_tokens'][$tok]);
*/

/* optional housekeeping */
foreach ($tokens as $t => $when) {
    if ((time() - $when) > $maxAge) unset($_SESSION['booking_tokens'][$t]);
}


$q = "SELECT * FROM `car`";

$stmt = $conn->prepare($q);
$stmt->execute();

$row = $stmt->fetchAll(PDO::FETCH_ASSOC);

$q1 = "SELECT * FROM `user`";

$stmt2 = $conn->prepare($q1);
$stmt2->execute();

$user = $stmt2->fetch(PDO::FETCH_ASSOC);

$email = $_SESSION['email'] ?? null;
$selectedCarId = $_GET['car'] ?? null;

$url = urlof('pages/User/login');
if (!isset($_SESSION['user'])) {
    header("Location: $url");
    exit;
}

include pathof('./include/header.php');
include pathof('./include/nav.php');
?>
<link rel="stylesheet" href="<?= urlof('./assets/css/booking.css'); ?>">
<style>
    /* black frame by default */
    #rprice {
        width: 100%;
        height: 56px;
        padding: 12px 15px;
        margin-bottom: 1.25rem;
        background: #fff !important;
        color: #000;
        font-size: 1rem;
        line-height: 1.5;
        border: 1px solid #000 !important;
        /* ← replaces the red */
        border-radius: var(--radius);
        box-shadow: none !important;
    }
</style>

<link rel="stylesheet" href="<?= urlof('./assets/css/booking.css'); ?>">
<form action="" method="post">
    <h4>CAR RESERVATION</h4>
    <div class="col-12">
        <input type="hidden" name="tok" value="<?= htmlspecialchars($tok) ?>">

        <select class="form-select custom-select" id="selectcar" name="car">
            <option value="" disabled <?= $selectedCarId ? '' : 'selected'; ?> hidden>
                Select Car
            </option>
            <?php foreach ($row as $r) : ?>
                <option value="<?= $r['id']; ?>" data-price="<?= $r['price']; ?>" <?= ($r['id'] == $selectedCarId) ? 'selected' : ''; ?>>
                    <?= $r['name']; ?>
                </option>
            <?php endforeach; ?>
        </select>

        <input type="text" name="rprice" id="rprice" class="form-control-plaintext mb-3" readonly>
        <input type="number" name="pnum" id="pnum" placeholder="Enter Mobile Number">
        <div style="text-align: center;"><small id="emsg1" style="color: red;"></small></div>
        <input type="text" name="email" id="email" placeholder="Enter Your E-Mail" value="<?= $email ?>">
        <div style="text-align: center;"><small id="emsg2" style="color: red; text-align:center ;"></small></div>
        <div class="col-12">
            <div class="input-group">
                <div class="d-flex align-items-center bg-light text-body rounded-start p-2">
                    <span class="fas fa-map-marker-alt"></span> <span class="ms-1">Pick Up</span>
                </div>
                <input class="form-control" type="text" placeholder="Enter a City or Airport" name="pickup_place" id="pickup_place">
            </div>
            <div style="text-align: center;"><small id="emsg3" style="color: red;"></small></div>
        </div>
        <div class="col-12">
            <div class="input-group">
                <div class="d-flex align-items-center bg-light text-body rounded-start p-2">
                    <span class="fas fa-map-marker-alt"></span><span class="ms-1">Drop off</span>
                </div>
                <input class="form-control" type="text" placeholder="Enter a City or Airport" name="dropoff_place" id="dropoff_place">
            </div>
            <div style="text-align: center;"><small id="emsg4" style="color: red;"></small></div>
        </div>
        <div class="col-12">
            <div class="input-group">
                <div class="d-flex align-items-center bg-light text-body rounded-start p-2">
                    <span class="fas fa-calendar-alt"></span><span class="ms-1">Pick Up</span>
                </div>
                <input class="form-control" type="date" id="pickup_date" name="pickup_date">
                <select class="form-select ms-3" placeholder="Default select example" id="pickup_time" name="pickup_time">
                    <option value="" disabled selected hidden>Select Time</option>
                    <option value="12:00AM">12:00AM</option>
                    <option value="1:00AM">1:00AM</option>
                    <option value="2:00AM">2:00AM</option>
                    <option value="3:00AM">3:00AM</option>
                    <option value="4:00AM">4:00AM</option>
                    <option value="5:00AM">5:00AM</option>
                    <option value="6:00AM">6:00AM</option>
                    <option value="7:00AM">7:00AM</option>
                </select>
            </div>
        </div>
        <div class="col-12">
            <div class="input-group">
                <div class="d-flex align-items-center bg-light text-body rounded-start p-2">
                    <span class="fas fa-calendar-alt"></span><span class="ms-1">Drop off</span>
                </div>
                <input class="form-control" type="date" id="dropoff_date" name="dropoff_date">
                <select class="form-select ms-3" placeholder="Default select example" id="dropoff_time" name="dropoff_time">
                    <option value="" disabled selected hidden>Select Time</option>
                    <option value="12:00AM">12:00AM</option>
                    <option value="1:00AM">1:00AM</option>
                    <option value="2:00AM">2:00AM</option>
                    <option value="3:00AM">3:00AM</option>
                    <option value="4:00AM">4:00AM</option>
                    <option value="5:00AM">5:00AM</option>
                    <option value="6:00AM">6:00AM</option>
                    <option value="7:00AM">7:00AM</option>
                </select>
            </div>
        </div>
        <small id="emsg5" style="color: red; text-align: center; display: block;"></small>
        <div style="text-align: center;"><small id="emsg0" style="color: red;"></small></div>
        <div class="col-12">
            <button class="btn btn-light w-100 py-2">Book Now</button>
        </div>
    </div>
</form>
<?php
include pathof('./include/footer.php');
?>

<a href="#" class="btn btn-secondary btn-lg-square rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>

<script>
    document.querySelector('form').addEventListener('submit', function(e) {
        e.preventDefault();
        let vcar = document.getElementById('selectcar').value;
        let vrprice = document.getElementById('rprice').value;
        let vpnum = document.getElementById('pnum').value;
        let vemail = document.getElementById('email').value;
        let vpick_up = document.getElementById('pickup_place').value;
        let vdrop_off = document.getElementById('dropoff_place').value;
        let vpickupd = document.getElementById('pickup_date').value;
        let vpickupt = document.getElementById('pickup_time').value;
        let vdropofd = document.getElementById('dropoff_date').value;
        let vdropoft = document.getElementById('dropoff_time').value;

        document.getElementById('emsg0').innerHTML = "";
        document.getElementById('emsg1').innerHTML = "";
        document.getElementById('emsg2').innerHTML = "";
        document.getElementById('emsg3').innerHTML = "";
        document.getElementById('emsg4').innerHTML = "";

        let vnum = /^(\+\d{1,3}[- ]?)?\d{10}$/;
        let vmail = /^[a-zA-Z0-9]+@[a-z]+\.[a-z]{2,}$/;
        let vpickup = /^[a-zA-Z0-9\s,.-]{5,}$/;;
        let vdropoff =/^[a-zA-Z0-9\s,.-]{5,}$/;;
        if (vcar != "" && vcar != null && vrprice != "" && vrprice != null && vpnum != "" && vpnum != null && vemail != "" && vemail != null && vpick_up != "" && vpick_up != null && vdrop_off != "" && vdrop_off != null && vpickupd != "" && vpickupd != null && vpickupt != "" && vpickupt != null && vdropofd != "" && vdropofd != null && vdropoft != "" && vdropoft != null) {
            if (vnum.test(vpnum)) {
                if (vmail.test(vemail)) {
                    if (vpickup.test(vpick_up)) {
                        if (vdropoff.test(vdrop_off)) {
                            if (!validateDropoffTime()) {
                                return false; // Block submission
                            }
                            let data = {
                                car: $('#selectcar').val(),
                                rprice: $('#rprice').val(),
                                pnum: $('#pnum').val(),
                                email: $('#email').val(),
                                pickup_place: $('#pickup_place').val(),
                                dropoff_place: $('#dropoff_place').val(),
                                pickup_date: $('#pickup_date').val(),
                                pickup_time: $('#pickup_time').val(),
                                dropoff_date: $('#dropoff_date').val(),
                                dropoff_time: $('#dropoff_time').val()
                            }

                            $.ajax({
                                url: "../../api/book/booking",
                                method: "POST",
                                data: data,
                                success: function(response) {
                                    alert("Car booked Successfully");
                                    window.location.href = "../../index";
                                },
                                error: function(error) {
                                    alert("Not Booked");
                                    window.location.href = "./index";
                                }
                            })
                            return false;
                        } else {
                            document.getElementById('emsg4').innerHTML = "Please enter a valid dropoff location.";
                            scrollToFirstError();
                            return false;
                        }
                    } else {
                        document.getElementById('emsg3').innerHTML = "Please enter a valid pickup location.";
                        scrollToFirstError();
                        return false;
                    }
                } else {
                    document.getElementById('emsg2').innerHTML = "Email Pattern Not Matched";
                    scrollToFirstError();
                    return false;
                }
            } else {
                document.getElementById('emsg1').innerHTML = "Mobile Pattern Not Matched";
                scrollToFirstError();
                return false;
            }
        } else {
            document.getElementById('emsg0').innerHTML = "Null Fields Not Allowed";
            scrollToFirstError();
            return false;
        }
    });
    const selectcar = document.getElementById('selectcar');

    /* list is about to open → hide arrow */
    selectcar.addEventListener('mousedown', () => {
        selectcar.classList.add('is-open');
    });

    /* list just closed *and* the value changed → show arrow */
    selectcar.addEventListener('change', () => {
        selectcar.classList.remove('is-open');
    });

    /* user pressed Esc or clicked elsewhere without changing value → show arrow */
    selectcar.addEventListener('blur', () => {
        selectcar.classList.remove('is-open');
    });

    const pickup_time = document.getElementById('pickup_time');

    /* list is about to open → hide arrow */
    pickup_time.addEventListener('mousedown', () => {
        pickup_time.classList.add('is-open');
    });

    /* list just closed *and* the value changed → show arrow */
    pickup_time.addEventListener('change', () => {
        pickup_time.classList.remove('is-open');
    });

    /* user pressed Esc or clicked elsewhere without changing value → show arrow */
    pickup_time.addEventListener('blur', () => {
        pickup_time.classList.remove('is-open');
    });

    const dropoff_time = document.getElementById('dropoff_time');

    /* list is about to open → hide arrow */
    dropoff_time.addEventListener('mousedown', () => {
        dropoff_time.classList.add('is-open');
    });

    /* list just closed *and* the value changed → show arrow */
    dropoff_time.addEventListener('change', () => {
        dropoff_time.classList.remove('is-open');
    });

    /* user pressed Esc or clicked elsewhere without changing value → show arrow */
    dropoff_time.addEventListener('blur', () => {
        dropoff_time.classList.remove('is-open');
    });

    document.addEventListener('DOMContentLoaded', () => {
        const params = new URLSearchParams(window.location.search);
        const carId = params.get('car'); // "3" or null

        if (carId) {
            /* 1) Pre‑select the dropdown (you already do this server‑side,
                  but this covers a JS‑only variant too) */
            const select = document.getElementById('selectcar');
            if (select) select.value = carId;

            /* 2) Remove ?car=... from the address bar without reloading */
            const cleanUrl = window.location.pathname + window.location.hash;
            history.replaceState(null, '', cleanUrl);
        }
    });
    /* existing code … */

    /* ---------- price synchronisation ---------- */
    const rprice = document.getElementById('rprice');

    function syncPriceWithCar() {
        const opt = selectcar.options[selectcar.selectedIndex];
        const price = opt ? opt.dataset.price : '';
        rprice.value = price ? '$' + price : '';
    }


    /* run once on page‑load (after any URL pre‑select) */
    syncPriceWithCar();

    /* keep price updated whenever user picks a different car */
    selectcar.addEventListener('change', syncPriceWithCar);


    const pickupDate = document.getElementById('pickup_date');
    const dropoffDate = document.getElementById('dropoff_date');

    pickupDate.addEventListener('change', function() {
        const selectedDate = this.value;
        dropoffDate.min = selectedDate;

        // Optional: If dropoff date is already set and is before pickup date, clear it
        if (dropoffDate.value && dropoffDate.value < selectedDate) {
            dropoffDate.value = '';
        }
    });

    const pickupTime = document.getElementById('pickup_time');
    const dropoffTime = document.getElementById('dropoff_time');
    const emsg5 = document.getElementById("emsg5");


    function validateDropoffTime() {
        const pickupTime = document.getElementById('pickup_time');
        const dropoffTime = document.getElementById('dropoff_time');
        const pickupDate = document.getElementById('pickup_date');
        const dropoffDate = document.getElementById('dropoff_date');

        const pickupDateVal = pickupDate.value;
        const dropoffDateVal = dropoffDate.value;
        const pickupTimeVal = pickupTime.value;
        const dropoffTimeVal = dropoffTime.value;

        emsg5.textContent = "";

        if (pickupDateVal && dropoffDateVal && pickupDateVal === dropoffDateVal) {
            const times = {
                "12:00AM": 0,
                "1:00AM": 1,
                "2:00AM": 2,
                "3:00AM": 3,
                "4:00AM": 4,
                "5:00AM": 5,
                "6:00AM": 6,
                "7:00AM": 7
            };

            const pickVal = times[pickupTimeVal];
            const dropVal = times[dropoffTimeVal];

            if (dropVal <= pickVal) {
                emsg5.textContent = "Drop-off time must be after pickup time when date is same.";
                return false;
            }
        }

        return true;
    }


    pickupTime.addEventListener('change', validateDropoffTime);
    dropoffTime.addEventListener('change', validateDropoffTime);
    pickupDate.addEventListener('change', validateDropoffTime);
    dropoffDate.addEventListener('change', validateDropoffTime);

    function scrollToFirstError() {
    const errorElements = document.querySelectorAll('[id^="emsg"]');
    for (const el of errorElements) {
        if (el.textContent.trim() !== '') {
            el.scrollIntoView({ behavior: 'smooth', block: 'center' });
            el.style.animation = "shake 0.4s ease"; // Optional shake effect
            return;
        }
    }
}




</script>
<?php
include pathof('./include/script.php');
include pathof('./include/closing tag.php');
?>